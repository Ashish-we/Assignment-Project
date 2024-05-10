@extends('templates.layout')

@section('content')
<br>
<br>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
        <a href="{{ route($route . '.create') }}" class="btn btn-primary float-right">
            <i class="fa fa-plus"></i>
            <span class="kt-hidden-mobile">Add new</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered data-table">
                <thead class="table">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    $(function() {

        var table = $('.data-table').DataTable({

            processing: true,

            serverSide: true,

            ajax: "{{ route('assignments.index') }}",

            columns: [

                {
                    data: 'DT_RowIndex',
                    name: 'id'
                },

                {
                    data: 'title',
                    name: 'title'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

    });
</script>

@endsection