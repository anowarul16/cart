@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                Product List
                            </div>
                            <div class="col-md-6">
                                <a href="{{ url('product-create') }}" class="btn btn-sm btn-success">
                                    Add new product
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="product" class="table table-hover">
                            <thead>
                            <tr>
                                <th>S.L</th>
                                <th>Medicine Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$products->isEmpty())
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <a href="{{ url('add-to-cart-'.$product->id) }}" class="btn btn-secondary">Add
                                                to cart</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <form action="{{ url('submit-cart') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-7">
                                    Product Cart List
                                </div>
                                <div class="col-md-5 text-right">
                                    <a href="{{ url('reset-cart') }}" class="btn btn-secondary form-control">Reset Cart</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="product" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>Medicine Name</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!$carts->isEmpty())
                                    @foreach($carts as $cart)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $cart->product_name }}</td>
                                            <td>{{ $cart->price }}</td>
                                            <td>
                                                {{ $cart->status }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-right">
                                        <td></td>
                                        <td>Cart is empty</td>
                                    </tr>
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2" class="text-right">Total Payable -</td>
                                    <td><input type="text" value="{{ $cartTotal }}" name="total" readonly
                                               class="form-control"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-right">Total Paid -</td>
                                    <td><input type="text" value="" name="paid" class="form-control"></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#products').DataTable();
        });
    </script>
@endsection
