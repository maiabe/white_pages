<?php

namespace App\Http\Controllers;

use http\Message;
use Illuminate\Http\Request;
use App\Models\DeptGroup;
use App\Models\Department;
use App\Models\PendingDepartment;
use App\Models\Campus;
use Illuminate\Validation\ValidationException;


class DeptGroupController extends Controller
{
    public function index()
    {
        // For Department Groups (Department)
        $columnNames = ['Campus Code', 'Group Number', 'Name', 'Email', 'Phone', 'Location', 'Fax', 'Website'];
        $campusData = Campus::distinct()->pluck('code');
        
        $deptData = Department::select('id', 'campus_id', 'group_no', 'name', 'email', 'phone', 'location', 'fax', 'website')
        ->get()
        ->map(function($item) use ($campusData) {
            $campus = Campus::where('id', $item->campus_id)->first();

            // Check if the department has a record in pending department or not
            $isPending = PendingDepartment::where('dept_id', $item->id)->exists();

            // Return View objects
            return (object) [
                'pending' => $isPending,
                'dept_id' => [
                                'columnName' => 'id',
                                'display' => 'false',
                                'value' => $item->id,
                                'formInput' => [
                                        'name' => 'dept-id', 
                                        'value' => $item->id,
                                        'type' => gettype($item->code),
                                        'inputType' => 'hidden'
                                    ],
                            ],
                'campus_code' => [
                                'columnName' => 'Campus Code',
                                'display' => 'true',
                                'value' => $campus->code,
                                'columnWidth' => '5%',
                                'formInput' => [
                                        'label' => 'Campus Code',
                                        'name' => 'campus-code', 
                                        'value' => $campus->code,
                                        'type' => gettype($campus->code),
                                        'inputType' => 'select',
                                        'options' => $campusData,
                                    ],
                                ],
                'group_number' => [
                                    'columnName' => 'Group Number', 
                                    'display' => 'true',
                                    'value' => $item->group_no,
                                    'columnWidth' => '5%',
                                    'formInput' => [
                                        'label' => 'Group Number',
                                        'name' => 'group-number', 
                                        'value' => $item->group_no,
                                        'placeholder' => '100100',
                                        'type' => gettype($item->group_no),
                                        'inputType' => 'text',
                                        'validation' => 'required|length:6,6|number',
                                        'minlength' => 6,
                                        'maxlength' => 6    
                                    ],
                                ],
                'dept_name' => [
                                    'columnName' => 'Department Name', 
                                    'display' => 'true',
                                    'value' => $item->name,
                                    'columnWidth' => '40%',
                                    'formInput' => [
                                        'label' => 'Department Name',
                                        'name' => 'dept-name', 
                                        'value' => $item->name,
                                        'placeholder' => 'Test Department Name',
                                        'type' => gettype($item->name),
                                        'inputType' => 'text',
                                        'validation' => "required|length:2,255|alpha_numerics:latin",    
                                    ]
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
            ];
        });

        // Build data for Pending Department Groups (Pending Department)

        $pendingDeptData = PendingDepartment::select('id', 'dept_id', 'status', 'campus_id', 'group_no', 'name', 'email', 'phone', 'location', 'fax', 'website')
        ->get()
        ->map(function($item) use ($campusData) {
            $campus = Campus::where('id', $item->campus_id)->first();

            // Get data for corresponding Department entry
            $dept_info = Department::where('id', $item->dept_id)->first();
            
            if ($item->status == 'update') {
                $dept_campus = Campus::where('id', $dept_info->campus_id)->first();
                $dept_info = [
                    'Campus Code' => $dept_campus->code,
                    'Group Number' => $dept_info->group_no,
                    'Group Name' => $dept_info->name,
                    'Email' => $dept_info->email,
                    'Phone' => $dept_info->phone,
                    'Fax' => $dept_info->fax,
                    'Location' => $dept_info->location,
                    'Website' => $dept_info->website,
                ];
            }
            else {
                $dept_info = null;
            }

            // Return View objects
            return (object) [
                    'pdept_id' => [
                                    'columnName' => 'id',
                                    'display' => 'false',
                                    'value' => $item->id,
                                    'formInput' => [
                                        'name' => 'pdept-id',
                                        'value' => $item->id,
                                        'type' => gettype($item->id),
                                        'inputType' => 'hidden',
                                    ],
                                ],
                    'dept_id' => [
                                    'columnName' => 'dept-id',
                                    'display' => 'false',
                                    'value' => $item->dept_id,
                                    'formInput' => [
                                        'name' => 'dept-id',
                                        'value' => $item->dept_id,
                                        'type' => gettype($item->dept_id),
                                        'inputType' => 'hidden',
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
                                    ]
                                ],
                    'campus_code' => [
                                    'columnName' => 'Campus Code',
                                    'display' => 'true',
                                    'value' => $campus->code,
                                    'columnWidth' => '5%',
                                    'formInput' => [
                                        'label' => 'Campus Code',
                                        'name' => 'campus-code',
                                        'value' => $campus->code,
                                        'type' => gettype($campus->code),
                                        'inputType' => 'select',
                                        'options' => $campusData,
                                    ]
                                ],
                    'group_number' => [
                                    'columnName' => 'Group Number', 
                                    'display' => 'true',
                                    'value' => $item->group_no,
                                    'columnWidth' => '5%',
                                    'formInput' => [
                                        'label' => 'Group Number',
                                        'name' => 'group-number', 
                                        'value' => $item->group_no,
                                        'placeholder' => '100100',
                                        'type' => gettype($item->group_no),
                                        'inputType' => 'text',
                                        'validation' => 'required|length:6,6|number',
                                        'minlength' => 6,
                                        'maxlength' => 6
                                    ],
                                ],
                    'dept_name' => [
                                    'columnName' => 'Department Name', 
                                    'display' => 'true',
                                    'value' => $item->name,
                                    'columnWidth' => '35%',
                                    'formInput' => [
                                        'label' => 'Department Name',
                                        'name' => 'dept-name', 
                                        'value' => $item->name,
                                        'placeholder' => 'Test Department Name',
                                        'type' => gettype($item->name),
                                        'inputType' => 'text',
                                        'validation' => "required|length:2,255|alpha_numerics:latin",
                                    ],
                                ],
                    'email' => [
                                    'columnName' => 'Email', 
                                    'display' => 'true',
                                    'value' => $item->email,
                                    'columnWidth' => '10%',
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
                    'phone' => [
                                    'columnName' => 'Phone',
                                    'display' => 'true',
                                    'value' => $item->phone,
                                    'columnWidth' => '8%',
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
                                    ],
                                ],
                    'fax' => [
                                    'columnName' => 'Fax', 
                                    'display' => 'true',
                                    'value' => $item->fax,
                                    'columnWidth' => '8%',
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
                                    ]
                            ],
                    'location' => [
                                    'columnName' => 'Location', 
                                    'display' => 'true',
                                    'value' => $item->location,
                                    'columnWidth' => '8%',
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
                                    'columnWidth' => '8%',
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
                    'existing_info' => [ 
                                    'columnName' => 'Department Info',
                                    'display' => 'false',
                                    'value' => $dept_info,
                                ],
            ];
        });


        return view('DeptGroups.dept_groups', ['columnNames' => $columnNames,'deptData' => $deptData, 'pendingDeptData' => $pendingDeptData, 'campusData' => $campusData]);
    }

    public function destroy(Request $req)
    {
        // add status code to Pending Department
        // create Pending Department with the status code for delete
        // The record gets deleted when Admin approves the deletion

        $dept_id = $req['dept-id'];
        $deptData = Department::where('id', $dept_id)->first();

        // If the record already is being edited (If dept_id trying to edit is already in Pending table)
        $pendingExists = PendingDepartment::where('dept_id', $dept_id)->exists();

        if ($pendingExists) {
            PendingDepartment::where('dept_id', $dept_id)->update([
                'status' => 'delete',
                'dept_id' => $dept_id,
                'campus_id' => $deptData['campus_id'],
                'group_no' => $deptData['group_no'],
                'name' => $deptData['name'],
                'email' => $deptData['email'],
                'phone' => $deptData['phone'],
                'fax' => $deptData['fax'],
                'location' => $deptData['location'],
                'website' => $deptData['website'],
            ]);
        }
        else {
            PendingDepartment::create([
                'status' => 'delete',
                'dept_id' => $dept_id,
                'campus_id' => $deptData['campus_id'],
                'group_no' => $deptData['group_no'],
                'name' => $deptData['name'],
                'email' => $deptData['email'],
                'phone' => $deptData['phone'],
                'fax' => $deptData['fax'],
                'location' => $deptData['location'],
                'website' => $deptData['website'],
            ]);
        }

        return redirect()->route('dept_groups');
    }

    public function update(Request $req)
    {
        try {
            $dept_id = (int) $req['dept-id'];
            $grp_num = $req['group-number'];
            $dept_name = $req['dept-name'];
            $campus_code = $req['campus-code'];
            $email = (int) $req['email'];
            $phone = $req['phone'] ?? "";
            $fax = $req['fax'] ?? "";
            $location = $req['location'] ?? "";
            $website = $req['website'] ?? "";

            $campus = Campus::where('code', $campus_code)->first();
            $req['campus-id'] = $campus->id;
            // dd($req);

            $messages = [
                'group_no.unique' => 'The department group: ' . $grp_num . ' is already in use. Fail to update for the department group: ' . $grp_num . ".",
                'name.unique' => 'The department name:' . $dept_name . 'is already in use. Fail to update for the department name: ' . $dept_name. ".",
            ];
    
            // Define validation rules
            $validatedData = $req->validate([
                'campus-id' => [
                    'required',
                    'integer',
                ],
                'group-number' => [
                    'required',
                    'string',
                    'size:6',
                    'unique:Department,group_no,'.$grp_num.',group_no'
                ],
                'dept-name' => [
                    'required',
                    'string',
                    'max:60',
                    'unique:Department,name,'.$dept_name.',name'
                ],
                'email' => [
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
                    'max:60'
                ],
                'fax' => [
                    'nullable',
                    'string',
                    'max:14'
                ],
                'website' => [
                    'nullable',
                    'string',
                    'max:100'
                ],
            ], $messages);

            // DB::enableQueryLog();
            // dd($validatedData);

            // If the record already is being edited (If dept_id trying to edit is already in Pending table)
            $pendingExists = PendingDepartment::where('dept_id', $dept_id)->exists();

            // Update that PendingDepartment record instead of creating a new record
            if ($pendingExists) {
                PendingDepartment::where('dept_id', $dept_id)->update([
                    'status' => "update",
                    'dept_id' => $dept_id,
                    'campus_id' => $validatedData['campus-id'],
                    'group_no' => $validatedData['group-number'],
                    'name' => $validatedData['dept-name'],
                    'email' => $validatedData['email'],
                    'phone' => $validatedData['phone'],
                    'fax' => $validatedData['fax'],
                    'location' => $validatedData['location'],
                    'website' => $validatedData['website'],
                ]);
            }
            else {
                // Create new PendingDepartment record
                PendingDepartment::create([
                    'status' => "update",
                    'dept_id' => $dept_id,
                    'campus_id' => $validatedData['campus-id'],
                    'group_no' => $validatedData['group-number'],
                    'name' => $validatedData['dept-name'],
                    'email' => $validatedData['email'],
                    'phone' => $validatedData['phone'],
                    'fax' => $validatedData['fax'],
                    'location' => $validatedData['location'],
                    'website' => $validatedData['website'],
                ]);
            }
     
            // dd(DB::getQueryLog());

            return redirect()->route('dept_groups');

        } catch (ValidationException $e) {
            $errors = $e->validator->getMessageBag()->toArray();
            //dd($errors); // Output or log the validation errors
            // return back()-> withErrors($e->errors())->withInput();
            // return response()->json(['errors' => $errors], 422);

            return redirect()->route('dept_groups')->with('error', $errors);
        }
        
    }

    public function store(Request $req) {
        // dd($req);
        try {
            $dept_id = (int) $req['dept-id'];
            $grp_num = $req['group-number'];
            $dept_name = $req['dept-name'];
            $campus_code = $req['campus-code'];
            $email = (int) $req['email'];
            $phone = $req['phone'];
            $location = $req['location'];
            $fax = $req['fax'];
            $website = $req['website'];
    
            $campus = Campus::where('code', $campus_code)->first();
            $req['campus-id'] = $campus->id;
            // dd($req);

            $messages = [
                'group_no.unique' => 'The department group: ' . $grp_num . ' is already in use. Fail to update for the department group: ' . $grp_num . ".",
                'name.unique' => 'The department name:' . $dept_name . 'is already in use. Fail to update for the department name: ' . $dept_name. ".",
            ];
    
            // Define validation rules
            $validatedData = $req->validate([
                'group-number' => [
                    'required',
                    'string',
                    'size:6',
                    'unique:Department,group_no,'.$grp_num.',group_no'
                ],
                'dept-name' => [
                    'required',
                    'string',
                    'max:60',
                    'unique:Department,name,'.$dept_name.',name'
                ],
                'campus-id' => [
                    'required',
                    'integer',
                ],
                'email' => [
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
                    'max:60'
                ],
                'fax' => [
                    'nullable',
                    'string',
                    'max:14'
                ],
                'website' => [
                    'nullable',
                    'string',
                    'max:100'
                ],
            ], $messages);

            // DB::enableQueryLog();
     
            // Insert into Pending Department
            PendingDepartment::create([
                'status' => 'create',
                'campus_id' => $validatedData['campus-id'],
                'group_no' => $validatedData['group-number'],
                'name' => $validatedData['dept-name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'fax' => $validatedData['fax'],
                'location' => $validatedData['location'],
                'website' => $validatedData['website'],
            ]);
            // dd(DB::getQueryLog());

            return redirect()->route('dept_groups');

        } catch (ValidationException $e) {
            $errors = $e->validator->getMessageBag()->toArray();
            // dd($errors); // Output or log the validation errors
            // return back()-> withErrors($e->errors())->withInput();
            return response()->json(['errors' => $errors], 422);

        }
        
        return redirect() ->route('dept_groups');
    }


    public function approve(Request $req) {
        try {
            $status = $req['status'];
            $pdept_id = $req['pdept-id'];

            $dept_id = (int) $req['dept-id'];
            $grp_num = $req['group-number'];
            $dept_name = $req['dept-name'];
            $campus_code = $req['campus-code'];
            $email = (int) $req['email'];
            $phone = $req['phone'];
            $location = $req['location'];
            $fax = $req['fax'];
            $website = $req['website'];
    
            $campus = Campus::where('code', $campus_code)->first();
            $req['campus-id'] = $campus->id;
            // dd($req);

            $messages = [
                'group_no.unique' => 'The department group: ' . $grp_num . ' is already in use. Fail to update for the department group: ' . $grp_num . ".",
                'name.unique' => 'The department name:' . $dept_name . 'is already in use. Fail to update for the department name: ' . $dept_name. ".",
            ];
    
            // Define validation rules
            $validatedData = $req->validate([
                'group-number' => [
                    'required',
                    'string',
                    'size:6',
                    'unique:Department,group_no,'.$grp_num.',group_no'
                ],
                'dept-name' => [
                    'required',
                    'string',
                    'max:60',
                    'unique:Department,name,'.$dept_name.',name'
                ],
                'campus-id' => [
                    'required',
                    'integer',
                ],
                'email' => [
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
                    'max:60'
                ],
                'fax' => [
                    'nullable',
                    'string',
                    'max:14'
                ],
                'website' => [
                    'nullable',
                    'string',
                    'max:100'
                ],
            ], $messages);

            if ($status == 'create') {
                // Insert into Pending Department
                Department::create([
                    'campus_id' => $validatedData['campus-id'],
                    'group_no' => $validatedData['group-number'],
                    'name' => $validatedData['dept-name'],
                    'email' => $validatedData['email'],
                    'phone' => $validatedData['phone'],
                    'fax' => $validatedData['fax'],
                    'location' => $validatedData['location'],
                    'website' => $validatedData['website'],
                ]);
                PendingDepartment::where('id', $pdept_id)->delete();
            }
            else if ($status == 'update') {
                Department::where('id', $dept_id)->update([
                    'campus_id' => $validatedData['campus-id'],
                    'group_no' => $validatedData['group-number'],
                    'name' => $validatedData['dept-name'],
                    'email' => $validatedData['email'],
                    'phone' => $validatedData['phone'],
                    'fax' => $validatedData['fax'],
                    'location' => $validatedData['location'],
                    'website' => $validatedData['website'],
                ]);
                PendingDepartment::where('id', $pdept_id)->delete();
            }
            else if ($status == 'delete') {
                Department::where('id', $dept_id)->delete();
                PendingDepartment::where('id', $pdept_id)->delete();
            }



            $successMsg = [
                'title' => 'Successfully approved ' . $status . ' action',
                'content' => 'Approved pending department group change'
            ];

            return redirect()->route('dept_groups')->with('success', $successMsg);

        } catch (ValidationException $e) {
            $errors = $e->validator->getMessageBag()->toArray();
            // dd($errors); // Output or log the validation errors
            //return back()-> withErrors($e->errors())->withInput();
            //return response()->json(['errors' => $errors], 422);

            return redirect()->route('dept_groups')->with('error', $errors);
        }

        return redirect() ->route('dept_groups');
    }


    public function reject(Request $req) {

        try {
            $status = $req['status'];

            // Rejecting any action is deleteting the record in PendingDepartment and making no action in Department table
            $pdept_id = $req['pdept-id'];
            $pendingDept = PendingDepartment::where('id', $pdept_id)->first();
            // dd($pendingDept);
            $pendingDept->delete();

            $successMsg = [
                'title' => 'Successfully rejected ' . $status . ' action',
                'content' => 'Rejected pending department group change'
            ];

            return redirect()->route('dept_groups')->with('success', $successMsg);

        } catch (ValidationException $e) {
            $errors = $e->validator->getMessageBag()->toArray();
            // dd($errors); // Output or log the validation errors
            // return back()-> withErrors($e->errors())->withInput();
            // return response()->json(['errors' => $errors], 422);
            return redirect()->route('dept_groups')->with('error', $errors);
        }

        return redirect()->route('dept_groups');
    }

}
