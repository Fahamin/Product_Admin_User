<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Category Selector --}}
            <div class="mb-6">
                <label for="category" class="block mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                    Select Category
                </label>
                <select id="category" name="category" 
                        class="w-full md:w-1/3 border-gray-300 rounded-lg shadow-sm">
                    <option value="">-- Choose Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Products Section --}}
            <div id="products-container" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                {{-- Products will be loaded here via AJAX --}}
            </div>
        </div>
    </div>

    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function () {
    console.log('Document ready - jQuery working');
    
    $('#category').change(function () {
        const categoryId = $(this).val();
        console.log('Category selected:', categoryId);
        
        // Test if jQuery is working
        $('#products-container').html(`
            <div class="col-span-full">
                <p class="text-green-500">jQuery is working! Selected category: ${categoryId}</p>
                <p class="text-blue-500">Now testing AJAX call...</p>
            </div>
        `);
        
        if (categoryId) {
            // Test direct URL first
            const testUrl = '/user/products/by-category?category_id=' + categoryId;
            console.log('Testing URL:', testUrl);
            
            $.get(testUrl)
                .done(function(response) {
                    console.log('✅ Direct GET success:', response);
                    $('#products-container').html(response);
                })
                .fail(function(xhr, status, error) {
                    console.error('❌ Direct GET failed:', {status, error, response: xhr.responseText});
                    $('#products-container').html(`
                        <div class="col-span-full text-red-500">
                            <p>Failed to load products</p>
                            <p>Status: ${xhr.status}</p>
                            <p>Error: ${error}</p>
                            <p>Response: ${xhr.responseText}</p>
                        </div>
                    `);
                });
        }
    });
});
</script>
</x-app-layout>