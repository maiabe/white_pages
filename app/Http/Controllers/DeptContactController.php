<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeptContactController extends Controller
{
    public function index()
    {
        return view('DeptContacts.dept_contacts');
    }
}