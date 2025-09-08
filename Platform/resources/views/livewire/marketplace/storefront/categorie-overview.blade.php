<div class="py-20 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-start gap-6 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900">Browse Categories</h2>
                <p class="mt-2 text-sm text-gray-600">Kickstart sourcing across our most active product domains.</p>
            </div>
            <div class="flex gap-3">
                <button type="button" class="inline-flex items-center gap-1 rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white shadow transition hover:bg-gray-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900">
                    <svg viewBox="0 0 20 20" fill="currentColor" class="size-4" aria-hidden="true"><path fill-rule="evenodd" d="M10 3.5a.75.75 0 0 1 .75.75v5h5a.75.75 0 0 1 0 1.5h-5v5a.75.75 0 0 1-1.5 0v-5h-5a.75.75 0 0 1 0-1.5h5v-5A.75.75 0 0 1 10 3.5Z" clip-rule="evenodd"/></svg>
                    All
                </button>
                <button type="button" class="inline-flex items-center gap-1 rounded-md bg-white px-4 py-2 text-sm font-medium text-gray-900 ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Suppliers</button>
                <button type="button" class="inline-flex items-center gap-1 rounded-md bg-white px-4 py-2 text-sm font-medium text-gray-900 ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Brands</button>
            </div>
        </div>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @php
                $categories = [
                    ['name' => 'Industrial Components', 'items' => 842, 'image' => 'https://images.unsplash.com/photo-1581092787767-e3ebfec067f5?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Packaging & Containers', 'items' => 316, 'image' => 'https://images.unsplash.com/photo-1600059227009-04e07a597905?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Office & Ops Supplies', 'items' => 1290, 'image' => 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Safety & Compliance', 'items' => 412, 'image' => 'https://images.unsplash.com/photo-1581091215367-59ab6c3c8742?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Electronics & IoT', 'items' => 978, 'image' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Facility Maintenance', 'items' => 563, 'image' => 'https://images.unsplash.com/photo-1581091870627-3a29040b6f1e?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Logistics & Handling', 'items' => 202, 'image' => 'https://images.unsplash.com/photo-1532635247-3af1ae543204?auto=format&fit=crop&w=800&q=80'],
                    ['name' => 'Sustainable Materials', 'items' => 147, 'image' => 'https://images.unsplash.com/photo-1604335399105-a0c924c6b742?auto=format&fit=crop&w=800&q=80'],

                ];
            @endphp

            @foreach($categories as $cat)
                <a href="#" class="group relative block overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition hover:shadow-md focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    <div class="relative h-40 overflow-hidden">
                        <img src="{{ $cat['image'] }}" alt="{{ $cat['name'] }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 via-gray-900/10 to-transparent"></div>
                        <div class="absolute bottom-2 left-2 rounded bg-white/90 px-2 py-0.5 text-[10px] font-medium text-gray-700 ring-1 ring-gray-200 backdrop-blur">
                            {{ number_format($cat['items']) }} items
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-sm font-semibold text-gray-900 group-hover:text-indigo-600">{{ $cat['name'] }}</h3>
                        <p class="mt-2 line-clamp-2 text-xs text-gray-500">Explore sourcing options and negotiated supplier terms for {{ strtolower($cat['name']) }}.</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            <a href="#" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-6 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                View All Categories
            </a>
        </div>
    </div>
</div>
