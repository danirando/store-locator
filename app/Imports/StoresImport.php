<?php

namespace App\Imports;

use App\Models\Store;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; // Importante per usare i nomi delle colonne

class StoresImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Store([
            'nome'        => $row['nome'],
            'indirizzo'   => $row['indirizzo'],
            'città'       => $row['citta'], // Nota: se nel CSV c'è l'accento, Laravel-Excel lo "slugga" spesso togliendolo
            'latitudine'  => $row['latitudine'],
            'longitudine' => $row['longitudine'],
            'telefono'    => $row['telefono'],
            'totem'       => $row['totem'],
        ]);
    }
}
