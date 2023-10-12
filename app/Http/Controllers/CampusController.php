<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;

class CampusController extends Controller
{
    public function index() {
        $data = Campus::all();
        return view('campus', ['data' => $data]);
    }
}
