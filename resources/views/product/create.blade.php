@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card" style="width: 100%;">
        <div class="card-body">
            <h5 class="card-title">Create New Product</h5>
            <form method="post" action="{{url('products')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mt-3">
                            <label for="ProductName">Product Name</label>
                            <input type="text" class="form-control" id="ProductName" name="productName"
                                placeholder="Soklin Deterjen">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mt-3">
                            <label for="Price">Price Product</label>
                            <input type="number" class="form-control" id="Price" name="price">
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group mt-3">
                            <label for="Currency">Currency</label>
                            <input type="text" class="form-control" id="Currency" name="currency" placeholder="IDR">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mt-3">
                            <label for="Discount">Discount</label>
                            <input type="number" class="form-control" id="Discount" name="discount" placeholder="10">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mt-3">
                            <label for="Dimension">Dimension</label>
                            <input type="text" class="form-control" id="Dimension" name="dimension"
                                placeholder="13 cm x 10 cm">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group mt-3">
                            <label for="Unit">Unit</label>
                            <input type="text" class="form-control" id="Unit" name="unit" placeholder="PCS">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleFormControlFile1">Upload Image</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-lg btn-block">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
