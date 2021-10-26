<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyStoreRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['companies'] = Companies::paginate(10);
        return view('admin.company.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyStoreRequest $request)
    {
        $inputs = $request->validated();
        if ($inputs){

            if($request->file()) {
                $name = request()->file("logo")->store("/", "public");
            }
            // store
            $company = new Companies();
            $company->name = $request->name;
            $company->email = $request->email;
            $company->logo = $name;
            $company->website = $request->website;
            $company->save();

            // redirect
            Session::flash('message', 'Successfully created company!');

            return Redirect::to('admin/company');
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
        $company = Companies::findOrFail($id);
        return view('admin.company.show')
            ->with('company', $company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Companies::find($id);

        // show the edit form and pass the shark
        return view('admin.company.edit')
            ->with('company', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyStoreRequest $request, $id)
    {
        $inputs = $request->validated();

        if ($inputs){
            $company = Companies::find($id);
            $name = $company->logo;
            if($request->file()) {
                unlink(storage_path('app/public/'.$name));
                $name = request()->file("logo")->store("/", "public");
            }
            // store
            $company->name = $request->name;
            $company->email = $request->email;
            $company->logo = $name;
            $company->website = $request->website;
            $company->save();

            // redirect
            Session::flash('message', 'Successfully updated company!');

            return Redirect::to('admin/company');
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
        $company = Companies::findOrFail($id);
        if ($company->logo){
            unlink(storage_path('app/public/'.$company->logo));
        }
        $company->delete();

        Session::flash('message', 'Successfully deleted company!');

        return Redirect::to('admin/company');
    }
}
