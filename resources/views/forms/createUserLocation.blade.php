@extends('layouts.layout')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <h2>Add a Location</h2>
                
                @include('errors')

                <form action="/userlocations" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="street">Location Name: </label>
                        <input type="text" name="location_name" id="location_name" placeholder="Bakersville" />
                    </div>
                    <div class="form-group">
                        <label for="street">Street: </label>
                        <input type="text" name="street" id="street" placeholder="123 Summer side st" />
                    </div>
                    <div class="form-group">
                        <label for="city">City: </label>
                        <input type="text" name="city" id="city" placeholder="Toronto" />
                    </div>
                    <div class="form-group">
                        <label for="country">Country: </label>
                        <input type="text" name="country" id="country" placeholder="Canada" />
                    </div>
                    <div class="form-group">
                        <label for="postal">Country: </label>
                        <input type="text" name="postal" id="postal" placeholder="L1T 1T1" />
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
