@if($isShow)
<a href="{{route($route .'.show', $id)}}" class="edit btn btn-primary">Show</a>
@endif

@if($isEdit)
<a href="{{route($route .'.edit', $id)}}" class="edit btn btn-success">Edit</a>
@endif

@if($isDelete)
<a href="{{route($route . '.destroy', $id)}}" class="btn btn-danger" data-confirm-delete="true">Delete</a>
@endif