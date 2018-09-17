@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                @include('partials.validation-errors')
                <div class="card border-0 bg-light px-4 py-2">
                    <form action="{{route('login')}}" method="POST">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label>Email:</label>
                                <input class="form-control" type="email" name="email">
                            </div>
                            <div class="form-group">
                                <label>Contraseña:</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                            <button dusk="login-btn" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection