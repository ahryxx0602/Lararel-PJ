@extends('clients.layouts.client')

@section('title')
    {{ $title }}
@endsection

@section('sidebar')
    @parent
    <h3>Home sidebar</h3>
@endsection

@section('content')
    <h1>
        Welcome to Home Page
    </h1>
@endsection

@section('css')
@endsection
@section('js')
@endsection
