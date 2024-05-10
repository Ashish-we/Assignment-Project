@extends('templates.layout')

@section('content')

<form action="{{route($route . '.store')}}" method="post">
    @csrf
    @include('assignment.form')
    <input type="submit" class="btn btn-success" value="Add">
    <a href="{{route($route. '.index')}}" class="btn btn-danger">Cancle</a>
</form>

@endsection