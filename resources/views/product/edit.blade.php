@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <h5 class="card-title">Create New Product</h5>
            <form method="post" action="{{action('ProductController@update', $productCode)}}" enctype="multipart/form-data">
                @csrf
                <input name="_method" type="hidden" value="PATCH">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mt-3">
                            <label for="ProductName">Product Name</label>
                            <input type="text" class="form-control" id="ProductName" name="productName" value="{{$product->productName}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mt-3">
                            <label for="Price">Price Product</label>
                            <input type="number" class="form-control" id="Price" name="price" value="{{$product->price}}">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group mt-3">
                            <label for="Currency">Currency</label>
                            <input type="text" class="form-control" id="Currency" name="currency" value="{{$product->currency}}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mt-3">
                            <label for="Discount">Discount</label>
                            <input type="number" class="form-control" id="Discount" name="discount" value="{{$product->discount}}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mt-3">
                            <label for="Dimension">Dimension</label>
                            <input type="text" class="form-control" id="Dimension" name="dimension" value="{{$product->dimension}}">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mt-3">
                            <label for="Unit">Unit</label>
                            <input type="text" class="form-control" id="Unit" name="unit" value="{{$product->unit}}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-warning btn-lg btn-block">Edit</button>
            </form>
        </div>
    </div>
</div>
@endsection
