<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\PendingPerson;

class PersonController extends Controller
{

    public function index()
    {
        $personData = Person::all();
        $pendingPersonData = PendingPerson::all();

        return view('People.person_listings',['personData'=> $personData, 'pendingPersonData'=>$pendingPersonData]);
    }
}
