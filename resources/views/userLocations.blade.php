@extends('layouts.layout')

@section('content')   

    <div class="container">
        {{-- Menu to add userlocations --}}
        <ul class="nav bg-dark rounded">
            <li class="nav-item">
                <a class="nav-link" href="/userlocations/create">Add a Location</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
        <br />

        {{-- Display form errors --}}
        @include('errors')

        @foreach ($userlocations as $userlocation)
        <div class="card">
                <div class="card-body">
                    <h1><a href="https://www.google.com/maps/search/?api=1&query={{ $userlocation->street }}" target="_blank">{{ $userlocation->location_name }}</a></h1><a href="/userlocations/{{ $userlocation->id }}/edit"><i class="fas fa-edit"></i></a><form method="POST" action="/userlocations/{{ $userlocation->id}}">@method("Delete")@csrf<button type="submit" class="card-footer-item btn btn-primary">Delete</button></form>
                    <p>{{ $userlocation->street.", ".$userlocation->city.", ".$userlocation->postal." ".$userlocation->country }}</p>
                </div>
            </div>
            <br />
        @endforeach
        
        
    </div>

@endsection