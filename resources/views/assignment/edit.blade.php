@extends('templates.layout')

@section('content')

<form action="{{route($route. '.update', $item->id)}}" method="post">
    @csrf
    @method('PUT')
    @include('assignment.form')
    <input type="submit" class="btn btn-success" value="Update">
    <a href="{{route($route. '.index')}}" class="btn btn-danger">Cancle</a>
</form>

@endsection