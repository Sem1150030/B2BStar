<div class="min-h-screen bg-gray-50">
    <!-- Category Header -->
    <div class="relative isolate overflow-hidden bg-white">
        <div class="absolute inset-0 -z-10">
            <div class="absolute inset-0 bg-gradient-to-b from-indigo-50/50 to-white"></div>
        </div>

        <div class="mx-auto max-w-7xl px-4 pt-32 pb-12 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <a href="/" class="hover:text-gray-900 transition">Home</a>
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-900 font-medium">{{ $category->name }}</span>
            </div>

            <h1 class="mt-4 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                {{ $category->name }}
            </h1>

            @if($category->description)
            <p class="mt-4 text-lg text-gray-600 max-w-3xl">
                {{ $category->description }}
            </p>
            @endif

            <div class="mt-6 flex items-center gap-4 text-sm text-gray-600">
                <span class="inline-flex items-center gap-1.5">
                    <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    {{ number_format($products->count()) }} Products
                </span>
            </div>
        </div>
    </div>

    <!-- Filters and Products Section -->
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters - Left Side -->
            <aside class="w-full lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 sticky top-24">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Filters</h2>

                    <!-- Price Range -->
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-900 mb-3">Price Range</h3>
                        <div class="space-y-2">
                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" class="size-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-900">Under $100</span>
                            </label>
                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" class="size-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-900">$100 - $500</span>
                            </label>
                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" class="size-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-900">$500 - $1000</span>
                            </label>
                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" class="size-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-900">Over $1000</span>
                            </label>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 my-4"></div>

                    <!-- Availability -->
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-900 mb-3">Availability</h3>
                        <div class="space-y-2">
                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" class="size-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-900">In Stock</span>
                            </label>
                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" class="size-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-900">Out of Stock</span>
                            </label>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 my-4"></div>

                    <!-- Brands -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-900 mb-3">Brand</h3>
                        <div class="space-y-2 max-h-48 overflow-y-auto">
                            @foreach($products->pluck('brand')->unique()->filter() as $brand)
                            <label class="flex items-center cursor-pointer group">
                                <input type="checkbox" class="size-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                <span class="ml-2 text-sm text-gray-600 group-hover:text-gray-900">{{ $brand->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <button type="button" class="mt-6 w-full inline-flex items-center justify-center rounded-md bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-200">
                        Clear Filters
                    </button>
                </div>
            </aside>

            <div class="flex-1">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <p class="text-sm text-gray-600">
                        Showing <span class="font-medium text-gray-900">{{ $products->count() }}</span> results
                    </p>

                    <div class="flex items-center gap-3">
                        <label class="text-sm text-gray-600">Sort by:</label>
                        <select class="rounded-md border-gray-300 text-sm focus:border-indigo-600 focus:ring-indigo-600">
                            <option>Featured</option>
                            <option>Price: Low to High</option>
                            <option>Price: High to Low</option>
                            <option>Newest</option>
                            <option>Name: A-Z</option>
                        </select>
                    </div>
                </div>

                @if($products->count() > 0)
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach($products as $product)
                    <a href="/products/{{$product->id }}" class="group relative flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition hover:shadow-md focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <div class="relative w-full h-48 overflow-hidden bg-gray-100">
                            @if($product->productImage)
                            <img src="{{ asset('storage/' . ($product->productImage->main_url)) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-105" />
                            @else
                            <div class="h-full w-full flex items-center justify-center bg-gray-200">
                                <svg class="size-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            @endif

                            <!-- Badge -->
                            @if(!$product->is_published)
                            <div class="absolute top-2 right-2 rounded bg-gray-900/90 px-2 py-1 text-xs font-medium text-white backdrop-blur">
                                Unavailable
                            </div>
                            @elseif($product->discount)
                            <div class="absolute top-2 right-2 rounded bg-red-600/90 px-2 py-1 text-xs font-medium text-white backdrop-blur">
                                Sale
                            </div>
                            @endif
                        </div>

                        <!-- Product Info -->
                        <div class="p-4 flex flex-col flex-grow">
                            @if($product->brand)
                            <p class="text-xs text-gray-500 uppercase tracking-wide">{{ $product->brand->name }}</p>
                            @endif

                            <h3 class="mt-1 text-sm font-semibold text-gray-900 group-hover:text-indigo-600 line-clamp-2">
                                {{ $product->name }}
                            </h3>

                            @if($product->description)
                            <p class="mt-2 text-xs text-gray-500 line-clamp-2">
                                {{ $product->description }}
                            </p>
                            @endif

                            <div class="mt-auto pt-3">
                                <div class="flex items-center">
                                    <span class="text-lg font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                                    @if($product->discount)
                                    <span class="ml-2 text-sm text-gray-500 line-through">${{ number_format($product->discount->original_price, 2) }}</span>
                                    @endif
                                </div>

                                @if($product->SKU)
                                <span class="text-xs text-gray-400 mt-1 block">SKU: {{ $product->SKU }}</span>
                                @endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
                @else
                <div class="text-center py-16">
                    <svg class="mx-auto size-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">No products found</h3>
                    <p class="mt-2 text-sm text-gray-600">There are no products in this category yet.</p>
                    <div class="mt-6">
                        <a href="/" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-6 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-500">
                            Browse All Categories
                        </a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
