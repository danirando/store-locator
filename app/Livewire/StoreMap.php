<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Store;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class StoreMap extends Component
{
    public $stores;

    public function mount()
    {
        $this->stores = Store::all();
    }

    public function render()
    {
        return view('livewire.store-map');
    }
}
