@extends('admin.layouts.app')
@section('content')
    <h1 class="display-6">Company Details</h1>

    <hr/>

    <dl>
        <dt>Logo</dt>
        <dd><img src="{{ url('public/storage/'.$company->logo) }}" width="100" height="100" /></dd>

        <dt>Company Name</dt>
        <dd>{{$company->name}}</dd>

        <dt>Email</dt>
        <dd>{{$company->email}}</dd>

        <dt>Website</dt>
        <dd>{{$company->website}}</dd>

    </dl>

    <div class="d-flex">
        <a class="btn btn-small btn-info" href="{{ URL::to('admin/company/' . $company->id . '/edit') }}">Edit</a>
        {{ Form::open(array('url' => 'admin/company/' . $company->id, 'class' => 'pull-right')) }}
        {{ Form::hidden('_method', 'DELETE') }}
        {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
        {{ Form::close() }}
    </div>
@endsection
