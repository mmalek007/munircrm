@extends('admin.layouts.app')
@section('content')
    <h1 class="display-6">Update Employee</h1>

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
    {{ Form::open(['action' => ['\App\Http\Controllers\Admin\EmployeeController@update',$employee->id], 'method' => 'put']) }}
        {{Form::hidden('id',$employee->id)}}
    <!-- build our form inputs -->
    <div class="form-group">
        {{ Form::label('company_id', 'Company')}}
        {!! Form::select('company_id', $companies, $employee->company_id, ['class' => 'form-control']) !!}
    </div>

    <!-- build our form inputs -->
    <div class="form-group">
        {{Form::label('firstname', 'First Name')}}
        {{Form::text('firstname', $employee->firstname, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('lastname', 'Last Name')}}
        {{Form::text('lastname', $employee->lastname, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('email', 'E-Mail Address')}}
        {{Form::text('email', $employee->email, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('phone', 'Phone Number')}}
        {{Form::text('phone', $employee->phone, ['class' => 'form-control'])}}
    </div>
    <!-- build the submission button -->
    {{Form::submit('Update!', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}

@endsection
