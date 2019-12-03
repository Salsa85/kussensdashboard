<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Error;

class AddError extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $errors = Error::orderBy('id', 'desc')->paginate(10);
        $totals = Error::get()->sum('amount');

        return view('/errors', ['errors' => $errors, 'totals' => $totals]);

    }

    public function store(Request $request) {
        Error::create([
            'title' => $request->title,
            'order' => $request->order,
            'description' => $request->description,
            'amount' => $request->amount,
            'paid' => $request->paid,
        ]);

        return redirect()->route('error');
    }

    public function updatePayment(Request $request) {

        /**
         * Get Error id from selected checkbox
         * @var integer
         */
        $id = $request->input('id');

        /**
         * Update paid colum in databse
         * @return void
         */
        Error::where('id', $id)->update(['paid' => 1]);

        return view('/update');
    }

    public function removePayment(Request $request) {

        $id = $request->input('id');
        Error::where('id', $id)->update(['paid' => 0]);
        
        return view('/remove-paid');
    }
}
