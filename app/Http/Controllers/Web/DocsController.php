<?php

namespace Boaz\Http\Controllers\Web;

use Illuminate\Http\Request;
use Boaz\Http\Controllers\Controller;
use Boaz\Document;

class DocsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $docs = Document::all();
        return view('my-documents.documents', compact('docs'));
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
            ['name' =>'required',
              'file_type' => 'required'  ]
        );
        $doc = new Document();
        $doc->name = $request->get('name');
        $doc->file_type = $request->get('file_type');
        $doc->save();
        return redirect()->route('required-docs.index')
        ->withSuccess($doc->name. ' file added successfuly');
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
            ['name' =>'required',
              'file_type' => 'required'  ]
        );
        $doc = Document::find($id);
        $doc->name = $request->get('name');
        $doc->file_type = $request->get('file_type');
        $doc->save();
        return redirect()->route('required-docs.index')
        ->withSuccess('Document updated successfull');
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
    }

    public function upload(Request $request)
    {
    
      $uploadedFile = $request->file('file');
      $filename = time().$uploadedFile->getClientOriginalName();

      Storage::disk('local')->putFileAs(
        'files/'.$filename,
        $uploadedFile,
        $filename
      );

      $upload = new File;
      $upload->filename = $filename;

      $upload->user()->associate(auth()->user());
      return $upload;
      exit();
      $upload->save();

      return response()->json([
        'id' => $upload->id
      ]);
    }
}
