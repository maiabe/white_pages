<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use DB;

class DepartmentController extends Controller
{
    
    public function index()
    {
        $data = Department::all();
        return view('departments',['data'=>$data]);
    }
}