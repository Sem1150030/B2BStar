<div class="px-4 sm:px-6 lg:px-8">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class=" text-3xl font-semibold text-gray-900">Users</h1>
      <p class="mt-2 text-m text-gray-700">A list of all the users in your account including their name, title, email and role.</p>
    </div>
    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
      <a href="" type="button" class="cursor-pointer block rounded-md bg-indigo-600 px-3 py-3 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
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
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">categorie</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">published</th>
                    <th scope="col" class="py-3.5 pl-3 pr-4 sm:pr-6">
                    <span class="sr-only">Edit</span>
                    </th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                @foreach ($products as $product)
                <tr>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $product->name }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{  $product->categories->name }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $product->is_published }}</td>
                    <td class="whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only"></span></a>
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
