<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SalesReport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PicController extends Controller
{
    public function dashboard(Request $request): View
    {
        $region = $request->user()->region;

        abort_if(blank($region), 403, 'Akun PIC belum terhubung ke Karesidenan.');

        $orders = Order::query()
            ->where('region', $region)
            ->where('status', Order::PAID)
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->with('items')
            ->latest()
            ->get();

        return view('dashboard.pic', [
            'region' => $region,
            'products' => Product::query()->where('is_active', true)->orderBy('category')->orderBy('name')->get(),
            'inventory' => Inventory::query()->where('region', $region)->with('product')->get()->keyBy('product_id'),
            'orders' => $orders,
            'reports' => SalesReport::query()->where('region', $region)->with('user')->latest()->limit(30)->get(),
            'monthlySales' => $orders->sum('total_amount'),
            'monthlyOrderCount' => $orders->count(),
            'categories' => Product::CATEGORIES,
        ]);
    }

    public function updateInventory(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:0', 'max:1000000'],
        ]);

        $product = Product::query()
            ->where('is_active', true)
            ->findOrFail($validated['product_id']);

        DB::transaction(function () use ($request, $validated, $product): void {
            $inventory = Inventory::query()->firstOrCreate([
                'product_id' => $product->id,
                'region' => $request->user()->region,
            ], [
                'quantity' => 0,
            ]);

            $inventory = Inventory::query()->lockForUpdate()->findOrFail($inventory->id);
            $reservedQuantity = OrderItem::query()
                ->where('product_id', $product->id)
                ->whereHas('order', function (Builder $query) use ($request): void {
                    $query->where('region', $request->user()->region)
                        ->whereIn('status', [Order::PENDING_PAYMENT, Order::AWAITING_APPROVAL])
                        ->where('expires_at', '>', now());
                })
                ->sum('quantity');

            if ($validated['quantity'] < $reservedQuantity) {
                throw ValidationException::withMessages([
                    'quantity' => 'Stok baru tidak boleh lebih rendah dari jumlah yang sedang dipesan.',
                ]);
            }

            $inventory->update(['quantity' => $validated['quantity']]);
        });

        return back()->with('status', "Stok {$product->name} di {$request->user()->region} berhasil diperbarui.");
    }

    public function uploadSalesReport(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'period' => ['required', 'date_format:Y-m'],
            'report_file' => ['required', 'file', 'mimes:pdf,csv,xls,xlsx', 'max:10240'],
            'remarks' => ['nullable', 'string', 'max:1000'],
        ]);

        $path = $request->file('report_file')->store('sales-reports');

        SalesReport::create([
            'user_id' => $request->user()->id,
            'region' => $request->user()->region,
            'period' => $validated['period'],
            'file_path' => $path,
            'remarks' => $validated['remarks'] ?? null,
        ]);

        return back()->with('status', 'Rekap penjualan berhasil diunggah.');
    }

    public function downloadSalesReport(Request $request, SalesReport $salesReport): BinaryFileResponse
    {
        abort_unless($salesReport->region === $request->user()->region, 404);

        return response()->download(Storage::disk('local')->path($salesReport->file_path));
    }
}
