@extends('adminlte::page')

@section('title', 'Create new employee')

@section('content_header')
    <h1>Create new employee</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form method="post" action="{{ route('employees.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name" placeholder="Enter first name" value="{{ old('first_name') }}" />

                            @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" id="last_name" placeholder="Enter last name" value="{{ old('last_name') }}" />

                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="company_id">Company</label>
                            <select class="form-control select2 @error('company_id') is-invalid @enderror" name="company_id"></select>

                            @error('company_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" value="{{ old('email') }}">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" data-inputmask='"mask": "+38 (999) 999-9999"' data-mask class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Enter phone" value="{{ old('phone') }}">

                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('plugins.Select2', true)
@section('plugins.Inputmask', true)
@section('css')
    <style>
        .select2-container .select2-selection--single {
            height: auto;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 10px;
        }
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
        }
    </style>
@stop

@section('js')
    <script>
        $(function () {
            $('.select2').select2({
                placeholder: 'Slect value',
                allowClear: true,
                data: {!! $companies !!}
            })
            $('[data-mask]').inputmask({removeMaskOnSubmit: true})
        });
    </script>
@stop
