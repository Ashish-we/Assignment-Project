@extends('adminlte::page')

@section('title', $title)

@section('content_header')
@include('sweetalert::alert')
@endsection

@section('content')


@yield('content')

@stop

@section('js')
@yield('js')

@stop