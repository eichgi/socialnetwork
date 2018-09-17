@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                @include('partials.validation-errors')
                <div class="card border-0 bg-light px-4 py-2">
                    <form action="{{route('register')}}" method="POST">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label>Username:</label>
                                <input class="form-control" type="text" name="name">
                            </div>
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input class="form-control" type="text" name="first_name">
                            </div>
                            <div class="form-group">
                                <label>Apellido:</label>
                                <input class="form-control" type="text" name="last_name">
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input class="form-control" type="email" name="email">
                            </div>
                            <div class="form-group">
                                <label>Contraseña:</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                            <div class="form-group">
                                <label>Confirmar contraseña:</label>
                                <input class="form-control" type="password" name="password_confirmation">
                            </div>
                            <div class="form-group">
                                <button dusk="register-btn" class="btn btn-primary btn-block">Registro</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection