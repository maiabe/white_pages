<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Campus;
use DB;

class DepartmentController extends Controller
{
    public function index()
    {
        $tableEntries = Department::all();
        $columns = ['group_no', 'name', 'email', 'phone', 'location', 'fax', 'website'];

        $campusData = Campus::distinct()->pluck('code');
        return view('Departments.department_listings', ['columns' => $columns, 'tableEntries' => $tableEntries, 'campusData' => $campusData]);
    }
}