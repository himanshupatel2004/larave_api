@extends('layouts.app')

@section('content')
<div class="container">
    @include('error_message')
    {{-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div> --}}

    <h1>Welcome {{ $user->name}}, To Home Page</h1>
    <div class="card" style="width:400px">
        {{--  {{ dd(asset($user->image)) }}  --}}
        <img class="card-img-top" src="{{ asset($user->image) }}" alt="Card image" style="width:100%">
        <div class="card-body">
            <h4 class="card-title">{{ $user->first_name.' '.$user->last_name}}</h4>
            <p class="card-text">Email : {{ $user->email}}</p>
            <p class="card-text">Intersted In    : {{ $user->hobby}}</p>
            <p class="card-text">Phone Number : {{ $user->phone}}</p>
            <a href="{{ 'contact/create' }}" class="btn btn-primary">Add Contact</a>
            <a href="{{ 'contact/list' }}" class="btn btn-danger">See Contacts</a>
            <a href="{{ url('logout') }}" class="btn btn-primary">Logout</a>
        </div>
    </div>
</div>
@endsection
