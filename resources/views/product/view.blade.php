@extends('layouts.app')

@section('content')
<div class="container">
    <br />
    @if (\Session::has('success'))
    <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
    </div><br />
    @endif
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <h5 class="card-title">Product List<a href="/products/create" class="btn btn-success float-right mb-3">Add Product</a></td></h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Currency</th>
                        <th>Discount</th>
                        <th>Dimension</th>
                        <th>Unit</th>
                        <th>Image</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($products as $product)
                    <tr>
                        <td>{{$product['productCode']}}</td>
                        <td>{{$product['productName']}}</td>
                        <td>{{$product['price']}}</td>
                        <td>{{$product['currency']}}</td>
                        <td>{{$product['discount']}} %</td>
                        <td>{{$product['dimension']}}</td>
                        <td>{{$product['unit']}}</td>
                        <td><img src="images/{{ $product['image'] }}" class="rounded mx-auto d-block" width="50px" height="50px"></td>

                        <td><a href="{{action('ProductController@edit', $product['productCode'])}}"
                                class="btn btn-warning">Edit</a></td>
                        <td>
                            <form action="{{action('ProductController@destroy', $product['productCode'])}}"
                                method="post">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
