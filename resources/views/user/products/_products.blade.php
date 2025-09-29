@if(isset($products) && $products->count() > 0)
    @foreach($products as $product)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
            @if($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
            @else
                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-500">No Image</span>
                </div>
            @endif
            <div class="p-4">
                <h4 class="text-lg font-semibold">{{ $product->name }}</h4>
                <p class="text-gray-600 dark:text-gray-300">{{ Str::limit($product->description, 60) }}</p>
                <p class="text-green-600 font-bold">${{ number_format($product->price, 2) }}</p>
                <a href="{{ route('user.products.buy', $product->id) }}" 
                   class="mt-3 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                   Buy Now
                </a>
            </div>
        </div>
    @endforeach
@else
    <div class="col-span-full text-center py-8">
        <p class="text-gray-500 text-lg">No products found in this category.</p>
    </div>
@endif