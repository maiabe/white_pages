<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Person;
use App\Models\PendingPerson;
use App\Models\Campus;
use App\Models\Department;

class PersonController extends Controller
{

    public function index()
    {
        $personData = Person::all();

        // $departmentName = Person::whereHas('departments', function($query) {
        //     $query->where('dept_id', 1);
        // })->get();

        // dd($departmentName);

        // $personData = Person::with('departments')->get();

        // $personData->load('department');
        $pendingPersonData = PendingPerson::all();
        

        $data = $personData->map(function($person) {
            $department = $person->departments->first();
            return (object) [
                'person_id' => ['columnName' => 'id', 
                                    'name' => 'person-id', 
                                    'value' => $person['id'],
                                    'type' => gettype($person['id']),
                                    'inputType' => 'hidden',
                                ],
                'username' => ['columnName' => 'Username', 
                                    'name' => 'username', 
                                    'value' => $person['username'],
                                    'type' => gettype($person['username']),
                                    'inputType' => 'text',
                                ],
                'name' => ['columnName' => 'Name', 
                                    'name' => 'name', 
                                    'value' => $person['name'],
                                    'type' => gettype($person['name']),
                                    'inputType' => 'text'
                                ],
                // 'department_name' => ['columnName' => 'Department Name', 
                //                     'name' => 'dept_name', 
                //                     'value' => $department->name,
                //                     'type' => gettype($department->name),
                //                     'inputType' => 'text'
                //                 ],
            ];
        });

        // dd($data);

        return view('People.person_listings',['personData'=> $personData, 'pendingPersonData'=>$pendingPersonData]);
    }

    public function destroy($username)
    {
        Person::where('username', $username)->delete();
        return redirect()->route('person_listings');
    }

    public function reject($username,)
    {
        $pendingPerson = PendingPerson::where('username', $username)->first();

        // Does person already exist in Person table
        $existingPerson = Person::find($pendingPerson->person_id);

        if ($existingPerson)
        {
            $existingPerson->update([
                'pending' => false,
            ]);
        }

        $pendingPerson->delete();

        return redirect()->route('person_listings');
    }

    // Updates an existing Person entry and sends to Pending Person Table for approval
    public function update(Request $req, $username)
    {
        $person = Person::where('username', $username)->first();

        $messages = [
            'username.unique' => 'The username: ' . $req->username . ' is already in use. Fail to update for the username: ' . $person->username . ".",
            'pending' => 'The person ' . $req->username . ' is already pending for changes. Please review the pending changes.',
        ];

        if ($person->pending) {
            return redirect()->back()->withErrors(['pending' => $messages['pending']]);
        }

        // Define validation rules
        $validatedData = $req->validate([
            'username' => [
                'required',
                'string',
                'max:60',
                'unique:Person,username,' . $username . ',username',
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
                'nullable',
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
                'nullable',
                'string',
                'max:100',
            ],
            'phone' => [
                'required',
                'string',
                'max:14',
            ],
            'location' => [
                'nullable',
                'string',
                'max:100',
            ],
            'fax' => [
                'nullable',
                'string',
                'max:14',
            ],
            'website' => [
                'nullable',
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
            'name_of_record' => $validatedData['name_of_record']??null,
            'job_title' => $validatedData['job_title']??null,
            'email' => $validatedData['email'],
            'alias_email' => $validatedData['alias_email']??null,
            'phone' => $validatedData['phone'],
            'location' => $validatedData['location']??null,
            'fax' => $validatedData['fax']??null,
            'website' => $validatedData['website']??null,
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
                'nullable',
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
                'nullable',
                'string',
                'max:100',
            ],
            'phone' => [
                'required',
                'string',
                'max:14',
            ],
            'location' => [
                'nullable',
                'string',
                'max:100',
            ],
            'fax' => [
                'nullable',
                'string',
                'max:14',
            ],
            'website' => [
                'nullable',
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
            'name_of_record' => $validatedData['name_of_record']??null,
            'job_title' => $validatedData['job_title']??null,
            'email' => $validatedData['email'],
            'alias_email' => $validatedData['alias_email']??null,
            'phone' => $validatedData['phone'],
            'location' => $validatedData['location']??null,
            'fax' => $validatedData['fax']??null,
            'website' => $validatedData['website']??null,
            'publishable' => $validatedData['publishable'] == 'true' ? 1 : 0,
        ]);
        
        return redirect() ->route('person_listings');
        // Adds a new entry to pending person table
    }

    // In Pending Person Table, this button is clicked inside the Approve Modal when the Pending Person entry is approved
    public function approve(Request $req, $username)
    {
        $pendingPerson = PendingPerson::where('username', $username)->first();

        if (!$pendingPerson) {
            return redirect()->route('person_listings')->with('error', 'Pending Person could not be found');
        }

        $messages = [
            'username.unique' => 'The username: ' . $pendingPerson->username . ' is already in use. Fail to update for the username: ' . $pendingPerson->username . ".",
        ];

        // Define validation rules
        $validatedData = $req->validate([
            'username' => [
                'required',
                'string',
                'max:60',
                'unique:Person,username,' . $username . ',username',
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
                'nullable',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'max:100',
                'unique:Person,email,' . $pendingPerson->email . ',email'
            ],
            'alias_email' => [
                'nullable',
                'string',
                'max:100',
            ],
            'phone' => [
                'string',
                'max:14',
            ],
            'location' => [
                'nullable',
                'string',
                'max:100',
            ],
            'fax' => [
                'nullable',
                'string',
                'max:14',
            ],
            'website' => [
                'nullable',
                'string',
                'max:200',
            ],
            'publishable' => [
                'required',
            ],
        ], $messages);

        // Does person already exist in Person table
        $existingPerson = Person::find($pendingPerson->person_id);

            // if person_id exists already
        if ($existingPerson) {
            $existingPerson->update([
            'username' => $validatedData['username'],
            'name' => $validatedData['name'],
            'name_of_record' => $validatedData['name_of_record']??null,
            'job_title' => $validatedData['job_title']??null,
            'email' => $validatedData['email'],
            'alias_email' => $validatedData['alias_email']??null,
            'phone' => $validatedData['phone'],
            'location' => $validatedData['location']??null,
            'fax' => $validatedData['fax']??null,
            'website' => $validatedData['website']??null,
            'publishable' => $validatedData['publishable'] == 'true' ? 1 : 0,
            'lastApprovedAt' => now(),
            'pending' => false,
            // When Roles are implemented, add in lastApprovedBy for currently logged in user
            ]);
        } else {
            // Create a new person entry
            $newPerson = Person::create([
                'username' => $validatedData['username'],
                'name' => $validatedData['name'],
                'name_of_record' => $validatedData['name_of_record']??null,
                'job_title' => $validatedData['job_title']??null,
                'email' => $validatedData['email'],
                'alias_email' => $validatedData['alias_email']??null,
                'phone' => $validatedData['phone'],
                'location' => $validatedData['location']??null,
                'fax' => $validatedData['fax']??null,
                'website' => $validatedData['website']??null,
                'publishable' => $validatedData['publishable'] == 'true' ? 1 : 0,
                'lastApprovedAt' => now(),
                // When Roles are implemented, add in lastApprovedBy for currently logged in user
            ]);
        }

        $pendingPerson->delete();

        return redirect()->route('person_listings');
    }
}
