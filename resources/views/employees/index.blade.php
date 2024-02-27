@extends('adminlte::page')

@section('title', 'Employees')

@section('content_header')
    <h1>Employees</h1>
@stop

@section('content')
    <a href="{{ route('employees.create') }}" class="btn btn-success mb-3">
        Create new employee
    </a>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Employees list</h3>
                </div>
                <div class="card-body">
                    <table id="employees" class="table table-bordered table-hover table-striped table-sm" style="width:100%">
                        <thead>
                        <tr>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Company</th>
                            <th>E-mail</th>
                            <th>Phone</th>
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
@section('plugins.Inputmask', true)
@section('js')
    <script>
        $(function () {
            $('#employees').DataTable({
                serverSide: true,
                ajax: '{{ route('employees.index') }}',
                pageLength: 10,
                info: false,
                searching: true,
                order: [[ 1, 'asc' ]],
                drawCallback: function() {
                    $('#employees tbody tr td').eq(4).inputmask({"mask": "+38 (999) 999-9999"});
                },
                columns:[
                    {data: 'first_name'},
                    {data: 'last_name'},
                    {
                        data: 'company_id',
                        'render': function (data, type, row) {
                            return row.company;
                        }
                    },
                    {data: 'email'},
                    {data: 'phone'},
                    {
                        data: 'created_at',
                        'render': function (data) {
                            return (new Date(data)).toLocaleString('uk-UA');
                        }
                    },
                    {
                        data: null,
                        'render': function (data) {
                            return '<a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" href="employees/' + data.id + '/edit">' +
                                '<i class="fa fa-lg fa-fw fa-pen"></i></a>' +
                                '<form class="d-inline" action="employees/' + data.id + '" method="POST">' +
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
