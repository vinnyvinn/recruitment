<?php

namespace Boaz\Http\Controllers\Web;

use Illuminate\Http\Request;
use Boaz\Http\Controllers\Controller;
use Boaz\Skill;

class SkillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $list_skills = Skill::all();
        return view('skills.index', compact('list_skills'));
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
        $skills = new Skill();
        $skills->name = $request->get('name');
        $skills->save();
        return redirect()->route('skills.index')
        ->withSuccess(trans('app.skill_created'));
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
        $skill = Skill::find($id);
        $skill->name = $request->get('name');
        $skill->save();
        return redirect()->route('skills.index')
        ->withSuccess(trans('app.skill_updated'));

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
        $skill = Skill::find($id);
        $skill->delete();
        return redirect()->route('skills.index')
        ->withSuccess(trans('app.skill_deleted'));
    }
}
