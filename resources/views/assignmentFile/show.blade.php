@extends('templates.layout')

@section('content')

<a href="{{'/storage/docs/' . $item->file_name}}" class="btn btn-primary">Download</a>

@endsection