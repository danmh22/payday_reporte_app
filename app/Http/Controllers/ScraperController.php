<?php

namespace App\Http\Controllers;

use DOMDocument;
use DOMXPath;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ScraperController extends Controller
{
    public function index()
    {
        
        $response = Http::get('https://www.bcv.org.ve/');
        $htmlString = (string) $response->getBody();
        libxml_use_internal_errors(true);
        
        $doc = new DOMDocument();
        $doc->loadHTML($htmlString);

        $xpath = new DOMXPath($doc);
        $tasa_bcv = $xpath->evaluate('//div[@id="dolar"][1][1]//strong');
        foreach ($tasa_bcv as $key => $tasa) {
            $tasa_dolar_bcv = $tasa->textContent;
        }
        
        return view('scraper.index', [
            'tasa_dolar_bcv' => $tasa_dolar_bcv,
        ]);

    }

}
