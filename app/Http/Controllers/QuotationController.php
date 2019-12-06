<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuotationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        // Get data
        $this->products = json_decode(Storage::get('/data/products.json'), true);
        $this->fabrics = json_decode(Storage::get('/data/fabrics.json'), true);
        $this->fillings = json_decode(Storage::get('/data/fillings.json'), true);
        $this->finishes = json_decode(Storage::get('/data/finishes.json'), true);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // Return to view
        return view('/quotation', [
            'products' => $this->products,
            'fabrics' => $this->fabrics,
            'fillings' => $this->fillings,
            'finishes' => $this->finishes
        ]);

    }
}
