<div>
    <input type="text" wire:model="search" placeholder="ابحث عن منتج..." class="form-control mb-3" />

    <ul>
        @forelse($products as $product)
            <li>{{ $product->name }}</li>
        @empty
            <li>لا توجد نتائج</li>
        @endforelse
    </ul>
</div>
