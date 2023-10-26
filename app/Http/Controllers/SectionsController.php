<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections=sections::all();
        return view('sections.sections',compact('sections'));
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
        $validated = $request->validate([
            'section_name' => 'required|unique:sections|max:255',
            'description'  => 'required',

        ],[
            'section_name.required'=>'يرجى ادخال اسم القسم',
            'section_name.unique'=>'اسم القسم موجود مسبقا',
            'description.required'=>'يرجى ادخال الوصف',
        ]);

        // $input=$request->all();

            sections::create([
                'section_name'=>$request->section_name,
                'description'=>$request->description,
                'Created_by'=>(Auth::user()->name),
            ]);
            session()->flash('Add');
            return redirect('/sections');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id=$request->id;
        $this->validate($request,[
            'section_name' => 'unique:sections|max:255'.$id,
            'description'  => 'required',

        ],[
            'section_name.required'=>'يرجى ادخال اسم القسم',
            'section_name.unique'=>'اسم القسم موجود مسبقا',
            'description.required'=>'يرجى ادخال الوصف',
        ]);
            $section=sections::find($id);
            $section->update([
                'section_name'=>$request->section_name,
                'description'=>$request->description,
                ]);
            session()->flash('Edit');
            return redirect('sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->id;
       $sections=sections::find($id)->delete();
        session()->flash('delete');
        return redirect('sections');
    }
}
