@extends('layouts.parent')

@section('title', 'Dashboard - Admin')

@section('content')
    Hello {{ Auth::user()->name }}
@endsection
