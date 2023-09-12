<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
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
        $id = Auth::user()->id;
        $transactions = \App\TransactionHeader::where('userId', $id)
                            ->where('status', 'PAID')
                            ->join('users', 'transaction_headers.userId', '=', 'users.id')
                            ->get();
        return view('home',compact('transactions'));
    }
}
