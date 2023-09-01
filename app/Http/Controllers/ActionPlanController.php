<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\ActionPlan;
use App\DataTables\ActionPlanDataTable;
use App\DataTables\UserActionDataTable;
use App\Http\Requests\StoreActionPlanRequest;
use App\Http\Requests\UpdateActionPlanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ActionPlanDataTable $dataTable, Work $work)
    {
        return $dataTable->render('actions.index', [
            'work' => $work
        ]);
    }

    /**
     * Display a listing of the resource that owns by user.
     */
    public function userAction(UserActionDataTable $dataTable)
    {
        return $dataTable->render('actions.user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActionPlanRequest $request, Work $work)
    {
        $action = ActionPlan::create([
            'user_id' => request()->user()->id,
            'work_id' => $work->id,
            'plan' => $request->plan,
            'analysis' => $request->analysis,
            'recommendation' => $request->recommendation,
            'status' => $request->status,
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = 'actions/' . time() . '.' . $extension;

            Storage::disk('public')->put(
                $filename,
                $file->getContent()
            );

            $action->update([
                'photo' => $filename
            ]);
        }

        return redirect()->back()->with('success', 'Action plan created.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function change(UpdateActionPlanRequest $request)
    {
        $action = ActionPlan::find($request->id);
        if ($action->user_id != request()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to change this action plan.');
        }

        $action->update($request->validated());

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();
            $filename = 'actions/' . time() . '.' . $extension;

            Storage::disk('public')->put(
                $filename,
                $file->getContent()
            );

            $action->update([
                'photo' => $filename
            ]);
        }

        return redirect()->back()->with('success', 'Action plan updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActionPlan $action)
    {
        if ($action->user_id != request()->user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this action plan.');
        }
        $action->delete();
        return redirect()->back()->with('success', 'Action plan deleted.');
    }
}
