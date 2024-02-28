@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>Companies</h1>
@stop

@section('content')
    <a href="{{ route('companies.create') }}" class="btn btn-success mb-3">
        Create new company
    </a>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Companies list</h3>
                </div>
                <div class="card-body table-responsive">
                    <table id="companies" class="table table-bordered table-hover table-striped table-sm" style="width:100%">
                        <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Name</th>
                            <th>E-mail</th>
                            <th>Website</th>
                            <th>Created</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('plugins.Datatables', true)
@section('js')
    <script>
        $(function () {
            $('#companies').DataTable({
                serverSide: true,
                ajax: '{{ route('companies.index') }}',
                pageLength: 10,
                info: false,
                searching: true,
                order: [[ 1, 'asc' ]],
                columns:[
                    {
                        data: 'logo',
                        'render': function (data) {
                            return data ? '<img src="{{ asset('storage/companies') }}/' + data + '"' +
                            'width="100" style="aspect-ratio: 4/3;-o-object-fit: contain;object-fit: contain;" />' : '';
                        },
                        orderable: false,
                        searchable: false
                    },
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'website'},
                    {
                        data: 'created_at',
                        'render': function (data) {
                            return (new Date(data)).toLocaleString('uk-UA');
                        }
                    },
                    {
                        data: null,
                        'render': function (data) {
                            return '<a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" href="companies/' + data.id + '/edit">' +
                                '<i class="fa fa-lg fa-fw fa-pen"></i></a>' +
                                '<form class="d-inline" action="companies/' + data.id + '" method="POST">' +
                                '@method('DELETE')' +
                                '@csrf' +
                                '<button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="return confirm(\'Are you sure you want to delete?\')">' +
                                '<i class="fa fa-lg fa-fw fa-trash"></i></button></form>';
                        },
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@stop
