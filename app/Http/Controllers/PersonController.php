<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonController extends Controller
{
    
    public function index()
    {
        return view('People.person_listings');
    }
}