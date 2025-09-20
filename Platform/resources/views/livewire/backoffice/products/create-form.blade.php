<form wire:submit.prevent="store"
    class="max-w-2xl mx-auto bg-white rounded-2xl shadow-xl p-8 space-y-6 border border-gray-100">

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

    <!-- Image Upload -->
    <div>
        <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
        <input type="file" wire:model="image" id="image"
               class="mt-1 block w-full rounded-xl border border-dashed border-gray-300 p-3 text-sm text-gray-500 cursor-pointer hover:border-indigo-400 transition">
        @error('image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

        <div wire:loading wire:target="image" class="text-xs text-indigo-600 mt-1 animate-pulse">
            Uploading...
        </div>
    </div>

    <!-- Variants -->
<div class="space-y-4">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-semibold text-gray-900">Variants</h3>
        <button type="button" wire:click="addVariant"
                class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-indigo-600 bg-indigo-50 rounded-md hover:bg-indigo-100 transition">
            + Add Variant
        </button>
    </div>

    @foreach ($variants as $index => $variant)
        <div class="bg-white border border-gray-200 rounded-2xl shadow-md p-6 mb-2 flex flex-col gap-4 relative group transition hover:shadow-lg">
            <button type="button" wire:click="removeVariant({{ $index }})"
                class="absolute top-3 right-3 text-red-500 hover:text-red-700 bg-red-50 rounded-full p-1.5 transition shadow-sm opacity-0 group-hover:opacity-100 focus:opacity-100 focus:outline-none"
                title="Remove variant">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Variant Name</label>
                    <input type="text" wire:model="variants.{{ $index }}.name"
                        class="block w-full rounded-lg border border-gray-300 py-2 px-3 text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition"
                        placeholder="e.g., Size or Color">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Price</label>
                    <input type="number" wire:model="variants.{{ $index }}.price"
                        class="block w-full rounded-lg border border-gray-300 py-2 px-3 text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition"
                        placeholder="e.g., 49.99">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Image</label>
                    <input type="file" wire:model="image" id="image"
                        class="block w-full rounded-lg border border-dashed border-gray-300 py-2 px-3 text-sm text-gray-500 cursor-pointer hover:border-indigo-400 transition">
                    @error('image') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                    <div wire:loading wire:target="image" class="text-xs text-indigo-600 mt-1 animate-pulse">
                        Uploading...
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <label class="block text-xs font-semibold text-gray-600 mb-1">Description</label>
                <textarea wire:model="variants.{{ $index }}.description"
                    class="block w-full rounded-lg border border-gray-300 py-2 px-3 text-sm shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition"
                    placeholder="Enter variant description"></textarea>
            </div>
        </div>
    @endforeach
</div>


    <!-- Submit -->
    <div>
        <button type="submit"
                class="w-full inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 px-5 py-3 text-sm font-semibold text-white shadow-lg hover:from-indigo-500 hover:to-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all">
            Create Product
        </button>
    </div>
</form>
