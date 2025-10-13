@extends('layouts.app')

@section('title', 'Welcome to VisiQ')

@section('content')

    
    @include('home.header')

    @include('home.hero')

    @include('home.about')

    @include('home.features')

    @include('home.services')

    {{-- @include('home.contact') --}}

    @include('home.footer')

@endsection
