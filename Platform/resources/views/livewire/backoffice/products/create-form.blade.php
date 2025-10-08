
<form wire:submit.prevent="store" method="POST" enctype="multipart/form-data"
    class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl p-8 space-y-6 border border-gray-100">
    @csrf
    <!-- Title -->
    <h2 class="text-2xl font-bold text-gray-900">Create Product</h2>

    <!-- Product Name -->
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Product Name</label>
        <input type="text" wire:model="name" id="name"
               class=" py-2 px-2 rounded-md mt-1 block w-full  border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-all hover:shadow-md"
               placeholder="Enter product name" required>
        @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Product Description -->
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Product Description</label>
        <textarea wire:model="description" id="description"
                  class="py-2 px-2 rounded-md mt-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-all hover:shadow-md"
                  placeholder="Enter product description" required></textarea>
        @error('description') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Price -->
    <div>
        <label for="price" class="block text-sm font-medium text-gray-700">Price (Euro)</label>
        <input type="number" wire:model="price" id="price"
               class="py-2 px-2 rounded-md mt-1 block w-full  border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-all hover:shadow-md"
               placeholder="Enter product price" step="0.01" min="0" required>
        @error('price') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Category -->
    <div>
        <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
        <select wire:model="category" id="category"
                class="py-2 px-2 rounded-md mt-1 block w-full  border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-all hover:shadow-md"
                required>
            <option value="">Select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Publish -->
    <div class="flex items-center gap-2">
        <input type="checkbox" wire:model="is_published" id="is_published"
               class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 transition">
        <label for="is_published" class="text-sm font-medium text-gray-700">Publish</label>
    </div>

    <!-- Main Product Image -->
    <div>
        <label for="image" class="block text-sm font-medium text-gray-700">Main Product Image</label>
        <input type="file" wire:model="image" id="image" accept="image/*"
               class="py-2 px-2 rounded-md mt-1 block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-all hover:shadow-md">
        @error('image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </div>

    <!-- Variants -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Variants</label>
        <div class="space-y-4">
            @foreach ($this->variants as $index => $variant)
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 flex flex-col md:flex-row md:items-center gap-4 shadow-sm">
                    <div class="flex-1 flex flex-col md:flex-row gap-2">
                        <input type="text" wire:model="variants.{{ $index }}.name" placeholder="Variant Name"
                               class="py-2 px-3 rounded border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm w-full md:w-1/3" />
                        <input type="number" wire:model="variants.{{ $index }}.price" placeholder="Variant Price"
                               class="py-2 px-3 rounded border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm w-full md:w-1/4" step="0.01" min="0" />
                        <input type="file" wire:model="variants.{{ $index }}.image" accept="image/*"
                               class="py-2 px-3 rounded border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm w-full md:w-1/3" />
                    </div>
                    <div class="flex md:ml-auto">
                        <button type="button" wire:click="removeVariant({{ $index }})"
                                class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 text-xs font-semibold transition">Remove</button>
                    </div>
                    @error('variants.' . $index . '.image') <span class="text-red-600 text-xs mt-2">{{ $message }}</span> @enderror
                </div>
            @endforeach
        </div>
        <button type="button" wire:click="addVariant" class="mt-4 px-5 py-2 bg-indigo-600 text-white rounded shadow hover:bg-indigo-500 transition">Add Variant</button>
    </div>

    <!-- Submit -->
    <div>
        <button type="submit"
                class="w-full inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:from-indigo-500 hover:to-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all">
            Create Product
        </button>
    </div>
</form>
