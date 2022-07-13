<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClassProjectRequest;
use App\Http\Requests\UpdateClassProjectRequest;
use App\Models\ClassProject;
use Illuminate\Support\Facades\Auth;

class ClassProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreClassProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassProjectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClassProject  $classProject
     * @return \Illuminate\Http\Response
     */
    public function show(ClassProject $classProject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClassProject  $classProject
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassProject $classProject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClassProjectRequest  $request
     * @param  \App\Models\ClassProject  $classProject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassProjectRequest $request, ClassProject $classProject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClassProject  $classProject
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassProject $classProject)
    {
        //
    }

    public function myClass()
    {
        $schoolClass = Auth::user()->schoolClass()->with(['classProject', 'users'])->first();

        return view('class_project.my_class', compact('schoolClass'));
    }
}
