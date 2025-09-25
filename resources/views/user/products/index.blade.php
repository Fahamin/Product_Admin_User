<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @foreach($products as $product)
        <!-- Product Card -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 border border-gray-100 group">
            <!-- Product Image -->
            <div class="relative">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" 
                         alt="{{ $product->name }}"
                         class="w-full h-32 object-cover transition-transform duration-300 group-hover:scale-105">
                @else
                    <div class="w-full h-32 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500 text-sm">No Image</span>
                    </div>
                @endif

                <!-- Price Badge -->
                <div class="absolute top-2 right-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-lg shadow-md">
                    ${{ number_format($product->price, 2) }}
                </div>
            </div>
            
            <!-- Product Details -->
            <div class="p-3 flex flex-col justify-between h-36">
                <h3 class="text-sm font-semibold text-gray-800 truncate">{{ $product->name }}</h3>
                
                <p class="text-gray-500 text-xs line-clamp-2 mt-1">
                    {{ $product->description ?: 'No description available.' }}
                </p>

                <div class="mt-3 flex justify-between items-center">
                    <a href="{{ route('user.products.show', $product) }}" 
                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-xs font-medium transition-colors duration-200">
                        View
                    </a>
                    <button class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M5 15l7-7 7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $products->links() }}
</div>
