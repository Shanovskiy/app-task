@extends('layouts.app')
@section('title', 'Приложение')
@section('content')
<div class="navbar navbar-light bg-light mt-5 border rounded shadow-sm">
    <div class="container w-50">
        <form class="d-flex w-100" action="{{route('parse')}}" method="post">
            @csrf
            <input class="form-control me-2 w-100" type="search" placeholder="Type url here..." name="url" aria-label="Search" required>
            <button class="btn btn-outline-primary" id="change-button" type="submit">GO</button>
        </form>
    </div>
</div>
@endsection
