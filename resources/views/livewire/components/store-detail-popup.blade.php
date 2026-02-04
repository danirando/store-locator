<div class="p-3 min-w-64">
    <div class="rounded-lg bg-white shadow-lg border border-gray-200">
        <div class="border-b border-gray-100 pb-3 mb-3">
            <h3 class="font-bold text-lg text-gray-900">{{ $store->nome }}</h3>
        </div>
        
        <div class="space-y-2 text-sm text-gray-700">
            <div class="flex items-start gap-2">
                <span class="text-gray-500 min-w-fit">📍</span>
                <p>{{ $store->indirizzo }}<br><span class="text-gray-600">{{ $store->città }}</span></p>
            </div>
            
            @if($store->telefono)
                <div class="flex items-center gap-2">
                    <span class="text-gray-500">📞</span>
                    <a href="tel:{{ $store->telefono }}" class="text-indigo-600 hover:text-indigo-700 hover:underline">
                        {{ $store->telefono }}
                    </a>
                </div>
            @endif
            
            <div class="flex items-center gap-2 pt-2 border-t border-gray-100 mt-2">
                <span class="text-gray-500">🔖</span>
                <span class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded text-xs font-semibold">
                    {{ $store->totem }}
                </span>
            </div>
        </div>
    </div>
</div>
