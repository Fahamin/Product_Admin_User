<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-4">
                <a href="{{ route('user.products.index') }}" class="inline-flex items-center text-blue-500 hover:text-blue-700">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Products
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                    <!-- Product Image -->
                    <div>
                        @if($product->image)
                            <img src="{{ asset('storage/'.$product->image) }}" 
                                 alt="{{ $product->name }}"
                                 class="w-full h-64 object-cover rounded-lg shadow">
                        @else
                            <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                <span class="text-gray-500">No Image Available</span>
                            </div>
                        @endif
                    </div>

                    <!-- Product Details -->
                    <div class="space-y-4">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
                            <div class="mt-2">
                                <span class="text-2xl font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Description</h3>
                            <p class="text-gray-600 leading-relaxed">
                                {{ $product->description ?: 'No description available for this product.' }}
                            </p>
                        </div>

                        <!-- Product Information -->
                        <div class="border-t pt-4">
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">Product Information</h3>
                            <div class="space-y-2 text-sm text-gray-600">
                                <div class="flex justify-between">
                                    <span class="font-medium">Availability:</span>
                                    <span class="text-green-600 font-medium">In Stock</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">Product ID:</span>
                                    <span>#{{ $product->id }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="font-medium">Added On:</span>
                                    <span>{{ $product->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons (User View Only - No Edit/Delete) -->
                        <div class="flex gap-3 pt-4">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium flex items-center gap-2 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Add to Cart
                            </button>
                            <button class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium flex items-center gap-2 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                Add to Wishlist
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products Section -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Related Products</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @php
                        $relatedProducts = \App\Models\Product::where('id', '!=', $product->id)
                          
                            ->inRandomOrder()
                            ->limit(3)
                            ->get();
                    @endphp
                    
                    @foreach($relatedProducts as $relatedProduct)
                        <div class="bg-white rounded-lg shadow p-4 hover:shadow-md transition-shadow">
                            @if($relatedProduct->image)
                                <img src="{{ asset('storage/'.$relatedProduct->image) }}" 
                                     alt="{{ $relatedProduct->name }}"
                                     class="w-full h-32 object-cover rounded mb-2">
                            @endif
                            <h4 class="font-semibold text-gray-800 truncate">{{ $relatedProduct->name }}</h4>
                            <p class="text-green-600 font-bold">${{ number_format($relatedProduct->price, 2) }}</p>
                            <a href="{{ route('user.products.show', $relatedProduct) }}" class="text-blue-500 text-sm hover:underline">
                                View Details
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>