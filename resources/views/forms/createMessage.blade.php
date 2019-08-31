@extends('layouts.layout')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-md-6">
                <h2>Send a Message</h2>
                
                @include('errors')

                <form action="/messages" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="to">Send Message To: </label>
                        <select name="recipients" class="form-control form-control-lg">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="messageBody">Message Body: </label>
                        <textarea class="form-control" name="messageBody" id="messageBody" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="submitButton">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.container -->

@endsection
