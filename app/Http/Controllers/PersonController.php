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

    // Updates an existing Person entry and sends to Pending Person Table for approval
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
                // 'required',
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
                // 'required',
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

        $person->update([
            'pending' => true,
        ]);

        PendingPerson::create([
            'person_id' => $person->id,
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
            'publishable' => $validatedData['publishable'] == 'true' ? 1 : 0,
        ]);

        return redirect()->route('person_listings');
    }

    // For Pending Person, Adding a new person should send this entry into Pending Person Table to be approved
    public function store(Request $req) {
        $messages = [
            'username.unique' => 'The username: ' . $req->username . 'is already in use. Cannot create another person with the same username',
        ];

        $validatedData = $req->validate([
            'username' => [
                'required',
                'string',
                'unique:Person,username,'
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
                // 'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'max:100',
                'unique:Person,email,',
            ],
            'alias_email' => [
                // 'required',
                'string',
                'max:100',
            ],
            'phone' => [
                // 'required',
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

        PendingPerson::create([
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
            'publishable' => $validatedData['publishable'] == 'true' ? 1 : 0,
        ]);
        
        return redirect() ->route('person_listings');
        // Adds a new entry to pending person table
    }

    // In Pending Person Table, this button is clicked inside the Approve Modal when the Pending Person entry is approved
    public function approve($username)
    {
        $pendingPerson = PendingPerson::where('username', $username)->first();
        // Does person already exist in Person table

        if ($pendingPerson) {
            $existingPerson = Person::find($pendingPerson->person_id);

                // if person_id exists already
            if ($existingPerson) {
                $existingPerson->update([
                'username' => $pendingPerson['username'],
                'name' => $pendingPerson['name'],
                'name_of_record' => $pendingPerson['name_of_record'],
                'job_title' => $pendingPerson['job_title'],
                'email' => $pendingPerson['email'],
                'alias_email' => $pendingPerson['alias_email'],
                'phone' => $pendingPerson['phone'],
                'location' => $pendingPerson['location'],
                'fax' => $pendingPerson['fax'],
                'website' => $pendingPerson['website'],
                'publishable' => $pendingPerson['publishable'] === 'true' ? 1 : 0,
                'lastApprovedAt' => now(),
                'pending' => false,
                // When Roles are implemented, add in lastApprovedBy
                ]);
            } else {
                // Create a new person entry
                $newPerson = Person::create([
                    'username' => $pendingPerson->username,
                    'name' => $pendingPerson->name,
                    'name_of_record' => $pendingPerson->name_of_record,
                    'job_title' => $pendingPerson->job_title,
                    'email' => $pendingPerson->email,
                    'alias_email' => $pendingPerson->alias_email,
                    'phone' => $pendingPerson->phone,
                    'location' => $pendingPerson->location,
                    'fax' => $pendingPerson->fax,
                    'website' => $pendingPerson->website,
                    'publishable' => $pendingPerson->publishable === 'true' ? 1 : 0,
                    'lastApprovedAt' => now(),
                    // When Roles are implemented, add in lastApprovedBy
                ]);
            }

            $pendingPerson->delete();
        }

        return redirect()->route('person_listings');
    }
}
