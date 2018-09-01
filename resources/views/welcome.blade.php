@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card border-0 bg-light">
                    <status-form></status-form>
                </div>
                <statuses-list></statuses-list>
            </div>
        </div>
    </div>
@endsection