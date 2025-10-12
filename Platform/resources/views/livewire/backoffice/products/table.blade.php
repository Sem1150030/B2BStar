<div class="px-4 sm:px-6 lg:px-8">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class=" text-3xl font-semibold text-gray-900">Products</h1>
      <p class="mt-2 text-m text-gray-700">A list of all the Products your brand has registered.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
      <a href="/backoffice/products/create" type="button" class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
        Add Product
      </a>
    </div>
  </div>
  <div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
        <div class="overflow-hidden shadow outline outline-1 outline-black/5 sm:rounded-lg">
          @if($products != null && $products->count() > 0)
            <table class="relative min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Product</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Category</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                    <th scope="col" class="py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @foreach ($products as $product)
                <tr>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 sm:pl-6">
                        <div class="flex items-center">
                            <div class="h-16 w-16 flex-shrink-0">
                                <img src="{{ asset('storage/' . ($product->productImage->main_url)) }}"
                                     alt="{{ $product->name }}"
                                     class="h-16 w-16 rounded-lg object-cover">
                            </div>
                            <div class="ml-4">
                                <div class="font-medium text-gray-900">{{ $product->name }}</div>
                                <div class="text-xs text-gray-500 mt-1">SKU: {{ $product->SKU }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                        {{ $product->category->name }}
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                        @if($product->is_published)
                            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                Published
                            </span>
                        @else
                            <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">
                                Unpublished
                            </span>
                        @endif
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">
                        €{{ number_format($product->price, 2) }}
                    </td>
                    <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                        <a href="{{ route('backoffice.products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900">
                            Edit<span class="sr-only">, {{ $product->name }}</span>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <div class="p-4 text-xl text-gray-700">You haven't added any products yet.</div>

          @endif
        </div>
      </div>
    </div>
  </div>
</div>
