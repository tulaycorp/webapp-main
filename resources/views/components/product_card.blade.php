<div class="group">
  <div class="modern-card dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl">
    <a href="{{ route('products.show', ['id' => $product->id]) }}" class="block relative aspect-square overflow-hidden bg-gray-100 dark:bg-gray-700">
      <img src="{{ $product->img ?? $product->image_url }}" 
           alt="{{ $product->name }}" 
           class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
      @if($product->featured)
        <span class="absolute top-4 left-4 px-3 py-1 bg-primary dark:bg-white text-white dark:text-gray-900 text-xs uppercase tracking-wider font-medium">Featured</span>
      @endif
    </a>
    <div class="p-6">
      <p class="text-xs text-secondary dark:text-gray-400 uppercase tracking-wider mb-2">{{ $product->category }}</p>
      <a href="{{ route('products.show', ['id' => $product->id]) }}" class="block">
        <h3 class="text-lg font-semibold text-primary dark:text-white mb-2 truncate group-hover:text-secondary transition-colors">{{ $product->name }}</h3>
      </a>
      <div class="flex items-center justify-between">
        <span class="text-xl font-bold text-primary dark:text-white">${{ number_format($product->price, 2) }}</span>
        <button data-add="{{ $product->id }}" 
                class="px-4 py-2 bg-primary dark:bg-white text-white dark:text-gray-900 text-sm uppercase tracking-wider font-medium hover:opacity-90 transition-opacity">
          Add
        </button>
      </div>
    </div>
  </div>
</div>
