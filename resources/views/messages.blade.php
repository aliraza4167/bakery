@extends('layouts.layout')

@section('content')   

    <div class="container">
        {{-- Menu to add userlocations --}}
        <ul class="nav bg-dark rounded">
            <li class="nav-item">
                <a class="nav-link" href="/messages/create">Send a Message</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
        <br />

        {{-- Display form errors --}}
        @include('errors')
        <div>
            @foreach ($msgs as $msg)
                <li>{{ $msg->body . " was sent by: " }}</li>
            @endforeach
        </div>
        
        
        
    </div>

@endsection