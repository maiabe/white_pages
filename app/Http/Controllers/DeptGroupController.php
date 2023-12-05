<?php

namespace App\Http\Controllers;

use http\Message;
use Illuminate\Http\Request;
use App\Models\DeptGroup;
use App\Models\Department;
use App\Models\Campus;
use Illuminate\Validation\ValidationException;


class DeptGroupController extends Controller
{
    public function index()
    {
        // $columnNames = ['Campus Code', 'Group Number', 'Name'];
        // $campusData = Campus::distinct()->pluck('code');

        // $data = DeptGroup::select('campus_code', 'dept_grp', 'dept_grp_name')
        // ->get()
        // ->map(function($item) use ($campusData) {

        //     return (object) [
        //         'campus_code' => ['displayName' => 'Campus Code', 
        //                             'name' => 'campus-code', 
        //                             'value' => $item->campus_code,
        //                             'type' => gettype($item->campus_code),
        //                             'inputType' => 'select',
        //                             'options' => $campusData,
        //                         ],
        //         'group_number' => ['displayName' => 'Group Number', 
        //                             'name' => 'group-number', 
        //                             'value' => $item->dept_grp,
        //                             'type' => gettype($item->dept_grp),
        //                             'inputType' => 'text'
        //                         ],
        //         'group_name' => ['displayName' => 'Group Name', 
        //                             'name' => 'group-name', 
        //                             'value' => $item->dept_grp_name,
        //                             'type' => gettype($item->dept_grp_name),
        //                             'inputType' => 'text'
        //                         ],
        //     ];
        // });

        $columnNames = ['Campus Code', 'Group Number', 'Name', 'Email', 'Phone', 'Location', 'Fax', 'Website'];
        $campusData = Campus::distinct()->pluck('code');
        
        $data = Department::select('id', 'campus_id', 'group_no', 'name', 'email', 'phone', 'location', 'fax', 'website')
        ->get()
        ->map(function($item) use ($campusData) {
            $campus = Campus::where('id', $item->campus_id)->first();

            // Return View objects
            return (object) [
                'dept_id' => ['columnName' => 'id', 
                                    'name' => 'dept-id', 
                                    'value' => $item->id,
                                    'type' => gettype($campus->code),
                                    'inputType' => 'hidden',
                                ],
                'campus_code' => ['columnName' => 'Campus Code', 
                                    'name' => 'campus-code', 
                                    'value' => $campus->code,
                                    'type' => gettype($campus->code),
                                    'inputType' => 'select',
                                    'options' => $campusData,
                                ],
                'group_number' => ['columnName' => 'Group Number', 
                                    'name' => 'group-number', 
                                    'value' => $item->group_no,
                                    'placeholder' => '100100',
                                    'type' => gettype($item->group_no),
                                    'inputType' => 'text',
                                    'validation' => 'required|length:6,6|number',
                                    'minlength' => 6,
                                    'maxlength' => 6
                                ],
                'dept_name' => ['columnName' => 'Department Name', 
                                    'name' => 'dept-name', 
                                    'value' => $item->name,
                                    'placeholder' => 'Test Department Name',
                                    'type' => gettype($item->name),
                                    'inputType' => 'text',
                                    'validation' => "required|length:2,255|alpha_spaces:latin",
                                ],
                'email' => ['columnName' => 'Email', 
                                    'name' => 'email', 
                                    'value' => $item->email,
                                    'placeholder' => 'example@test.com',
                                    'type' => gettype($item->email),
                                    'inputType' => 'email',
                                    // 'validation' => "required|email|ends_with:.edu",
                                    'validation' => "required|email",
                                    'validationMessages' => 'Enter a valid email address (e.g., example@hawaii.edu)',
                                ],
                'phone' => ['columnName' => 'Phone',
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
                'location' => ['columnName' => 'Location', 
                                    'name' => 'location', 
                                    'value' => $item->location,
                                    'placeholder' => 'Honolulu, HI',
                                    'type' => gettype($item->location),
                                    'inputType' => 'text',
                                    'validation' => "length:2,100|alpha_numerics:latin",
                                ],
                'fax' => ['columnName' => 'Fax', 
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
                'website' => ['columnName' => 'Website', 
                                    'name' => 'website', 
                                    'value' => $item->website,
                                    'placeholder' => 'http://example.com',
                                    'type' => gettype($item->website),
                                    'inputType' => 'url',
                                    'validation' => "url",
                                    'validationMessages' => 'Enter a valid website URL (e.g. http://hawaii.edu)',
                                ],
            ];
        });

        return view('DeptGroups.dept_groups', ['columnNames' => $columnNames,'data' => $data, 'campusData' => $campusData]);
    }

    public function destroy(Request $req)
    {
        $dept_id = $req['dept-id'];
        // $dept_obj = Department::where('id', $dept_id)->first();

        Department::where('id', $dept_id)->delete();

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
            $location = $req['location'] ?? "";
            $fax = $req['fax'] ?? "";
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
            // dd($validatedData);
     
            // Attempt to update the record
            Department::where('id', $dept_id)->update([
                'group_no' => $validatedData['group-number'],
                'name' => $validatedData['dept-name'],
                'campus_id' => $validatedData['campus-id'],

                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'location' => $validatedData['location'],
                'fax' => $validatedData['fax'],
                'website' => $validatedData['website'],
                
            ]);
            // dd(DB::getQueryLog());

            return redirect()->route('dept_groups');

        } catch (ValidationException $e) {
            $errors = $e->validator->getMessageBag()->toArray();
            //dd($errors); // Output or log the validation errors
            // return back()-> withErrors($e->errors())->withInput();
            return response()->json(['errors' => $errors], 422);
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
                    'string',
                    'max:60'
                ],
                'fax' => [
                    'string',
                    'max:14'
                ],
                'website' => [
                    'string',
                    'max:100'
                ],
            ], $messages);

            // DB::enableQueryLog();
     
            // Attempt to update the record
            Department::create([
                'group_no' => $validatedData['group-number'],
                'name' => $validatedData['dept-name'],
                'campus_id' => $validatedData['campus-id'],

                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'location' => $validatedData['location'],
                'fax' => $validatedData['fax'],
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

        // $messages =[
        //     'dept_grp.unique' => 'The department group: ' . $req->dept_grp . ' is already in use. Cannot create another department with same group number.',
        //     'dept_grp_name.unique' => 'The department group name: ' . $req->dept_grp_name . ' is already in use. Cannot create another department with the same group name.',
        // ];
        // $validatedData = $req->validate([
        //     'dept_grp' => [
        //         'required',
        //         'string',
        //         'size:6',
        //         'unique:dept_group,dept_grp'
        //     ],
        //     'dept_grp_name' => [
        //         'required',
        //         'string',
        //         'min:3',
        //         'max:60',
        //         'unique:dept_group,dept_grp_name'
        //     ],
        //     'campus_code' => 'required',
        // ], $messages);
        
        return redirect() ->route('dept_groups');
    }


}
