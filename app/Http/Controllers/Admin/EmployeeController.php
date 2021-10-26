<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreRequest;
use App\Models\Companies;
use App\Models\Employees;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['employees'] = Employees::with('companies')->paginate(10);
        return view('admin.employee.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['companies'] = Companies::pluck('name', 'id')->toArray();
        return view('admin.employee.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeStoreRequest $request)
    {
        $inputs = $request->validated();
        if ($inputs){

            // store
            $employee = new Employees();
            $employee->company_id = $request->company_id;
            $employee->firstname = $request->firstname;
            $employee->lastname = $request->lastname;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->save();

            // redirect
            Session::flash('message', 'Successfully created employee!');

            return Redirect::to('admin/employee');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employees::with('companies')->findOrFail($id);
        return view('admin.employee.show')
            ->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Companies::pluck('name', 'id')->toArray();
        $employee = Employees::find($id);

        // show the edit form and pass the shark
        return view('admin.employee.edit')
            ->with('companies', $companies)
            ->with('employee', $employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeStoreRequest $request, $id)
    {
        $inputs = $request->validated();

        if ($inputs){
            $employee = Employees::find($id);
            $employee->company_id = $request->company_id;
            $employee->firstname = $request->firstname;
            $employee->lastname = $request->lastname;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->save();

            // redirect
            Session::flash('message', 'Successfully updated employee!');

            return Redirect::to('admin/employee');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employees::findOrFail($id);

        $employee->delete();

        Session::flash('message', 'Successfully deleted employee!');

        return Redirect::to('admin/employee');
    }
}
