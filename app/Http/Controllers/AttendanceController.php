<?php

namespace App\Http\Controllers;

use App\DataTables\AttendanceDataTable;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AttendanceDataTable $dataTable)
    {
        return $dataTable->render('attendances.index');
    }
}
