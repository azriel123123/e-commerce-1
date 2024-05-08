@extends('layouts.parent')

@section('title', 'User')

@section('content')

<h1>{{ Auth::user()->name }}</h1>

@endsection