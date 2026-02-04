<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Store;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\View;

#[Layout('layouts.app')]
class StoreMap extends Component
{
    public $stores;
    public $searchCity = '';

    public function mount()
    {
        $this->stores = Store::all();
    }

    public function getFilteredStores()
    {
        if (empty($this->searchCity)) {
            return $this->stores;
        }

        return $this->stores->filter(function ($store) {
            return stripos($store->città, $this->searchCity) !== false;
        });
    }

    public function render()
    {
        return view('livewire.store-map', [
            'filteredStores' => $this->getFilteredStores(),
        ]);
    }

    public function getStorePopup($storeId)
    {
        $store = Store::findOrFail($storeId);
        return View::make('livewire.components.store-detail-popup', ['store' => $store])->render();
    }
}
