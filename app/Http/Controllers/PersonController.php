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
    public function destroy($username,)
    {
        Person::where('username', $username)->delete();
        return redirect()->route('person_listings');
    }

    public function update(Request $req, $username)
    {
        $person = Person::where('username', $username)->first();

        $messages = [
            'username.unique' => 'The username: ' . $req->username . ' is already in use. Fail to update for the username: ' . $person->username . ".",
        ];

        // Define validation rules
        $validatedData = $req->validate([
            'username' => [
                'required',
                'string',
                'max:60',
                'unique:Person,username,' . $username . ',username'
            ],
            'name' => [
                'required',
                'string',
                'max:60',
            ],
            'name_of_record' => [
                'required',
                'string',
                'max:255',
            ],
            'job_title' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'max:100',
                'unique:Person,email,' . $person->email . ',email'
            ],
            'alias_email' => [
                // 'required',
                'string',
                'max:100',
            ],
            'phone' => [
                'required',
                'string',
                'max:14',
            ],
            'location' => [
                // 'required',
                'string',
                'max:100',
            ],
            'fax' => [
                // 'required',
                'string',
                'max:14',
            ],
            'website' => [
                // 'required',
                'string',
                'max:200',
            ],
            'publishable' => [
                'required',
            ],
        ], $messages);

        // Attempt to update the record
        Person::where('username', $username)->update([
            'username' => $validatedData['username'],
            'name' => $validatedData['name'],
            'name_of_record' => $validatedData['name_of_record'],
            'job_title' => $validatedData['job_title'],
            'email' => $validatedData['email'],
            'alias_email' => $validatedData['alias_email'],
            'phone' => $validatedData['phone'],
            'location' => $validatedData['location'],
            'fax' => $validatedData['fax'],
            'website' => $validatedData['website'],
            'publishable' => $validatedData['publishable'] === 'true' ? 1 : 0,
            // When Roles are implemented, add in lastApprovedAt and lastApprovedBy
        ]);

        // return to person_listings view
        return redirect()->route('person_listings');
    }
}
