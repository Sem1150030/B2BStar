<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Edit Product</h1>
        <p class="mt-2 text-sm text-gray-600">Update your product information, images, and variants</p>
    </div>

    @if($errors)
        <div>
            @foreach($errors as $error)
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-sm text-red-700">Error: {{ $error }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <form wire:submit.prevent="update" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Basic Information Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Basic Information</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Product Name -->
                <div class="lg:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name</label>
                    <input type="text" wire:model="name" id="name"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                           placeholder="Enter product name" required>
                    @error('name') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Product Description -->
                <div class="lg:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Product Description</label>
                    <textarea wire:model="description" id="description" rows="4"
                              class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                              placeholder="Enter product description" required></textarea>
                    @error('description') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price (€)</label>
                    <input type="number" wire:model="price" id="price"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                           placeholder="0.00" step="0.01" min="0" required>
                    @error('price') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select wire:model="category" id="category"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                            required>
                        <option value="">Select a category</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category') <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Publish Status -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3">
                        <input type="checkbox" wire:model="is_published" id="is_published"
                               class="w-5 h-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 transition">
                        <label for="is_published" class="text-sm font-medium text-gray-700">Publish this product</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Images Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-6">Product Images</h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Main Product Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Main Product Image</label>

                    @if($existingMainImage)
                        <div class="mb-4">
                            <p class="text-xs text-gray-600 mb-2">Current Image:</p>
                            <img src="{{ asset('storage/' . $existingMainImage) }}"
                                 alt="Current product image"
                                 class="w-full max-w-md h-auto  object-cover rounded-lg border-2 border-gray-200 shadow-sm">
                        </div>
                    @endif

                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-500 transition">
                        <input type="file" wire:model="image" id="image" accept="image/*" class="hidden">
                        <label for="image" class="cursor-pointer">
                            <div class="text-gray-600">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="mt-2 text-sm font-medium">Click to upload new image</p>
                                <p class="mt-1 text-xs text-gray-500">PNG, JPG, WEBP up to 2MB</p>
                            </div>
                        </label>
                    </div>

                    @error('image') <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span> @enderror
                    @if($image)
                        <div class="mt-3 p-3 bg-green-50 border border-green-200 rounded-lg">
                            <p class="text-sm text-green-700">✓ New main image selected</p>
                        </div>
                    @endif
                </div>

                <!-- Additional Images -->
                @if($existingMainImage || $image)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Additional Images (Up to 3)</label>
                    <div class="space-y-4">
                        @for($i = 0; $i < 3; $i++)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <p class="text-xs font-medium text-gray-700 mb-2">Additional Image {{ $i + 1 }}</p>

                                @if(isset($existingOptionalImages[$i]) && $existingOptionalImages[$i])
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $existingOptionalImages[$i]) }}"
                                             alt="Current optional image {{ $i + 1 }}"
                                             class="max-w-36 max-h-36 object-cover rounded border border-gray-200">
                                    </div>
                                @endif

                                <input type="file" wire:model="optional_images.{{ $i }}" id="optionalImage{{ $i }}" accept="image/*"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                                @error('optional_images.' . $i) <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        @endfor
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Variants Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Product Variants</h2>
                    <p class="text-sm text-gray-600 mt-1">Add different variations of your product (sizes, colors, etc.)</p>
                </div>
                <button type="button" wire:click="addVariant"
                        class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Add Variant
                </button>
            </div>

            @if(count($existingVariants) > 0 || count($variants) > 0)
                <div class="space-y-6">
                    <!-- New Variants -->
                    @foreach ($variants as $index => $variant)
                        <div class="border-2 border-indigo-300 rounded-xl p-6 bg-indigo-50 hover:border-indigo-400 transition">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center gap-2">
                                    <h3 class="text-lg font-semibold text-gray-900">New Variant {{ $index + 1 }}</h3>
                                    <span class="px-2 py-1 text-xs font-medium text-indigo-700 bg-indigo-100 rounded-full">New</span>
                                </div>
                                <button type="button" wire:click="removeNewVariant({{ $index }})"
                                        class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition font-medium text-sm">
                                    Remove
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                                <!-- Variant Name -->
                                <div class="lg:col-span-2">
                                    <label for="newVariantName{{ $index }}" class="block text-sm font-medium text-gray-700 mb-2">Variant Name</label>
                                    <input type="text" wire:model="variants.{{ $index }}.name"
                                           id="newVariantName{{ $index }}" placeholder="e.g., Small, Red, 250ml"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                                </div>

                                <!-- Variant Price -->
                                <div class="lg:col-span-2">
                                    <label for="newVariantPrice{{ $index }}" class="block text-sm font-medium text-gray-700 mb-2">Price (€)</label>
                                    <input type="number" wire:model="variants.{{ $index }}.price"
                                           id="newVariantPrice{{ $index }}" placeholder="0.00"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                           step="0.01" min="0" />
                                </div>

                                <!-- Variant Description -->
                                <div class="lg:col-span-4">
                                    <label for="newVariantDescription{{ $index }}" class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
                                    <textarea wire:model="variants.{{ $index }}.description"
                                              id="newVariantDescription{{ $index }}"
                                              placeholder="Describe this variant's unique features..."
                                              rows="2"
                                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                                </div>
                            </div>

                            <!-- Variant Images -->
                            <div class="border-t border-gray-300 pt-4 mt-4">
                                <h4 class="text-sm font-semibold text-gray-900 mb-4">Variant Images</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <!-- Main Variant Image -->
                                    <div>
                                        <label for="newVariantImage{{ $index }}" class="block text-xs font-medium text-gray-700 mb-2">Main Image</label>
                                        <input type="file" wire:model="variants.{{ $index }}.image"
                                               id="newVariantImage{{ $index }}" accept="image/*"
                                               class="block w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                                        @error('variants.' . $index . '.image') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Optional Variant Images -->
                                    @if(!empty($variant['image']))
                                        @for($i = 0; $i < 3; $i++)
                                            <div>
                                                <label for="newVariantOptionalImage{{ $index }}_{{ $i }}" class="block text-xs font-medium text-gray-700 mb-2">
                                                    Additional {{ $i + 1 }}
                                                </label>
                                                <input type="file" wire:model="variants.{{ $index }}.optional_images.{{ $i }}"
                                                       id="newVariantOptionalImage{{ $index }}_{{ $i }}" accept="image/*"
                                                       class="block w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                            </div>
                                        @endfor
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Existing Variants -->
                    @foreach ($existingVariants as $index => $variant)
                        <div class="border-2 border-gray-200 rounded-xl p-6 bg-gray-50 hover:border-indigo-300 transition">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Variant {{ $index + 1 }}</h3>
                                <button type="button" wire:click="removeVariant({{ $index }})"
                                        class="px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition font-medium text-sm">
                                    Remove
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                                <!-- Variant Name -->
                                <div class="lg:col-span-2">
                                    <label for="variantName{{ $index }}" class="block text-sm font-medium text-gray-700 mb-2">Variant Name</label>
                                    <input type="text" wire:model="existingVariants.{{ $index }}.name"
                                           id="variantName{{ $index }}" placeholder="e.g., Small, Red, 250ml"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent" />
                                </div>

                                <!-- Variant Price -->
                                <div class="lg:col-span-2">
                                    <label for="variantPrice{{ $index }}" class="block text-sm font-medium text-gray-700 mb-2">Price (€)</label>
                                    <input type="number" wire:model="existingVariants.{{ $index }}.price"
                                           id="variantPrice{{ $index }}" placeholder="0.00"
                                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                           step="0.01" min="0" />
                                </div>

                                <!-- Variant Description -->
                                <div class="lg:col-span-4">
                                    <label for="variantDescription{{ $index }}" class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
                                    <textarea wire:model="existingVariants.{{ $index }}.description"
                                              id="variantDescription{{ $index }}"
                                              placeholder="Describe this variant's unique features..."
                                              rows="2"
                                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"></textarea>
                                </div>
                            </div>

                            <!-- Variant Images -->
                            <div class="border-t border-gray-300 pt-4 mt-4">
                                <h4 class="text-sm font-semibold text-gray-900 mb-4">Variant Images</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <!-- Main Variant Image -->
                                    <div>
                                        <label for="variantImage{{ $index }}" class="block text-xs font-medium text-gray-700 mb-2">Main Image</label>

                                        @if(isset($variant['existingMainImage']) && $variant['existingMainImage'])
                                            <div class="mb-2">
                                                <img src="{{ asset('storage/' . $variant['existingMainImage']) }}"
                                                     alt="Current variant image"
                                                     class="max-w-36 max-h-36 object-cover rounded border border-gray-200">
                                            </div>
                                        @endif

                                        <input type="file" wire:model="existingVariants.{{ $index }}.image"
                                               id="variantImage{{ $index }}" accept="image/*"
                                               class="block w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" />
                                        @error('existingVariants.' . $index . '.image') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                                    </div>

                                    <!-- Optional Variant Images -->
                                    @if(!empty($variant['existingMainImage']) || !empty($variant['image']))
                                        @for($i = 0; $i < 3; $i++)
                                            <div>
                                                <label for="variantOptionalImage{{ $index }}_{{ $i }}" class="block text-xs font-medium text-gray-700 mb-2">
                                                    Additional {{ $i + 1 }}
                                                </label>

                                                @if(isset($variant['existingOptionalImages'][$i]) && $variant['existingOptionalImages'][$i])
                                                    <div class="mb-2">
                                                        <img src="{{ asset('storage/' . $variant['existingOptionalImages'][$i]) }}"
                                                             alt="Variant optional image"
                                                             class="max-w-36 max-h-36 object-cover rounded border border-gray-200">
                                                    </div>
                                                @endif

                                                <input type="file" wire:model="existingVariants.{{ $index }}.optional_images.{{ $i }}"
                                                       id="variantOptionalImage{{ $index }}_{{ $i }}" accept="image/*"
                                                       class="block w-full text-xs text-gray-500 file:mr-2 file:py-1.5 file:px-3 file:rounded file:border-0 file:text-xs file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                                @error('existingVariants.' . $index . '.optional_images.' . $i) <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                                            </div>
                                        @endfor
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 border-2 border-dashed border-gray-300 rounded-lg">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                    <p class="mt-4 text-sm text-gray-600">No variants added yet</p>
                    <p class="text-xs text-gray-500 mt-1">Click "Add Variant" to create product variations</p>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <a href="{{ route('backoffice.products') }}"
               class="px-6 py-2.5 border-2 border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition">
                Cancel
            </a>
            <button type="submit"
                    class="px-8 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white rounded-lg font-semibold hover:from-indigo-700 hover:to-indigo-600 transition shadow-lg hover:shadow-xl">
                Update Product
            </button>
        </div>
    </form>
</div>
