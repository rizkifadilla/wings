<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $checkStatusTransaction = \App\TransactionHeader::where('userId', $id)->orderBy('created_at', 'desc')->first();
        if (!$checkStatusTransaction || $checkStatusTransaction->status == 'PAID'){
            $transactions = "Empty" ;
            $total = "0";
        } else {
            $transactions = \App\TransactionDetail::where('transactionId', $checkStatusTransaction->transactionId)
                                ->join('products', 'transaction_details.productCode', '=', 'products.productCode')
                                ->selectRaw('*, products.price * transaction_details.quantity as normalPrice')
                                ->get();
            $total = \App\TransactionDetail::where('transactionId', $checkStatusTransaction->transactionId)->sum('transaction_details.subtotal');
        }
        $products = \App\Product::all();
        $transactionId = $checkStatusTransaction->transactionId;
        return view('/transaction/view',compact('products', 'transactions', 'total', 'transactionId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::user()->id;
        $transactions = \App\TransactionHeader::where('userId', $id)
                            ->where('status', 'PAID')
                            ->join('users', 'transaction_headers.userId', '=', 'users.id')
                            ->get();
        return view('/transaction/report',compact('transactions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $purchaseAmount = $request->get('purchaseAmount');
        $product = \App\Product::where('productCode', $request->get('productCode'))->first();
        $subTotal = $purchaseAmount * ($product->price - ($product->price * ($product->discount / 100)));
        $checkStatusTransaction = \App\TransactionHeader::where('userId', $id)->orderBy('created_at', 'desc')->first();
        if (!$checkStatusTransaction || $checkStatusTransaction->status == 'PAID'){
            $transactionHeader = new \App\TransactionHeader;
            $unikId = random_int(1000000, 9999999);
            $transactionHeader->transactionId = "TRX".$unikId;
            $transactionHeader->documentCode = "TRX";
            $transactionHeader->documentNumber = $unikId;
            $transactionHeader->userId = $id;
            $transactionHeader->status = 'WAITING';
            $transactionHeader->save();

            $transactionDetail = new \App\TransactionDetail;
            $transactionDetail->transactionId = "TRX".$unikId;
            $transactionDetail->productCode = $request->get('productCode');
            $transactionDetail->subtotal = $subTotal;
            $transactionDetail->quantity = $purchaseAmount;
            $transactionDetail->save();
        } else {
            $transactionDetail = new \App\TransactionDetail;
            $transactionDetail->transactionId = $checkStatusTransaction->transactionId;
            $transactionDetail->productCode = $request->get('productCode');
            $transactionDetail->subtotal = $subTotal;
            $transactionDetail->quantity = $purchaseAmount;
            $transactionDetail->save();
        }
        return redirect('transactions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        \App\TransactionHeader::where('transactionId', $id)
            ->update([
                'status' => 'PAID'
            ]);

        return redirect('transactions')->with('success', 'the transaction was successful');  ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\TransactionDetail::where('id', $id)->delete();

        return redirect('transactions');
    }
}
