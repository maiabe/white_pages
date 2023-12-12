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
        // For Department Groups (Department)
        $columnNames = [
            'Username', 'Name', 'Name of Record', 'Job Title', 'Email', 'Alias Email', 'Phone', 'Fax', 'Location', 'Website',
        ];
        $departmentData = Department::distinct()->pluck('name', 'id')->toArray();
        $campusData = Campus::distinct()->pluck('code');
        
        $peopleData = Person::select('id', 'username', 'name', 'name_of_record', 'job_title', 'email', 'alias_email', 'phone', 'location', 'fax', 'location', 'website', 'publishable')
        ->get()
        ->map(function($item) use ($campusData, $departmentData) {
            //$campus = Campus::where('id', $item->campus_id)->first();
            // Get departments associated with a person
            $departments = $item->departments->first(); // Find all departments a person is associated with
            $departmentName = $departments ? $departments['name'] : '';
            $departmentId = $departments ? $departments['id'] : 1;

            // Eventually Department field needs to show multiple departments instead of just one:
            // 1. go through each item in $item->departments
            // 2. build array of objects with department and its campus info to set to dept-name field below 

            // Check if the department has a record in pending department or not
            $isPending = PendingPerson::where('person_id', $item->id)->exists();

            // Return View objects
            return (object) [
                'pending' => $isPending,
                'person_id' => [
                                'columnName' => 'id',
                                'display' => 'false',
                                'value' => $item->id,
                                'formInput' => [
                                        'name' => 'person-id', 
                                        'value' => $item->id,
                                        'type' => gettype($item->id),
                                        'inputType' => 'hidden'
                                    ],
                            ],
                'name' => [
                                'columnName' => 'Name', 
                                'display' => 'true',
                                'value' => $item->name,
                                'columnWidth' => '20%',
                                'formInput' => [
                                    'label' => 'Name',
                                    'name' => 'name', 
                                    'value' => $item->name,
                                    'placeholder' => 'Test Name',
                                    'type' => 'string',
                                    'inputType' => 'text',
                                    'validation' => "required|length:2,255|alpha_numerics:latin", 
                                ],
                            ],
                'name_of_record' => [
                                'columnName' => 'Name of Record', 
                                'display' => 'false',
                                'value' => $item->name_of_record,
                                'columnWidth' => '30%',
                                'formInput' => [
                                    'label' => 'Name of Record',
                                    'name' => 'name-of-record', 
                                    'value' => $item->name_of_record,
                                    'placeholder' => 'Test Name of Record',
                                    'type' => 'string',
                                    'inputType' => 'text',
                                    'validation' => "required|length:2,255|alpha_numerics:latin", 
                                ],
                            ],
                'username' => [
                                'columnName' => 'Username', 
                                'display' => 'true',
                                'value' => $item->username,
                                'columnWidth' => '10%',
                                'formInput' => [
                                    'label' => 'Username',
                                    'name' => 'username', 
                                    'value' => $item->username,
                                    'placeholder' => 'Test username',
                                    'type' => 'string',
                                    'inputType' => 'text',
                                    'validation' => "required|length:2,60|alpha_numerics:latin",
                                ],
                            ],
                'dept_id' => [
                                'columnName' => 'Department Names',
                                'display' => 'true',
                                'value' => $departmentName,
                                'columnWidth' => '25%',
                                'formInput' => [
                                    'label' => 'Department Name',
                                    'name' => 'dept-id',
                                    'value' =>  $departmentId,
                                    'type' => 'string',
                                    'inputType' => 'select',
                                    'options' => $departmentData,
                                ],
                            ],
                'job_title' => [
                                'columnName' => 'Job Title', 
                                'display' => 'true',
                                'value' => $item->job_title,
                                'columnWidth' => '10%',
                                'formInput' => [
                                    'label' => 'Job Title',
                                    'name' => 'job-title', 
                                    'value' => $item->job_title,
                                    'placeholder' => 'Test Job Title',
                                    'type' => 'string',
                                    'inputType' => 'text',
                                    'validation' => "required|length:2,255|alpha_numerics:latin", 
                                ],
                            ],
                'email' => [
                                'columnName' => 'Email', 
                                'display' => 'true',
                                'value' => $item->email,
                                'columnWidth' => '15%',
                                'formInput' => [
                                    'label' => 'Email',
                                    'name' => 'email', 
                                    'value' => $item->email,
                                    'placeholder' => 'example@test.com',
                                    'type' => gettype($item->email),
                                    'inputType' => 'email',
                                    // 'validation' => "required|email|ends_with:.edu",
                                    'validation' => "required|email",
                                    'validationMessages' => 'Enter a valid email address (e.g., example@hawaii.edu)',
                                ],
                            ],
                'alias_email' => [
                                'columnName' => 'Alias Email', 
                                'display' => 'false',
                                'value' => $item->alias_email,
                                'columnWidth' => '15%',
                                'formInput' => [
                                    'label' => 'Alias Email',
                                    'name' => 'alias-email', 
                                    'value' => $item->alias_email,
                                    'placeholder' => 'example@test.com',
                                    'type' => gettype($item->alias_email),
                                    'inputType' => 'email',
                                    // 'validation' => "required|email|ends_with:.edu",
                                    'validation' => "email",
                                    'validationMessages' => 'Enter a valid email address (e.g., example@hawaii.edu)',
                                ],
                            ],
                'phone' => [
                                'columnName' => 'Phone',
                                'display' => 'true',
                                'value' => $item->phone,
                                'columnWidth' => '10%',
                                'formInput' => [
                                    'label' => 'Phone',
                                    'name' => 'phone', 
                                    'value' => $item->phone,
                                    'placeholder' => "xxx-xxx-xxxx",
                                    'type' => gettype($item->phone),                                    
                                    'inputType' => 'tel',
                                    'validation' => "required|matches:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/",
                                    'validationMessages' => "{    
                                        matches: 'Phone number must be in the format xxx-xxx-xxxx',
                                    }",
                                ]
                            ],
                'fax' => [
                                'columnName' => 'Fax', 
                                'display' => 'true',
                                'value' => $item->fax,
                                'columnWidth' => '10%',
                                'formInput' => [
                                    'label' => 'Fax',
                                    'name' => 'fax',
                                    'placeholder' => "xxx-xxx-xxxx",
                                    'value' => $item->fax,
                                    'type' => gettype($item->fax),
                                    'inputType' => 'tel',
                                    'validation' => "|matches:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/",
                                    'validationMessages' => "{    
                                        matches: 'Phone number must be in the format xxx-xxx-xxxx',
                                    }",                                
                                ],
                            ],
                'location' => [
                                'columnName' => 'Location', 
                                'display' => 'true',
                                'value' => $item->location,
                                'columnWidth' => '10%',
                                'formInput' => [
                                    'label' => 'Location',
                                    'name' => 'location', 
                                    'value' => $item->location,
                                    'placeholder' => 'Honolulu, HI',
                                    'type' => gettype($item->location),
                                    'inputType' => 'text',
                                    'validation' => "length:2,100|alpha_numerics:latin",
                                ],
                            ],
                'website' => [
                                'columnName' => 'Website', 
                                'display' => 'false',
                                'value' => $item->website,
                                'columnWidth' => '10%',
                                'formInput' => [
                                    'label' => 'Website',
                                    'name' => 'website', 
                                    'value' => $item->website,
                                    'placeholder' => 'http://example.com',
                                    'type' => gettype($item->website),
                                    'inputType' => 'url',
                                    'validation' => "url",
                                    'validationMessages' => 'Enter a valid website URL (e.g. http://hawaii.edu)',
                                ],
                            ],
                'publishable' => [
                                'columnName' => 'Publishable',
                                'display' => 'false',
                                'value' => $item->publishable,
                                'formInput' => [
                                    'label' => 'Publishable',
                                    'name' => 'publishable',
                                    'value' => $item->publishable,
                                    'type' => 'boolean',
                                    'inputType' => 'radio',
                                    'options' => [ 1 => 'True', 0 => 'False' ]
                                ],
                ],
            ];
        });

        // Build data for Pending Person Listings (Pending Person)

        $pendingPeopleData = PendingPerson::select('id', 'person_id', 'status', 'username', 'name', 'name_of_record', 'job_title', 'email', 'alias_email', 'phone', 'location', 'fax', 'location', 'website', 'publishable')
        ->get()
        ->map(function($item) use ($campusData, $departmentData) {
            //$campus = Campus::where('id', $item->campus_id)->first();
            $departments = $item->departments->first(); // Find all departments a person is associated with
            $departmentName = $departments ? $departments['name'] : '';
            $departmentId = $departments ? $departments['id'] : 1;

            // Get data for corresponding Department entry
            //$dept_info = Department::where('id', $item->dept_id)->first();
            
            // if ($item->status == 'update') {
            //     $person_campus = Campus::where('id', $dept_info->campus_id)->first();
            //     $dept_info = [
            //         'Campus Code' => $dept_campus->code,
            //         'Group Number' => $dept_info->group_no,
            //         'Group Name' => $dept_info->name,
            //         'Email' => $dept_info->email,
            //         'Phone' => $dept_info->phone,
            //         'Fax' => $dept_info->fax,
            //         'Location' => $dept_info->location,
            //         'Website' => $dept_info->website,
            //     ];
            // }
            // else {
            //     $dept_info = null;
            // }
            $person_info = Person::where('id', $item->person_id)->first();

            if ($item->status == 'update') {
                $dept_name = $person_info->departments->pluck('name', 'id')->first();
                $publishable = ($person_info['publishable'] == 1) ? 'True' : 'False';                

                $person_info = [
                    'Name' => $person_info->name,
                    'Name of Record' => $person_info->name_of_record,
                    'Username' => $person_info->username,
                    'Department Name' => $dept_name,
                    'Job Title' => $person_info->job_title,
                    'Email' => $person_info->email,
                    'Alias Email' => $person_info->alias_email,
                    'Phone' => $person_info->phone,
                    'Location' => $person_info->location,
                    'Fax' => $person_info->fax,
                    'Website' => $person_info->website,
                    'Publishable' => $publishable,
                ];
            }

            // Return View objects
            return (object) [
                'pperson_id' => [
                    'columnName' => 'pperson-id',
                    'display' => 'false',
                    'value' => $item->id,
                    'formInput' => [
                            'name' => 'pperson-id', 
                            'value' => $item->id,
                            'type' => gettype($item->id),
                            'inputType' => 'hidden'
                        ],
                ],
                'person_id' => [
                    'columnName' => 'person_id',
                    'display' => 'false',
                    'value' => $item->person_id,
                    'formInput' => [
                            'name' => 'person-id', 
                            'value' => $item->person_id,
                            'type' => gettype($item->person_id),
                            'inputType' => 'hidden'
                        ],
                ],
                'status' => [
                    'columnName' => 'Status',
                    'display' => 'true',
                    'value' => $item->status,
                    'columnWidth' => '5%',
                    'formInput' => [
                            'name' => 'status', 
                            'value' => $item->status,
                            'type' => gettype($item->status),
                            'inputType' => 'hidden'
                        ],
                ],
                'name' => [
                                'columnName' => 'Name', 
                                'display' => 'true',
                                'value' => $item->name,
                                'columnWidth' => '30%',
                                'formInput' => [
                                    'label' => 'Name',
                                    'name' => 'name', 
                                    'value' => $item->name,
                                    'placeholder' => 'Test Name',
                                    'type' => 'string',
                                    'inputType' => 'text',
                                    'validation' => "required|length:2,255|alpha_numerics:latin", 
                                ],
                            ],
                'name_of_record' => [
                                'columnName' => 'Name of Record', 
                                'display' => 'false',
                                'value' => $item->name_of_record,
                                'columnWidth' => '30%',
                                'formInput' => [
                                    'label' => 'Name of Record',
                                    'name' => 'name-of-record', 
                                    'value' => $item->name_of_record,
                                    'placeholder' => 'Test Name of Record',
                                    'type' => 'string',
                                    'inputType' => 'text',
                                    'validation' => "required|length:2,255|alpha_numerics:latin", 
                                ],
                            ],
                'username' => [
                                'columnName' => 'Username', 
                                'display' => 'true',
                                'value' => $item->username,
                                'columnWidth' => '10%',
                                'formInput' => [
                                    'label' => 'Username',
                                    'name' => 'username', 
                                    'value' => $item->username,
                                    'placeholder' => 'Test username',
                                    'type' => 'string',
                                    'inputType' => 'text',
                                    'validation' => "required|length:2,60|alpha_numerics:latin", 
                                ],
                            ],
                'dept_id' => [
                                'columnName' => 'Department Names',
                                'display' => 'true',
                                'value' => $departmentName,
                                'columnWidth' => '25%',
                                'formInput' => [
                                    'label' => 'Department Name',
                                    'name' => 'dept-id',
                                    'value' => $departmentId,
                                    'type' => 'string',
                                    'inputType' => 'select',
                                    'options' => $departmentData,
                                ],
                            ],
                'job_title' => [
                                'columnName' => 'Job Title', 
                                'display' => 'true',
                                'value' => $item->job_title,
                                'columnWidth' => '10%',
                                'formInput' => [
                                    'label' => 'Job Title',
                                    'name' => 'job-title', 
                                    'value' => $item->job_title,
                                    'placeholder' => 'Test Job Title',
                                    'type' => 'string',
                                    'inputType' => 'text',
                                    'validation' => "required|length:2,255|alpha_numerics:latin", 
                                ],
                            ],
                'email' => [
                                'columnName' => 'Email', 
                                'display' => 'true',
                                'value' => $item->email,
                                'columnWidth' => '15%',
                                'formInput' => [
                                    'label' => 'Email',
                                    'name' => 'email', 
                                    'value' => $item->email,
                                    'placeholder' => 'example@test.com',
                                    'type' => gettype($item->email),
                                    'inputType' => 'email',
                                    // 'validation' => "required|email|ends_with:.edu",
                                    'validation' => "required|email",
                                    'validationMessages' => 'Enter a valid email address (e.g., example@hawaii.edu)',
                                ],
                            ],
                'alias_email' => [
                                'columnName' => 'Alias Email', 
                                'display' => 'false',
                                'value' => $item->alias_email,
                                'columnWidth' => '15%',
                                'formInput' => [
                                    'label' => 'Alias Email',
                                    'name' => 'alias-email', 
                                    'value' => $item->alias_email,
                                    'placeholder' => 'example@test.com',
                                    'type' => gettype($item->alias_email),
                                    'inputType' => 'email',
                                    // 'validation' => "required|email|ends_with:.edu",
                                    'validation' => "email",
                                    'validationMessages' => 'Enter a valid email address (e.g., example@hawaii.edu)',
                                ],
                            ],
                'phone' => [
                                'columnName' => 'Phone',
                                'display' => 'true',
                                'value' => $item->phone,
                                'columnWidth' => '10%',
                                'formInput' => [
                                    'label' => 'Phone',
                                    'name' => 'phone', 
                                    'value' => $item->phone,
                                    'placeholder' => "xxx-xxx-xxxx",
                                    'type' => gettype($item->phone),                                    
                                    'inputType' => 'tel',
                                    'validation' => "matches:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/",
                                    'validationMessages' => "{    
                                        matches: 'Phone number must be in the format xxx-xxx-xxxx',
                                    }",
                                ]
                            ],
                'fax' => [
                                'columnName' => 'Fax', 
                                'display' => 'true',
                                'value' => $item->fax,
                                'columnWidth' => '10%',
                                'formInput' => [
                                    'label' => 'Fax',
                                    'name' => 'fax',
                                    'placeholder' => "xxx-xxx-xxxx",
                                    'value' => $item->fax,
                                    'type' => gettype($item->fax),
                                    'inputType' => 'tel',
                                    'validation' => "|matches:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/",
                                    'validationMessages' => "{    
                                        matches: 'Phone number must be in the format xxx-xxx-xxxx',
                                    }",                                
                                ],
                            ],
                'location' => [
                                'columnName' => 'Location', 
                                'display' => 'true',
                                'value' => $item->location,
                                'columnWidth' => '10%',
                                'formInput' => [
                                    'label' => 'Location',
                                    'name' => 'location', 
                                    'value' => $item->location,
                                    'placeholder' => 'Honolulu, HI',
                                    'type' => gettype($item->location),
                                    'inputType' => 'text',
                                    'validation' => "length:2,100|alpha_numerics:latin",
                                ],
                            ],
                'website' => [
                                'columnName' => 'Website', 
                                'display' => 'true',
                                'value' => $item->website,
                                'columnWidth' => '10%',
                                'formInput' => [
                                    'label' => 'Website',
                                    'name' => 'website', 
                                    'value' => $item->website,
                                    'placeholder' => 'http://example.com',
                                    'type' => gettype($item->website),
                                    'inputType' => 'url',
                                    'validation' => "url",
                                    'validationMessages' => 'Enter a valid website URL (e.g. http://hawaii.edu)',

                                ],
                            ],
                'publishable' => [
                                'columnName' => 'Publishable',
                                'display' => 'false',
                                'value' => (int) $item->publishable,
                                'formInput' => [
                                    'label' => 'Publishable',
                                    'name' => 'publishable',
                                    'value' => (int) $item->publishable,
                                    'type' => 'boolean',
                                    'inputType' => 'radio',
                                    'options' => [ 1 => 'True', 0 => 'False' ]
                                ],
                ],
                'existing_info' => [
                                'columnName' => 'Person Info',
                                'display' => 'false',
                                'value' => $person_info,
                ],
                    
            ];
        });

        return view('People.person_listings', ['columnNames' => $columnNames,'peopleData' => $peopleData, 'pendingPeopleData' => $pendingPeopleData, 'campusData' => $campusData]);
    }


    // For Pending Person, Adding a new person should send this entry into Pending Person Table to be approved
    public function store(Request $req) {

        try {

            $messages = [
                'username.unique' => 'The username: ' . $req->username . ' is already in use. Fail to update for the username: ' . $req->username . ".",
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
                'name-of-record' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'job-title' => [
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
                'alias-email' => [
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
                    'required'
                ]
            ], $messages);
    
            $newPendingPerson = PendingPerson::create([
                'status' => 'create',
                'username' => $validatedData['username'],
                'name' => $validatedData['name'],
                'name_of_record' => $validatedData['name-of-record']??null,
                'job_title' => $validatedData['job-title']??null,
                'email' => $validatedData['email'],
                'alias_email' => $validatedData['alias-email']??null,
                'phone' => $validatedData['phone'],
                'location' => $validatedData['location']??null,
                'fax' => $validatedData['fax']??null,
                'website' => $validatedData['website']??null,
                'publishable' => $validatedData['publishable'],
            ]);
            //-- In the future, set values for lastApprovedAt (get current time) and lastApprovedBy (id of the current user logged in)

            // Get selected department name
            $dept_id = $req['dept-id'];
            $newPendingPerson->departments()->detach();
            $newPendingPerson->departments()->attach($dept_id);

            return redirect()->route('person_listings');

        } catch (ValidationException $e) {
            $errors = $e->validator->getMessageBag()->toArray();
            // dd($errors); // Output or log the validation errors
            // return back()-> withErrors($e->errors())->withInput();
            // return response()->json(['errors' => $errors], 422);
            return redirect()->route('person_listings')->with('error', $errors);
        }

        
        return redirect() ->route('person_listings');
        // Adds a new entry to pending person table
    }


    public function destroy(Request $req)
    {
        $person_id = $req['person-id'];
        $personData = Person::where('id', $person_id)->first();
        // dd($personData);

        $pendingExists = PendingPerson::where('person_id', $person_id)->exists();

        if ($pendingExists) {
            PendingPerson::where('person_id', $person_id)->update([
                'status' => 'delete',
                'username' => $personData['username'],
                'name' => $personData['name'],
                'name_of_record' => $personData['name_of_record'],
                'job_title' => $personData['job_title'],
                'email' => $personData['email'],
                'alias_email' => $personData['alias_email'],
                'phone' => $personData['phone'],
                'location' => $personData['location'],
                'fax' => $personData['fax'],
                'website' => $personData['website'],
                'publishable' => $personData['publishable'],
            ]);

        }
        else {
            PendingPerson::create([
                'status' => 'delete',
                'person_id' => $person_id,
                'username' => $personData['username'],
                'name' => $personData['name'],
                'name_of_record' => $personData['name_of_record'],
                'job_title' => $personData['job_title'],
                'email' => $personData['email'],
                'alias_email' => $personData['alias_email'],
                'phone' => $personData['phone'],
                'location' => $personData['location'],
                'fax' => $personData['fax'],
                'website' => $personData['website'],
                'publishable' => $personData['publishable'],
            ]);

        }

        return redirect()->route('person_listings');
    }


    // Updates an existing Person entry and sends to Pending Person Table for approval
    public function update(Request $req)
    {
        // dd($req);
        try {
            $person_id = $req['person-id'];
            // $department = $personData->departments->first();
            $messages = [
                'username.unique' => 'The username: ' . $req->username . ' is already in use. Fail to update for the username: ' . $req->username . ".",
            ];
    
            // Define validation rules
            $validatedData = $req->validate([
                'username' => [
                    'required',
                    'string',
                    'max:60',
                    'unique:Person,username,' . $req->username . ',username',
                ],
                'name' => [
                    'required',
                    'string',
                    'max:60',
                ],
                'name-of-record' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'job-title' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
                'email' => [
                    'required',
                    'string',
                    'max:100',
                    'unique:Person,email,' . $req->email . ',email'
                ],
                'alias-email' => [
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
    
            $pendingExists = PendingPerson::where('person_id', $person_id)->exists();

            if ($pendingExists) {
                $existingPendingPerson = PendingPerson::where('person_id', $person_id)->first();
                // dd($existingPendingPerson);
                $existingPendingPerson->update([
                    'status' => 'update',
                    'username' => $validatedData['username'],
                    'name' => $validatedData['name'],
                    'name_of_record' => $validatedData['name-of-record'],
                    'job_title' => $validatedData['job-title']??null,
                    'email' => $validatedData['email'],
                    'alias_email' => $validatedData['alias-email']??null,
                    'phone' => $validatedData['phone'],
                    'location' => $validatedData['location']??null,
                    'fax' => $validatedData['fax']??null,
                    'website' => $validatedData['website']??null,
                    'publishable' => $validatedData['publishable'],
                ]);

                $dept_id = $req['dept-id'];
                $existingPendingPerson->departments()->detach();
                $existingPendingPerson->departments()->attach($dept_id);

            }
            else {
                $newPendingPerson = PendingPerson::create([
                    'status' => 'update',
                    'person_id' => $person_id,
                    'username' => $validatedData['username'],
                    'name' => $validatedData['name'],
                    'name_of_record' => $validatedData['name-of-record']??null,
                    'job_title' => $validatedData['job-title']??null,
                    'email' => $validatedData['email'],
                    'alias_email' => $validatedData['alias-email']??null,
                    'phone' => $validatedData['phone'],
                    'location' => $validatedData['location']??null,
                    'fax' => $validatedData['fax']??null,
                    'website' => $validatedData['website']??null,
                    'publishable' => $validatedData['publishable'],
                ]);

                $dept_id = $req['dept-id'];
                $newPendingPerson->departments()->detach();
                $newPendingPerson->departments()->attach($dept_id);
            }

            return redirect()->route('person_listings');
        }
        catch (ValidationException $e) {
            $errors = $e->validator->getMessageBag()->toArray();
            //dd($errors); // Output or log the validation errors
            // return back()-> withErrors($e->errors())->withInput();
            // return response()->json(['errors' => $errors], 422);

            return redirect()->route('person_listings')->with('error', $errors);
        }


        return redirect()->route('person_listings');
    }


    // In Pending Person Table, this button is clicked inside the Approve Modal when the Pending Person entry is approved
    public function approve(Request $req)
    {
        try {
            
            // dd($req);
            $status = $req['status'];
            $pperson_id = $req['pperson-id'];
            $person_id = $req['person-id'];
            $username = $req['username'];
            $name = $req['name'];
            $name_of_record = $req['name-of-record'];
            $job_title = $req['job-title'];
            $email = $req['email'];
            $alias_email = $req['alias-email'];
            $phone = $req['phone'];
            $location = $req['location'];
            $fax = $req['fax'];
            $website = $req['website'];
            $publishable = $req['publishable'];

            // $pendingPerson = PendingPerson::where('id', $pperson_id)->first();

            $messages = [
                'username.unique' => 'The username: ' . $username . ' is already in use. Fail to update for the username: ' . $username . ".",
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
                'name-of-record' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'job-title' => [
                    'nullable',
                    'string',
                    'max:255',
                ],
                'email' => [
                    'required',
                    'string',
                    'max:100',
                    'unique:Person,email,' . $email . ',email'
                ],
                'alias-email' => [
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

            if ($status == 'create') {
                // Create a new person entry
                $newPerson = Person::create([
                    'username' => $validatedData['username'],
                    'name' => $validatedData['name'],
                    'name_of_record' => $validatedData['name-of-record']??null,
                    'job_title' => $validatedData['job-title']??null,
                    'email' => $validatedData['email'],
                    'alias_email' => $validatedData['alias-email']??null,
                    'phone' => $validatedData['phone'],
                    'location' => $validatedData['location']??null,
                    'fax' => $validatedData['fax']??null,
                    'website' => $validatedData['website']??null,
                    'publishable' => $validatedData['publishable'],
                    'lastApprovedAt' => now(),
                    // When Roles are implemented, add in lastApprovedBy for currently logged in user
                ]);

                PendingPerson::where('id', $pperson_id)->delete();

                // update Person_Department
                $dept_id = $req['dept-id'];
                $newPerson->departments()->detach();
                $newPerson->departments()->attach($dept_id);

            } else if ($status == 'update') {
                $existingPerson = Person::where('id', $person_id)->first();
                $existingPerson->update([
                    'username' => $validatedData['username'],
                    'name' => $validatedData['name'],
                    'name_of_record' => $validatedData['name-of-record']??null,
                    'job_title' => $validatedData['job-title']??null,
                    'email' => $validatedData['email'],
                    'alias_email' => $validatedData['alias-email']??null,
                    'phone' => $validatedData['phone'],
                    'location' => $validatedData['location']??null,
                    'fax' => $validatedData['fax']??null,
                    'website' => $validatedData['website']??null,
                    'publishable' => $validatedData['publishable'],
                    'lastApprovedAt' => now(),
                    // When Roles are implemented, add in lastApprovedBy for currently logged in user
                ]);

                PendingPerson::where('id', $pperson_id)->delete();

                // update Person_Department
                $dept_id = $req['dept-id'];
                $existingPerson->departments()->detach();
                $existingPerson->departments()->attach($dept_id);
                
            } else if ($status == 'delete') {
                Person::where('id', $person_id)->delete();
                PendingPerson::where('id', $pperson_id)->delete();
            }

            $successMsg = [
                'title' => 'Successfully approved ' . $status . ' action',
                'content' => 'Approved pending person change'
            ];

            return redirect()->route('person_listings')->with('success', $successMsg);

        } catch (ValidationException $e) {
            $errors = $e->validator->getMessageBag()->toArray();
            return redirect()->route('person_listings')->with('error', $errors);
        }
        return redirect()->route('person_listings');
    }



    public function reject(Request $req)
    {        
        try {
            $status = $req['status'];
            $pendingPerson = PendingPerson::where('id', $req['pperson-id'])->first();
            $pendingPerson->delete();
    
            $successMsg = [
                'title' => 'Successfully rejected ' . $status . ' action',
                'content' => 'Rejected pending person change'
            ];
    
            return redirect()->route('person_listings')->with('success', $successMsg);
    
        } catch (ValidationException $e) {
            $errors = $e->validator->getMessageBag()->toArray();
            return redirect()->route('person_listings')->with('error', $errors);
        }

        return redirect()->route('person_listings');
    }
}
