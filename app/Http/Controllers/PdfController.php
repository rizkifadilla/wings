<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Auth;

class PdfController extends Controller
{
    public function print()
    {
        $id = Auth::user()->id;
        $transactions = \App\TransactionHeader::where('userId', $id)
                            ->where('status', 'PAID')
                            ->join('users', 'transaction_headers.userId', '=', 'users.id')
                            ->get();
        $pdf = PDF::loadview('home', compact('transactions'))->setPaper('A4','potrait');
        return $pdf->stream();
    }
}
