@extends('admin.layouts.app')
@section('content')
    <h1 class="display-6">Employee Details</h1>

    <hr/>

    <dl>
        <dt>Company</dt>
        <dd>{{$employee->companies->name}}</dd>

        <dt>First Name</dt>
        <dd>{{$employee->firstname}}</dd>

        <dt>Last Name</dt>
        <dd>{{$employee->lastname}}</dd>

        <dt>Email</dt>
        <dd>{{$employee->email}}</dd>

        <dt>Phone</dt>
        <dd>{{$employee->phone}}</dd>

    </dl>

    <div class="d-flex">
        <a href="{{ URL::to('admin/employee/' . $employee->id . '/edit') }}" class="btn btn-primary m-1">Edit</a>
        {{ Form::open(array('url' => 'admin/employee/' . $employee->id, 'class' => 'pull-right')) }}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
        {{ Form::close() }}
    </div>
@endsection
