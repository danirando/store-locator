<div class="w-full h-[80vh] overflow-hidden flex flex-row gap-6">
    <style>
        .leaflet-container { z-index: 1 !important; height: 100%; min-height: 500px; }
        #map { height: 100%; min-height: 500px; background: #e5e7eb; }
    </style>

    <!-- Left Column: Store List -->
    <div class="w-full md:w-1/3 bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden h-full flex flex-col">
        <div class="p-4 bg-white dark:bg-gray-800 border-b dark:border-gray-700 z-10 shrink-0">
            <h2 class="text-xl font-bold text-gray-800 dark:text-white">Store List ({{ count($stores) }} stores)</h2>
        </div>
        <div class="flex-1 overflow-y-auto overflow-x-hidden p-4 space-y-4">
            @foreach($stores as $store)
                <div class="p-4 border rounded-lg hover:shadow-md transition bg-gray-50 dark:bg-gray-700 dark:border-gray-600 cursor-pointer" 
                     wire:key="store-{{ $store->id }}"
                     onclick="focusOnStore({{ $store->latitudine }}, {{ $store->longitudine }})">
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white">{{ $store->nome }}</h3>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">{{ $store->indirizzo }}, {{ $store->città }}</p>
                    @if($store->telefono)
                        <p class="text-gray-500 dark:text-gray-400 text-xs mt-1">Tel: {{ $store->telefono }}</p>
                    @endif
                    <p class="text-xs mt-2 text-indigo-600 dark:text-indigo-400 font-semibold">
                        {{ $store->totem }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Right Column: Map -->
    <div wire:ignore class="w-full md:w-2/3 h-full rounded-lg shadow-lg relative overflow-hidden">
        <div id="map" class="w-full h-full"></div>
    </div>

    @script
    <script>
        console.log('=== MAP SCRIPT LOADING ===');
        
        let mapInstance = null;
        const storesData = @json($stores);
        
        console.log('Stores data:', storesData);
        console.log('Number of stores:', storesData ? storesData.length : 0);

        function initializeMap() {
            console.log('initializeMap called');
            
            const container = document.getElementById('map');
            if (!container) {
                console.error('Map container #map not found!');
                setTimeout(initializeMap, 500);
                return;
            }
            
            console.log('Map container found:', container);
            
            // Check if Leaflet is loaded
            if (typeof L === 'undefined') {
                console.error('Leaflet (L) is not defined! Check if leaflet.js is loaded.');
                setTimeout(initializeMap, 500);
                return;
            }
            
            console.log('Leaflet is loaded');

            try {
                // Remove existing map if any
                if (mapInstance) {
                    console.log('Removing existing map');
                    mapInstance.remove();
                    mapInstance = null;
                }

                // Create map
                console.log('Creating new map instance');
                mapInstance = L.map('map').setView([41.8719, 12.5674], 6);
                
                console.log('Map created, adding tile layer');
                
                // Add tile layer
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(mapInstance);
                
                console.log('Tile layer added');

                // Add markers
                if (storesData && Array.isArray(storesData)) {
                    console.log('Adding markers for', storesData.length, 'stores');
                    
                    let markersAdded = 0;
                    storesData.forEach((store, index) => {
                        if (store.latitudine && store.longitudine) {
                            const lat = parseFloat(store.latitudine);
                            const lng = parseFloat(store.longitudine);
                            
                            if (!isNaN(lat) && !isNaN(lng)) {
                                L.marker([lat, lng])
                                    .addTo(mapInstance)
                                    .bindPopup(`<b>${store.nome}</b><br>${store.indirizzo}, ${store.città}`);
                                markersAdded++;
                            } else {
                                console.warn(`Store ${index} has invalid coordinates:`, lat, lng);
                            }
                        } else {
                            console.warn(`Store ${index} missing coordinates:`, store);
                        }
                    });
                    
                    console.log('Markers added:', markersAdded);
                } else {
                    console.error('storesData is not an array:', storesData);
                }

                // Fix grey tiles
                setTimeout(() => {
                    console.log('Calling invalidateSize');
                    mapInstance.invalidateSize();
                }, 300);
                
                console.log('=== MAP INITIALIZED SUCCESSFULLY ===');

            } catch (error) {
                console.error('Error initializing map:', error);
            }
        }

        // Global function for clicking stores
        window.focusOnStore = function(lat, lng) {
            console.log('focusOnStore called:', lat, lng);
            if (mapInstance) {
                mapInstance.setView([lat, lng], 15);
                setTimeout(() => mapInstance.invalidateSize(), 100);
            }
        };

        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeMap);
        } else {
            initializeMap();
        }
    </script>
    @endscript
</div>