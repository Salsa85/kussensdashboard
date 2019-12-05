<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class CalculatorController extends Controller
{
    protected static $marge = 1.4;
    protected $products;
    protected $fabrics;
    protected $fillings;
    protected $finishes;
    public function __construct()
    {
        // Get data
        $this->products = json_decode(Storage::get('/data/products.json'), true);
        $this->fabrics = json_decode(Storage::get('/data/fabrics.json'), true);
        $this->fillings = json_decode(Storage::get('/data/fillings.json'), true);
        $this->finishes = json_decode(Storage::get('/data/finishes.json'), true);
    }
    public function index()
    {
        // Return to view
        return view('/calculator', [
            'products' => $this->products,
            'fabrics' => $this->fabrics,
            'fillings' => $this->fillings,
            'finishes' => $this->finishes
        ]);
    }

    public function selectCalculation(Request $request) {
        // Get input data
        $data = [
            'product' => $request->input('uid'),
            'fabric' => $request->input('fabric'),
            'finish' => $request->input('finish'),
            'filling' => $request->input('filling'),
            'length' => $request->input('length'),
            'depth' => $request->input('depth'),
            'thickness' => $request->input('thickness'),
        ];

        $prepareCalc = strpos($data['product'], 'plof') ? $this->plof($data) : $this->strak($data);

        return $prepareCalc;

    }
    public function strak($data)
    {

        $result = [];
        // Set scale based on finish name
        $scale = $data['finish'] === 'Zij-naad' ? 1 : 4;
        // Calculate fabric, filling and finish price
        $fabricPrice = ($data['length'] + ($data['thickness'] * $scale)) / 100 * $data['fabric'];
        $fabricPrice = $data['depth'] + $data['thickness'] <= 70 ? $fabricPrice : $fabricPrice * 2;
        $fillingPrice = $data['filling'] * $data['length'] * $data['depth'] * $data['thickness'] / 1000000;

        // Check if filling is QDF and return extra price
        $isQdf = $this->isQDF($data['filling']);

        // Check finish conditions and get price
        $finishPrice = $this->between($data['length'], $data['finish']) + $isQdf;

        // merga for ajax
        array_push($result, $fabricPrice, $fillingPrice, $finishPrice, $data['product']);

        return $result;
    }

    public function plof($data)
    {

        $result = [];
        // Set scale based on finish name
        $scale = 4;
        // Calculate fabric, filling and finish price
        $fabricPrice = ($data['length'] + ($data['thickness'] * $scale)) / 100 * $data['fabric'];
        $fillingPrice = 186.06 * $data['length'] * $data['depth'] * $data['thickness'] / 1000000;
        $fabricPrice = $data['depth'] + 7 <= 70 ? $fabricPrice : $fabricPrice * 2;

        // Check finish conditions and get price
        $finishPrice = $this->between($data['length'], $data['finish']);

        // merga for ajax
        array_push($result, $fabricPrice, $fillingPrice, $finishPrice, $data['product']);

        return $result;
    }
    public function between($length, $finish)
    {
        // Search conditions based on name
        $key = array_search($finish, array_column($this->finishes, 'name'));
        $conditions = $this->finishes[$key]['conditions'];
        // Calculate price
        $price = 0;
        foreach ($conditions as $value) {
            $condition = explode('-', $value['between']);
            if ($length >= $condition[0] && $length <= $condition[1]) {
                $price = $value['price'];
            }
        }
        return $price;
    }

    public function isQDF($price)
    {
        // Get filling by name
        $key = array_search($price, array_column($this->fillings, 'price'));
        return $this->fillings[$key] && $this->fillings[$key]['name'] == 'Quick Dry (QDF)' ? 10.51 : 0;
    }
}
