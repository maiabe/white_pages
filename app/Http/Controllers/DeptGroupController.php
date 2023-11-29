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

        $columnNames = ['Campus Code', 'Group Number', 'Name'];
        $campusData = Campus::distinct()->pluck('code');
        
        $data = Department::select('id', 'campus_id', 'group_no', 'name')
        ->get()
        ->map(function($item) use ($campusData) {
            $campus = Campus::where('id', $item->campus_id)->first();
            return (object) [
                'dept_id' => ['columnName' => '', 
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
                                    'type' => gettype($item->group_no),
                                    'inputType' => 'text'
                                ],
                'dept_name' => ['columnName' => 'Department Name', 
                                    'name' => 'dept-name', 
                                    'value' => $item->name,
                                    'type' => gettype($item->name),
                                    'inputType' => 'text'
                                ],
            ];
        });


        return view('DeptGroups.dept_groups', ['columnNames' => $columnNames,'data' => $data, 'campusData' => $campusData]);
    }

    public function destroy($dept_grp)
    {
        DeptGroup::where('dept_grp', $dept_grp)->delete();
        return redirect()->route('dept_groups');
    }

    public function update(Request $req)
    {
        try {
            $dept_id = (int) $req['dept-id'];
            $grp_num = $req['group-number'];
            $dept_name = $req['dept-name'];
            $campus_code = $req['campus-code'];
    
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
            ], $messages);

            // DB::enableQueryLog();
     
            // Attempt to update the record
            Department::where('id', $dept_id)->update([
                'group_no' => $validatedData['group-number'],
                'name' => $validatedData['dept-name'],
                'campus_id' => $validatedData['campus-id']
            ]);
            // dd(DB::getQueryLog());

            return redirect()->route('dept_groups');

        } catch (ValidationException $e) {
            $errors = $e->validator->getMessageBag()->toArray();
            dd($errors); // Output or log the validation errors
            return back()-> withErrors($e->errors())->withInput();
        }
        
    }

    public function store(Request $req) {
        $messages =[
            'dept_grp.unique' => 'The department group: ' . $req->dept_grp . ' is already in use. Cannot create another department with same group number.',
            'dept_grp_name.unique' => 'The department group name: ' . $req->dept_grp_name . ' is already in use. Cannot create another department with the same group name.',
        ];
        $validatedData = $req->validate([
            'dept_grp' => [
                'required',
                'string',
                'size:6',
                'unique:dept_group,dept_grp'
            ],
            'dept_grp_name' => [
                'required',
                'string',
                'min:3',
                'max:60',
                'unique:dept_group,dept_grp_name'
            ],
            'campus_code' => 'required',
        ], $messages);
        DeptGroup::create([
            'dept_grp' => $validatedData['dept_grp'],
            'dept_grp_name' => $validatedData['dept_grp_name'],
            'campus_code' => $validatedData['campus_code']
        ]);
        return redirect() ->route('dept_groups');
    }


}
