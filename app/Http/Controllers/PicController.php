<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use App\Models\Product;
use App\Models\SalesReport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use RuntimeException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PicController extends Controller
{
    public function index(Request $request): View
    {
        $region = $request->user()->region;

        return view('dashboard.pic', [
            'region' => $region,
            'products' => Product::query()->where('is_active', true)->with([
                'inventories' => fn ($query) => $query->where('region', $region),
            ])->orderBy('category')->orderBy('name')->get(),
            'paidOrders' => Order::query()
                ->where('region', $region)
                ->where('status', Order::PAID)
                ->with(['user', 'items'])
                ->latest()
                ->limit(100)
                ->get(),
            'salesTotal' => Order::query()
                ->where('region', $region)
                ->where('status', Order::PAID)
                ->sum('total_amount'),
            'salesReports' => SalesReport::query()
                ->where('region', $region)
                ->with('user')
                ->latest()
                ->get(),
        ]);
    }

    public function updateInventory(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:0', 'max:1000000'],
        ]);

        $product = Product::query()
            ->whereKey($validated['product_id'])
            ->where('is_active', true)
            ->firstOrFail();

        Inventory::updateOrCreate(
            ['product_id' => $product->id, 'region' => $request->user()->region],
            ['quantity' => $validated['quantity']],
        );

        return back()->with('status', 'Stok wilayah berhasil diperbarui.');
    }

    public function uploadInventory(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'inventory_file' => ['required', 'file', 'mimes:csv,txt', 'max:5120'],
        ]);

        $handle = fopen($validated['inventory_file']->getRealPath(), 'rb');

        if ($handle === false) {
            throw new RuntimeException('File stok tidak dapat dibaca.');
        }

        try {
            $header = fgetcsv($handle, escape: '');
            $header = is_array($header)
                ? array_map(fn ($value): string => Str::lower(trim((string) $value)), $header)
                : [];
            $productColumn = array_search('product_id', $header, true);
            $quantityColumn = array_search('quantity', $header, true);

            if ($productColumn === false || $quantityColumn === false) {
                throw ValidationException::withMessages([
                    'inventory_file' => 'CSV harus memiliki kolom product_id dan quantity.',
                ]);
            }

            $rows = [];
            $line = 1;

            while (($columns = fgetcsv($handle, escape: '')) !== false) {
                $line++;

                if ($columns === [null] || $columns === []) {
                    continue;
                }

                $productId = filter_var($columns[$productColumn] ?? null, FILTER_VALIDATE_INT);
                $quantity = filter_var($columns[$quantityColumn] ?? null, FILTER_VALIDATE_INT);

                if ($productId === false || $quantity === false || $quantity < 0 || $quantity > 1000000) {
                    throw ValidationException::withMessages([
                        'inventory_file' => "Baris {$line} harus berisi product_id dan quantity bilangan bulat yang valid.",
                    ]);
                }

                if (! Product::query()->whereKey($productId)->where('is_active', true)->exists()) {
                    throw ValidationException::withMessages([
                        'inventory_file' => "Produk pada baris {$line} tidak ditemukan atau tidak aktif.",
                    ]);
                }

                $rows[$productId] = $quantity;
            }
        } finally {
            fclose($handle);
        }

        if ($rows === []) {
            throw ValidationException::withMessages([
                'inventory_file' => 'CSV tidak memuat baris stok produk.',
            ]);
        }

        DB::transaction(function () use ($rows, $request): void {
            foreach ($rows as $productId => $quantity) {
                Inventory::query()->updateOrCreate(
                    ['product_id' => $productId, 'region' => $request->user()->region],
                    ['quantity' => $quantity],
                );
            }
        });

        return back()->with('status', 'Stok dari CSV berhasil diimpor.');
    }

    public function uploadSalesReport(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'period' => ['required', 'date_format:Y-m'],
            'remarks' => ['nullable', 'string', 'max:1000'],
            'report_file' => ['required', 'file', 'mimes:pdf,csv,xls,xlsx,jpg,jpeg,png', 'max:10240'],
        ]);

        $path = $validated['report_file']->store('sales-reports', 'local');

        if (! is_string($path)) {
            throw new RuntimeException('Gagal menyimpan file rekap penjualan.');
        }

        SalesReport::create([
            'user_id' => $request->user()->id,
            'region' => $request->user()->region,
            'period' => $validated['period'],
            'file_path' => $path,
            'remarks' => $validated['remarks'] ?? null,
        ]);

        return back()->with('status', 'Rekap penjualan berhasil diunggah.');
    }

    public function downloadSalesReport(Request $request, SalesReport $salesReport): StreamedResponse
    {
        abort_unless($salesReport->region === $request->user()->region, 404);

        return Storage::disk('local')->download(
            $salesReport->file_path,
            'rekap-penjualan-'.$salesReport->period,
        );
    }
}
