@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Create New Product</h5>
            </div>
            <div class="card-body">
                <form action="{{ url('store-product') }}" method="post">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <label>Product Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="product_name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Product Price</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" class="form-control" name="price">
                                </div>
                            </div>
                            <div class="row justify-content-end mt-5">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary form-control">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
