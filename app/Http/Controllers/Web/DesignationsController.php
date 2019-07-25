<?php

namespace Boaz\Http\Controllers\Web;

use Illuminate\Http\Request;
use Boaz\Http\Controllers\Controller;
use Boaz\Designations;
use Boaz\Departments;

class DesignationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $designations = Designations::all();
        $dept = Departments::all();
        return view('designations.index', compact('designations', 'dept'));
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
            ['name' =>'required', 'department_id' => 'required']
        );
        $designations = new Designations();
        $designations->name = $request->get('name');
        $designations->department_id = $request->get('department_id');
        $designations->save();
        return redirect()->route('designations.index')
        ->withSuccess($designations->name. ' Designation added successfuly');
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
            ['name' =>'required', 'department_id' => 'required']
        );
        $designations = Designations::find($id);
        $designations->name = $request->get('name');
        $designations->department_id = $request->get('department_id');
        $designations->save();
        return redirect()->route('designations.index')
        ->withSuccess($designations->name. ' Designation updated successfuly');
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
        $designations = Designations::find($id);
        $designations->delete();
        return redirect()->route('designations.index')
        ->withSuccess($designations->name.' Designation deleted successfull');

    }
}
