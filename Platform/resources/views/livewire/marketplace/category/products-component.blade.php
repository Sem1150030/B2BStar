<div>
    @foreach($products as $product)
        <div class="border rounded-lg p-4 mb-4 hover:shadow-lg transition-shadow">
            <h2 class="text-xl font-semibold mb-2">{{ $product->name }}</h2>
            <p class="text-gray-600 mb-4">{{ $product->description }}</p>
            <p class="text-lg font-bold text-indigo-600">€{{ number_format($product->price, 2) }}</p>
            <img src="{{ asset('storage/' . ($product->productImage->main_url ?? 'images/dUE2ZbAoL23xNemPf3oKBfICGFbLSbt93Z4Vzc0o.jpg')) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded">
        </div>
    @endforeach
</div>
