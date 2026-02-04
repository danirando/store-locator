<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\StoresImport;
use Maatwebsite\Excel\Facades\Excel;

class StoreController extends Controller
{
    // Questa funzione mostra la pagina con il form per caricare il file
    public function showImportForm()
    {
        return view('import-stores'); 
    }

    // Questa funzione gestisce l'upload e l'importazione vera e propria
    public function import(Request $request) 
    {
        // Validazione minima: controlla che ci sia un file e che sia csv/excel
        $request->validate([
            'file_csv' => 'required|mimes:csv,txt,xlsx'
        ]);

        Excel::import(new StoresImport, $request->file('file_csv'));
        
        return back()->with('success', 'Importazione completata con successo!');
    }
}