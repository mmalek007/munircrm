@extends('admin.layouts.app')
@section('content')
    <div class="container mt-5">
        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info mb-5">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ Session::get('message') }}
            </div>
        @endif
        <a href="employee/create" type="button" class="btn btn-primary float-right mb-2">Add Employee</a>
        <table class="table table-bordered mb-5">
            <thead>
            <tr class="table-success">
                <th scope="col">#</th>
                <th scope="col">Company Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($employees as $i=>$data)
                <tr>
                    <th scope="row">{{ $i+1 }}</th>
                    <td>{{ $data->companies->name }}</td>
                    <td>{{ $data->firstname }}</td>
                    <td>{{ $data->lastname }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->phone }}</td>
                    <td>
                        <a class="btn btn-small btn-success" href="{{ URL::to('admin/employee/' . $data->id) }}">Show</a>
                        <a class="btn btn-small btn-info" href="{{ URL::to('admin/employee/' . $data->id . '/edit') }}">Edit</a>
                    {{ Form::open(array('url' => 'admin/employee/' . $data->id, 'class' => 'pull-right')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}
                    {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $employees->links() !!}
        </div>
    </div>
@endsection
