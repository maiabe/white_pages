<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{

    public function index()
    {
        $data = Person::all();
        return view('People.person_listings', ['data' => $data, ]);
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
            'email' => [
                'required',
                'string',
                'max:100',
                'unique:Person,email,' . $person->email . ',email'
            ],
            'phone' => [
                'required',
                'string',
                'max:14',
            ],
            'location' => [
                'required',
                'string',
                'max:100',
            ],
            'fax' => [
                'required',
                'string',
                'max:14',
            ],
            'website' => [
                'required',
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
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'location' => $validatedData['location'],
            'fax' => $validatedData['fax'],
            'website' => $validatedData['website'],
            'publishable' => $validatedData['publishable'] === 'true' ? 1 : 0,

        ]);

        // return to person_listings view
        return redirect()->route('person_listings');
    }
}
