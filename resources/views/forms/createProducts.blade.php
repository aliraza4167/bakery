@extends('layouts.layout')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <h2>Add a Product</h2>
                
                @include('errors')

                <form action="/products" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="productName">Product Name: </label>
                        <input type="text" class="form-control" name="productName" id="productName" placeholder="Product Name">
                        </div>
                        <div class="form-group">
                        <input type="file" name="filename" id="image" accept="image/*" />
                        </div>
                        <div class="form-group">
                        <label for="price">Set a price for your Product: </label>
                        <input type="number" name="price" id="price" placeholder="$$$" step="0.01" />
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
