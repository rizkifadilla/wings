@extends('layouts.app')

@section('content')
<div class="container">
<br />
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div><br />
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Product List</h5>
                    <div class="card-deck">
                        @foreach($products as $product)
                        <div class="col-4">
                            <div class="card mt-2">
                                <img src="images/{{ $product['image'] }}" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product['productName'] }}</h5>
                                    <p class="card-text">
                                        Price : Rp. {{ $product['price'] }} <br />
                                        Discount : {{ $product['discount'] }}%<br />
                                        Dimension : {{ $product['dimension'] }} <br />
                                    </p>
                                    <button type="button" class="btn btn-success float-right" data-toggle="modal"
                                        data-target="#exampleModal{{ $product['productCode'] }}">
                                        Buy
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $product['productCode'] }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{url('transactions')}}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group mt-3">
                                                <input type="hidden" class="form-control" id="Discount"
                                                    name="productCode" value="{{ $product['productCode'] }}">
                                                <label for="Discount">Purchase Amount</label>
                                                <input type="number" class="form-control" id="Discount"
                                                    name="purchaseAmount" placeholder="10">
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success btn-lg btn-block">Buy</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Cart Product</h5>
                    <hr>
                    <div class="row">
                        @if ($transactions != 'Empty')
                        @foreach($transactions as $transaction)
                        <div class="col-md-6">
                            <p class="card-text mb-3">{{ $transaction['productName'] }} <br>Purchase Amount :
                                {{ $transaction['quantity'] }}</p>

                        </div>
                        <div class="col-md-4">
                            <p class="card-text"><s>Rp. {{ $transaction['normalPrice'] }}</s> <br>Rp. {{ $transaction['subtotal'] }}</p>
                        </div>
                        <div class="col-md-2">
                        <form action="{{action('TransactionController@destroy', $transaction['id'])}}"
                                method="post">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-outline-danger" type="submit">-</button>
                            </form>
                        </div>
                        @endforeach
                        @else

                        @endif
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            Total
                        </div>
                        <div class="col-md-4">
                            <p class="card-text">Rp. {{ $total }}</p>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                    <a href="{{ action('TransactionController@edit', $transactionId) }}" class="btn btn-success btn-lg btn-block mt-4">Checkout</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
