<div class="min-h-screen bg-gray-50">
    <div class="relative isolate overflow-hidden bg-white">
        <div class="absolute inset-0 -z-10">
            <div class="absolute inset-0 bg-gradient-to-b from-indigo-50/50 to-white"></div>
        </div>

        <div class="mx-auto max-w-7xl px-4 pt-38 pb-8 sm:px-6 lg:px-8">
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <a href="/" class="hover:text-gray-900 transition">Home</a>
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                @if($product->category)
                <a href="/categories/{{ $product->category->id }}" class="hover:text-gray-900 transition">{{ $product->category->name }}</a>
                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                @endif
                <span class="text-gray-900 font-medium">{{ $product->name }}</span>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
            <div class="flex flex-col">
                <div class="w-full aspect-square overflow-hidden rounded-xl bg-gray-100 border border-gray-200">
                    @if($product->productImage)
                        <img src="{{ asset('storage/' . $product->productImage->$selectedImage) }}" alt="{{ $product->name }}" class="size-full object-cover object-center" />
                    @else
                    <div class="size-full flex items-center justify-center bg-gray-200">
                        <svg class="size-32 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif
                </div>

                @if($product->productImage && ($product->productImage->opt_url || $product->productImage->opt2_url || $product->productImage->opt3_url))
                <div class="mt-4 grid grid-cols-4 gap-4">
                    <button type="button" wire:click="selectImage('main_url')" class="aspect-square overflow-hidden rounded-lg border-2 border-gray-200 @if($selectedImage == 'main_url')border-indigo-600 @else hover:border-gray-300 @endif  bg-gray-100">
                        <img src="{{ asset('storage/' . $product->productImage->main_url) }}" alt="{{ $product->name }}" class="size-full object-cover" />
                    </button>
                    @if($product->productImage->opt_url)
                    <button type="button" wire:click="selectImage('opt_url')" class="aspect-square overflow-hidden rounded-lg border-2 border-gray-200 @if($selectedImage == 'opt_url')border-indigo-600 @else hover:border-gray-300 @endif bg-gray-100">
                        <img src="{{ asset('storage/' . $product->productImage->opt_url) }}" alt="{{ $product->name }}" class="size-full object-cover" />
                    </button>
                    @endif
                    @if($product->productImage->opt2_url)
                    <button type="button" wire:click="selectImage('opt2_url')" class="aspect-square overflow-hidden rounded-lg border-2 border-gray-200 @if($selectedImage == 'opt2_url')border-indigo-600 @else hover:border-gray-300 @endif bg-gray-100">
                        <img src="{{ asset('storage/' . $product->productImage->opt2_url) }}" alt="{{ $product->name }}" class="size-full object-cover" />
                    </button>
                    @endif
                    @if($product->productImage->opt3_url)
                    <button type="button" wire:click="selectImage('opt3_url')" class="aspect-square overflow-hidden rounded-lg border-2 border-gray-200 @if($selectedImage == 'opt3_url')border-indigo-600 @else hover:border-gray-300 @endif bg-gray-100">
                        <img src="{{ asset('storage/' . $product->productImage->opt3_url) }}" alt="{{ $product->name }}" class="size-full object-cover" />
                    </button>
                    @endif
                </div>
                @endif
            </div>

            <div class="mt-10 px-4 sm:mt-16 sm:px-0 lg:mt-0 lg:max-w-2xl">
                @if($product->brand)
                <div class="flex items-center gap-3 mb-4">
                    <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-200">
                        {{ $product->brand->name }}
                    </span>
                    @if(!$product->is_published)
                    <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-300">
                        Unavailable
                    </span>
                    @endif
                </div>
                @endif

                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ $product->name }}</h1>

                @if($product->SKU)
                <p class="mt-2 text-sm text-gray-500">SKU: {{ $product->SKU }}</p>
                @endif

                <!-- Price -->
                <div class="mt-6">
                    <div class="flex items-baseline gap-3">
                        <span class="text-3xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                    </div>
                </div>

                <!-- Description -->
                @if($product->description)
                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-900">Description</h3>
                        <div class="mt-2 prose prose-sm text-gray-600 max-w-prose">
                            <p>{{ $product->description }}</p>
                        </div>
                    </div>
                @endif

                @if($product->variants && $product->variants->count() > 0)
                <div class="mt-8">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium text-gray-900">Available Variants</h3>
                        <span class="text-sm text-gray-500">{{ $product->variants->count() }} options</span>
                    </div>
                    <div class="mt-4 grid grid-cols-1 gap-3">
                        @foreach($product->variants as $variant)
                        <div class="relative flex flex-col rounded-lg border border-gray-300 bg-white px-4 py-3 hover:border-indigo-600 cursor-pointer transition">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col flex-1 min-w-0">
                                    <span class="text-sm font-medium text-gray-900">{{ $variant->name }}</span>
                                    @if($variant->description)
                                        <span class="text-xs text-gray-500 mt-1 line-clamp-2">{{ Str::limit($variant->description, 130) }}</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2 ml-4 flex-shrink-0">
                                    <span class="text-lg font-semibold text-gray-900">${{ number_format($variant->price, 2) }}</span>
                                    @if($variant->is_published)
                                        <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-0.5 text-xs font-medium text-green-700">
                                            In Stock
                                        </span>
                                    @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-1.5 py-0.5 text-xs font-medium text-gray-600">
                                            Out of Stock
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @if($variant->sku)
                            <span class="text-xs text-gray-400 mt-2">SKU: {{ $variant->sku }}</span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Add to Cart / Contact -->
                <div class="mt-10 flex flex-col gap-3 sm:flex-row">
                    @if($product->is_published)
                    <button type="button" class="flex-1 inline-flex items-center justify-center rounded-md bg-indigo-600 px-8 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg class="size-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        Add to Cart
                    </button>
                    <button type="button" class="inline-flex items-center justify-center rounded-md bg-white px-8 py-3 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg class="size-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Save
                    </button>
                    @else
                    <button type="button" class="flex-1 inline-flex items-center justify-center rounded-md bg-gray-400 px-8 py-3 text-sm font-semibold text-white cursor-not-allowed" disabled>
                        Currently Unavailable
                    </button>
                    @endif
                </div>

                <div class="mt-10 border-t border-gray-200 pt-8">
                    <h3 class="text-sm font-medium text-gray-900">Product Details</h3>
                    <div class="mt-4 space-y-4">
                        @if($product->brand)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Brand</span>
                            <span class="font-medium text-gray-900">{{ $product->brand->name }}</span>
                        </div>
                        @endif
                        @if($product->category)
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Category</span>
                            <a href="/categories/{{ $product->category->id }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                {{ $product->category->name }}
                            </a>
                        </div>
                        @endif
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Availability</span>
                            @if($product->is_published)
                            <span class="inline-flex items-center gap-1.5 font-medium text-green-600">
                                <svg class="size-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                In Stock
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 font-medium text-gray-500">
                                <svg class="size-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                                Out of Stock
                            </span>
                            @endif
                        </div>
                    </div>
                </div>

                @if($product->brand && ($product->brand->description || $product->brand->motto))
                <div class="mt-8 border-t border-gray-200 pt-8">
                    <h3 class="text-sm font-medium text-gray-900 mb-4">About {{ $product->brand->name }}</h3>
                    <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                        @if($product->brand->motto)
                        <p class="text-sm italic text-gray-600">"{{ $product->brand->motto }}"</p>
                        @endif
                        @if($product->brand->description)
                        <p class="mt-3 text-sm text-gray-600">{{ $product->brand->description }}</p>
                        @endif
                        @if($product->brand->email || $product->brand->phone)
                        <div class="mt-4 pt-4 border-t border-gray-200 flex flex-wrap gap-4 text-sm">
                            @if($product->brand->email)
                            <a href="mailto:{{ $product->brand->email }}" class="inline-flex items-center gap-1.5 text-indigo-600 hover:text-indigo-500">
                                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                {{ $product->brand->email }}
                            </a>
                            @endif
                            @if($product->brand->phone)
                            <a href="tel:{{ $product->brand->phone }}" class="inline-flex items-center gap-1.5 text-indigo-600 hover:text-indigo-500">
                                <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                                {{ $product->brand->phone }}
                            </a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
