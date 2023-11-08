<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use App\Models\Tasa;
use DOMDocument;
use DOMXPath;

class ObtenerTasaDolar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'obtener:tasadolar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Obtener la tasa del dolar desde la página del BCV';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->timeout(300)->get('https://www.bcv.org.ve/');
        $htmlString = (string) $response->getBody();
        libxml_use_internal_errors(true);
        
        $doc = new DOMDocument();
        $doc->loadHTML($htmlString);
        
        $xpath = new DOMXPath($doc);
        $tasa_bcv = $xpath->evaluate('//div[@id="dolar"][1][1]//strong');
        foreach ($tasa_bcv as $key => $tasa) {
            $tasa_dolar_bcv = $tasa->textContent;
        }

        $tasa_hoy = Tasa::create([
            'tasa_dolar' => $tasa_dolar_bcv,
        ]);
    }
}
