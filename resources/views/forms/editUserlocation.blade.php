@extends('layouts.layout')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <h2>Edit {{ $userlocation->location_name }} Location</h2>
                
                @include('errors')

                <form action="/userlocations/{{ $userlocation->id }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="street">Location Name: </label>
                        <input type="text" name="location_name" id="location_name" value="{{ $userlocation->location_name }}" />
                    </div>
                    <div class="form-group">
                        <label for="street">Street: </label>
                        <input type="text" name="street" id="street" value="{{ $userlocation->street }}" />
                    </div>
                    <div class="form-group">
                        <label for="city">City: </label>
                        <input type="text" name="city" id="city" value="{{ $userlocation->city }}" />
                    </div>
                    <div class="form-group">
                        <label for="country">Country: </label>
                        <input type="text" name="country" id="country" value="{{ $userlocation->country }}" />
                    </div>
                    <div class="form-group">
                        <label for="postal">Country: </label>
                        <input type="text" name="postal" id="postal" value="{{ $userlocation->postal }}" />
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
