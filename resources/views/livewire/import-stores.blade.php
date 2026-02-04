<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StoresImport;

new #[Layout('layouts.app')] class extends Component {
    use WithFileUploads;

    public $file_csv;
    public $successMessage = '';

    public function import()
    {
        $this->validate([
            'file_csv' => 'required|mimes:csv|max:10240', // Solo CSV, max 10MB
        ]);

        try {
            Excel::import(new StoresImport, $this->file_csv);
            $this->successMessage = 'Importazione completata con successo!';
            $this->reset('file_csv');
        } catch (\Exception $e) {
            $this->addError('file_csv', 'Errore durante l\'importazione: ' . $e->getMessage());
        }
    }
}; ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-6">Importa Stores</h2>

                @if ($successMessage)
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Successo!</strong>
                        <span class="block sm:inline">{{ $successMessage }}</span>
                    </div>
                @endif

                <form wire:submit="import" class="space-y-4">
                    <!-- Istruzioni e Colonne Richieste -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                        <h3 class="text-sm font-semibold text-blue-900 mb-3">📋 Formato File Richiesto</h3>
                        <div class="text-sm text-blue-800 mb-3">
                            <p class="font-medium mb-2">Il file deve essere in formato <span class="font-bold">.CSV</span> e contenere le seguenti colonne:</p>
                            <ul class="list-disc list-inside space-y-1 ml-2">
                                <li><span class="font-semibold">nome</span> - Nome dello store</li>
                                <li><span class="font-semibold">indirizzo</span> - Indirizzo completo</li>
                                <li><span class="font-semibold">città</span> - Città dello store</li>
                                <li><span class="font-semibold">latitudine</span> - Coordinata latitudine (decimale)</li>
                                <li><span class="font-semibold">longitudine</span> - Coordinata longitudine (decimale)</li>
                                <li><span class="font-semibold">telefono</span> - Numero di telefono (opzionale)</li>
                                <li><span class="font-semibold">totem</span> - Identificativo totem</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Seleziona file CSV</label>
                        <input wire:model="file_csv" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="file_input" type="file" accept=".csv">
                        @error('file_csv') 
                            <span class="text-red-500 text-sm">{{ $message }}</span> 
                        @enderror
                        <div wire:loading wire:target="file_csv" class="text-sm text-gray-500 mt-1">Caricamento...</div>
                    </div>

                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none disabled:opacity-50" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="import">Importa</span>
                        <span wire:loading wire:target="import">Importazione in corso...</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
