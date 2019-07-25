<?php

namespace Boaz\Http\Controllers\Web;

use Illuminate\Http\Request;
use Boaz\Http\Controllers\Controller;
use Boaz\Departments;

class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = Departments::all();
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            ['name' =>'required']
        );
        $department = new Departments();
        $department->name = $request->get('name');
        $department->save();
        return redirect()->route('departments.index')
        ->withSuccess($department->name. ' Department added successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate(
            ['name' =>'required']
        );
        $department = Departments::find($id);
        $department->name = $request->get('name');
        $department->save();
        return redirect()->route('departments.index')
        ->withSuccess('department updated successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $department = Departments::find($id);
        $department->delete();
        return redirect()->route('departments.index')
        ->withSuccess($department->name.' department deleted successfull');
    }
}
