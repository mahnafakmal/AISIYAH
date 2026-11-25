const cartKey = 'eahm-cart';
const cart = new Map(JSON.parse(sessionStorage.getItem(cartKey) || '[]'));
const cartItems = document.querySelector('#cart-items');
const cartCount = document.querySelector('#cart-count');
const cartTotal = document.querySelector('#cart-total');
const checkoutButton = document.querySelector('#checkout-button');

function renderCart() {
    if (!cartItems) {
        return;
    }

    cartItems.replaceChildren();
    let count = 0;
    let total = 0;

    for (const [productId, item] of cart) {
        count += item.quantity;
        total += item.price * item.quantity;

        const row = document.createElement('li');
        row.className = 'flex items-center justify-between gap-4 py-3 border-b border-sage-100';

        const description = document.createElement('span');
        description.className = 'font-medium text-slate-800';
        description.textContent = `${item.name} × ${item.quantity}`;

        const amount = document.createElement('span');
        amount.className = 'text-sm text-slate-600';
        amount.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(item.price * item.quantity)}`;

        const remove = document.createElement('button');
        remove.type = 'button';
        remove.className = 'text-xs text-red-700 underline';
        remove.textContent = 'Hapus';
        remove.addEventListener('click', () => {
            cart.delete(productId);
            saveCart();
            renderCart();
        });

        const details = document.createElement('div');
        details.className = 'flex flex-1 items-center justify-between gap-3';
        details.append(description, amount);
        row.append(details, remove);
        cartItems.append(row);
    }

    cartCount.textContent = String(count);
    cartTotal.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(total)}`;
    if (checkoutButton) {
        checkoutButton.disabled = cart.size === 0;
        checkoutButton.classList.toggle('opacity-50', cart.size === 0);
    }
}

function saveCart() {
    sessionStorage.setItem(cartKey, JSON.stringify([...cart]));
}

document.querySelectorAll('[data-add-to-cart]').forEach((button) => {
    button.addEventListener('click', () => {
        const productId = button.dataset.productId;
        const currentItem = cart.get(productId);

        cart.set(productId, {
            name: button.dataset.productName,
            price: Number(button.dataset.productPrice),
            quantity: (currentItem?.quantity || 0) + 1,
        });

        saveCart();
        renderCart();
        document.querySelector('#cart-message').textContent = 'Produk ditambahkan ke keranjang.';
    });
});

document.querySelector('#order-form')?.addEventListener('submit', () => {
    const form = document.querySelector('#order-form');
    form.querySelectorAll('[data-cart-input]').forEach((input) => input.remove());

    [...cart].forEach(([productId, item], index) => {
        for (const [field, value] of Object.entries({
            product_id: productId,
            quantity: item.quantity,
        })) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `items[${index}][${field}]`;
            input.value = String(value);
            input.dataset.cartInput = 'true';
            form.append(input);
        }
    });

    sessionStorage.removeItem(cartKey);
});

renderCart();
