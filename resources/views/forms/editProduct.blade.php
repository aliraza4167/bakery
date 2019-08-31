@extends('layouts.layout')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <h2>Edit Product</h2>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/products/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf
                    <div class="form-group">
                        <label for="productName">Product Name: </label>
                        <input type="text" class="form-control" name="productName" id="productName" placeholder="Product Name" value="{{ $product->product_name}}">
                        </div>
                        <div class="form-group">
                        <input type="file" name="filename" id="image" accept="image/*" />
                        </div>
                        <div class="form-group">
                        <label for="price">Set a price for your Product: </label>
                        <input type="number" name="price" id="price" placeholder="$$$" step="0.01" value="{{ $product->dollar_amount }}" />
                        </div>
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="submitButton">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container -->

@endsection
