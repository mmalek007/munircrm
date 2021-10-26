@extends('admin.layouts.app')
@section('content')
    <h1 class="display-6">Create New Company</h1>

    <hr/>

    <!-- if validation in the controller fails, show the errors -->
    @if ($errors->any())
        <div class="alert alert-danger mb-5">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Open the form with the store function route. -->
    {{ Form::open(['action' => 'App\Http\Controllers\Admin\CompanyController@store','enctype'=>"multipart/form-data"]) }}

    <!-- Include the CRSF token -->
    {{Form::token()}}


    <!-- build our form inputs -->
    <div class="form-group">
        {{Form::label('name', 'Company Name')}}
        {{Form::text('name', Request::old('name'), ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('email', 'E-Mail Address')}}
        {{Form::text('email', Request::old('email'), ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('logo', 'Logo')}}
        {{Form::file('logo', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('website', 'Website')}}
        {{Form::text('website', Request::old('website'), ['class' => 'form-control'])}}
    </div>
    <!-- build the submission button -->
    {{Form::submit('Create!', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

@endsection
