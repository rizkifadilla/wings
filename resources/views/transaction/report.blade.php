@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title">Transaction Report<a href="{{ route('print')}}" class="btn btn-primary float-right mb-3">Export</a></h5>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Document Code</th>
                                <th scope="col">Document Number</th>
                                <th scope="col">User</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <th scope="row">{{ $transaction['transactionId'] }}</th>
                                <td>{{ $transaction['documentCode'] }}</td>
                                <td>{{ $transaction['documentNumber'] }}</td>
                                <td>{{ $transaction['name'] }}</td>
                                <td>{{ $transaction['status'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
