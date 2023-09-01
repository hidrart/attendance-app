<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\DataTables\WorkDataTable;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WorkDataTable $dataTable)
    {
        return $dataTable->render('works.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkRequest $request)
    {
        Work::create($request->validated());
        return redirect()->route('works.index')->with('success', 'Work created successfully.');
    }


    /**
     * Update the specified resource in storage.
     */
    public function change(UpdateWorkRequest $request)
    {
        $work = Work::findOrFail($request->id);
        if ($request->user()->role->name != 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to change this work.');
        }

        $work->update($request->validated());
        return redirect()->back()->with('success', 'Work updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        if (request()->user()->role->name != 'admin') {
            return redirect()->back()->with('error', 'You are not authorized to delete this work.');
        }

        $work->delete();
        return redirect()->back()->with('success', 'Work deleted successfully.');
    }
}
