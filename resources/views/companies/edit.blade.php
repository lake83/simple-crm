@extends('adminlte::page')

@section('title', 'Create new company')

@section('content_header')
    <h1>Create new company</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <form method="post" action="{{ route('companies.update', ['company' => $company->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter name" value="{{ old('name', $company->name ?? null) }}">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email" value="{{ old('email', $company->email ?? null) }}">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" name="website" class="form-control @error('website') is-invalid @enderror" id="website" placeholder="Enter website" value="{{ old('website', $company->website ?? null) }}">

                            @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        @if ($company->logo)
                        <img src="{{ asset('storage/companies/' . $company->logo) }}"
                             alt="{{ $company->name }}"
                             width="100"
                             style="aspect-ratio: 4/3;-o-object-fit: contain;object-fit: contain;" />
                        @endif

                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="logo" class="custom-file-input @error('logo') is-invalid @enderror" id="logo" value="{{ old('logo', $company->logo ?? null) }}">
                                    @error('logo')
                                    <span class="invalid-feedback position-absolute pt-5 mt-3" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <label class="custom-file-label" for="logo">Choose file</label>
                                </div>
                            </div>
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

@section('plugins.FileInput', true)
@section('js')
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@stop
