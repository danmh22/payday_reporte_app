<?php

namespace App\Imports;

use App\Models\Factura;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class FacturasImport implements ToModel, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    private $users;

    public function __construct()
    {
        $this->users = User::pluck('id', 'codigo_aliado');
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {
        return new Factura([
            'users_id'     => $this->users[$row['aliado']],
            'concepto'     => $row['concepto'],
            'monto_deudor' => $row['monto'],
            'status'       => '1',
        ]);
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
