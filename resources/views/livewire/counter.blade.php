<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
new class extends Component {
    public $count = 0;

    public function increment() {
        $this->count++;
    }
}; ?>

<div class="text-center mt-12">
    <h1 class="text-5xl font-bold mb-4">{{ $count }}</h1>
    <button wire:click="increment" class="px-5 py-2.5 text-2xl bg-gray-200 hover:bg-gray-300 rounded cursor-pointer transition">
        +
    </button>
</div>