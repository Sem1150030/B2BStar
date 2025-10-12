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

        @if($image)
            <div class="mt-2 text-sm text-green-600">✓ Main image selected</div>
        @endif
    </div>

    <!-- Optional Additional Images (shown only when main image is set) -->
    @if($image)
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Additional Images (Optional - up to 3)</label>
        <div class="space-y-3">
            @for($i = 0; $i < 3; $i++)
                <div>
                    <label for="optionalImage{{ $i }}" class="block text-xs text-gray-600 mb-1">Additional Image {{ $i + 1 }}</label>
                    <input type="file" wire:model="optionalImages.{{ $i }}" id="optionalImage{{ $i }}" accept="image/*"
                           class="py-2 px-2 rounded-md block w-full border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition-all hover:shadow-md">
                    @error('optionalImages.' . $i) <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                </div>
            @endfor
        </div>
    </div>
    @endif

    <!-- Variants -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Variants</label>
        <div class="space-y-4">
            @foreach ($this->variants as $index => $variant)
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 space-y-4 shadow-sm">
                    <!-- Variant Header with Name, Price, Image and Remove Button -->
                    <div class="flex flex-col md:flex-row md:items-start gap-4">
                        <div class="flex-1 grid grid-cols-1 md:grid-cols-3 gap-3">
                            <div>
                                <label for="variantName{{ $index }}" class="block text-xs font-medium text-gray-600 mb-1">Variant Name</label>
                                <input type="text" wire:model="variants.{{ $index }}.name" id="variantName{{ $index }}" placeholder="e.g., Small, Blue"
                                       class="py-2 px-3 rounded border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm w-full" />
                            </div>
                            <div>
                                <label for="variantPrice{{ $index }}" class="block text-xs font-medium text-gray-600 mb-1">Price (€)</label>
                                <input type="number" wire:model="variants.{{ $index }}.price" id="variantPrice{{ $index }}" placeholder="0.00"
                                       class="py-2 px-3 rounded border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm w-full" step="0.01" min="0" />
                            </div>
                            <div>
                                <label for="variantImage{{ $index }}" class="block text-xs font-medium text-gray-600 mb-1">Main Image</label>
                                <input type="file" wire:model="variants.{{ $index }}.image" id="variantImage{{ $index }}" accept="image/*"
                                       class="py-2 px-3 rounded border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm w-full" />
                            </div>
                        </div>
                        <div class="flex md:ml-auto md:pt-5">
                            <button type="button" wire:click="removeVariant({{ $index }})"
                                    class="px-3 py-1.5 bg-red-100 text-red-700 rounded hover:bg-red-200 text-xs font-semibold transition">Remove</button>
                        </div>
                    </div>

                    <!-- Variant Description -->
                    <div>
                        <label for="variantDescription{{ $index }}" class="block text-xs font-medium text-gray-600 mb-1">Description (Optional)</label>
                        <textarea wire:model="variants.{{ $index }}.description" id="variantDescription{{ $index }}"
                                  placeholder="Describe this variant's unique features..."
                                  rows="2"
                                  class="py-2 px-3 rounded border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-sm w-full resize-none"></textarea>
                    </div>

                    @error('variants.' . $index . '.image') <span class="text-red-600 text-xs">{{ $message }}</span> @enderror

                    <!-- Optional Additional Images for Variant (shown only when variant's main image is set) -->
                    @if(!empty($variant['image']))
                    <div class="pl-4 border-l-2 border-indigo-200">
                        <label class="block text-xs font-medium text-gray-600 mb-2">Additional Images for this Variant (Optional - up to 3)</label>
                        <div class="space-y-2">
                            @for($i = 0; $i < 3; $i++)
                                <div>
                                    <label for="variantOptionalImage{{ $index }}_{{ $i }}" class="block text-xs text-gray-500 mb-1">Additional Image {{ $i + 1 }}</label>
                                    <input type="file" wire:model="variants.{{ $index }}.optionalImages.{{ $i }}" id="variantOptionalImage{{ $index }}_{{ $i }}" accept="image/*"
                                           class="py-1.5 px-2 rounded border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 text-xs w-full">
                                    @error('variants.' . $index . '.optionalImages.' . $i) <span class="text-red-600 text-xs">{{ $message }}</span> @enderror
                                </div>
                            @endfor
                        </div>
                    </div>
                    @endif
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
