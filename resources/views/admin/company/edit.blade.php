@extends('admin.layouts.app')
@section('content')
    <h1 class="display-6">Update Company</h1>

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

    <!-- Open the form with the update function route. -->
    {{ Form::open(['action' => ['\App\Http\Controllers\Admin\CompanyController@update',$company->id], 'method' => 'put','enctype'=>"multipart/form-data"]) }}
        {{Form::hidden('id',$company->id)}}
    <!-- build our form inputs -->
    <div class="form-group">
        {{Form::label('name', 'Company Name')}}
        {{Form::text('name', $company->name, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('email', 'E-Mail Address')}}
        {{Form::text('email', $company->email, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('logo', 'Logo')}}
        <img src="{{ url('public/storage/'.$company->logo) }}" width="100" height="100" />
        {{Form::file('logo', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('website', 'Website')}}
        {{Form::text('website', $company->website, ['class' => 'form-control'])}}
    </div>
    <!-- build the submission button -->
    {{Form::submit('Update!', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

@endsection
