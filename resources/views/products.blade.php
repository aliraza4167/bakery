@extends('layouts.layout')

@section('content')   

    <div class="container">
        {{-- Menu to edit and add products --}}
        <ul class="nav bg-dark rounded">
            <li class="nav-item">
                <a class="nav-link" href="/products/create">Add a Product</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
        {{-- Display form errors --}}
        @include('errors')

        <div class="card-columns">
            @foreach($products as $product)
                <div class="card product">
                    <img src="\images\{{ $product->image_url }}" width="400" height="400" class="card-img-top" alt="...">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->product_name }}</h5>
                        @if ($product->promotion()->exists())
                            <p class="card-text strike">${{ $product->dollar_amount }}</p>
                            <p class="card-text">${{ $product->promotion->promotional_price }}</p>
                        @else
                            <p class="card-text">${{ $product->dollar_amount }}</p>
                        @endif
                        
                    </div>
                    
                    <footer class="card-footer">
                        <div class="d-flex flex-row">
                            @if ($product->promotion()->exists())
                                <div class="p-2"><form method="POST" action="/promotions/{{$product->promotion->id}}">@method("Delete")@csrf<button type="submit" class="card-footer-item btn btn-primary">Remove Promotion</button></form></div>
                            @else
                                
                                <div class="p-2"><form method="POST" action="/products/{{$product->id}}/promotion">@csrf<input type="number" name="promotional_price" placeholder="$$$" step="0.01" /><button type="submit" class="btn btn-primary" id="submitButton">Add a Promotion</button></form></div>
                            @endif
                            
                            <div class="p-2"><a href="/products/{{ $product->id }}/edit" class="card-footer-item btn btn-primary">Edit</a></div>
                            <div class="p-2"><form method="POST" action="/products/{{ $product->id}}">@method("Delete")@csrf<button type="submit" class="card-footer-item btn btn-primary">Delete</button></form></div>
                        </div>
                        
                    </footer>
                </div>

                {{-- Promotion Modal --}}
                <div class="modal fade" id="promotionModal" tabindex="-1" role="dialog" aria-labelledby="promotionModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="promotionModalLabel">Add a Promotion to the Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            {{ $product->product_name }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!-- /.container -->

    
@endsection
