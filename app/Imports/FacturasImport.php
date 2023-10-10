<?php

namespace App\Imports;

use App\Models\Aliado;
use App\Models\Factura;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class FacturasImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    private $aliado;

    public function __construct()
    {
        $this->aliado = Aliado::pluck('id', 'codigo_aliado');
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {
        // Combrobar si existe el aliado
        $queryAliado = Aliado::where('codigo_aliado', '=', $row['aliado'])->exists();
        if ($queryAliado == true) 
        {
            return new Factura([
                'aliado_id'    => $this->aliado[$row['aliado']],
                'concepto'     => $row['concepto'],
                'monto_deudor' => $row['monto'],
                'categoria'    => $row['categoria'],
                'status'       => '1',
            ]);
        } else {

        }

    }

    public function batchSize(): int
    {
        return 50;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
