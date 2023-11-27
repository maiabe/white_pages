<?php

namespace App\Http\Controllers;

use http\Message;
use Illuminate\Http\Request;
use App\Models\DeptGroup;
use App\Models\Campus;
use Illuminate\Support\Facades\Schema;

class DeptGroupController extends Controller
{
    public function index()
    {
        $columnNames = ['Campus Code', 'Group Number', 'Name'];
        $campusData = Campus::distinct()->pluck('code');

        $data = DeptGroup::select('campus_code', 'dept_grp', 'dept_grp_name')
        ->get()
        ->map(function($item) use ($campusData) {

            return (object) [
                'campus_code' => ['displayName' => 'Campus Code', 
                                    'name' => 'campus-code', 
                                    'value' => $item->campus_code,
                                    'type' => 'select',
                                    'options' => $campusData,
                                ],
                'group_number' => ['displayName' => 'Group Number', 
                                    'name' => 'group-number', 
                                    'value' => $item->dept_grp, 
                                    'type' => 'text'
                                ],
                'group_name' => ['displayName' => 'Group Name', 
                                    'name' => 'group-name', 
                                    'value' => $item->dept_grp_name, 
                                    'type' => 'text'
                                ],
            ];
        });

        /* echo '<pre>';
            print_r($campusData);
        echo '</pre>'; */

        return view('DeptGroups.dept_groups', ['columnNames' => $columnNames,'data' => $data, 'campusData' => $campusData]);
    }

    public function destroy($dept_grp,)
    {
        DeptGroup::where('dept_grp', $dept_grp)->delete();
        return redirect()->route('dept_groups');
    }

    public function update(Request $req)
    {
        echo 'inside deptgrp update controller';
        $result = $req->all();

        $formData = $req->json()->get('formData');
        dd($formData); // formData object present in the config attribute

        //-- TODO: need to do below using the $formData json object above

        // $deptGroup = DeptGroup::where('dept_grp', $dept_grp)->first();

        // $messages = [
        //     'dept_grp.unique' => 'The department group: ' . $req->dept_grp . ' is already in use. Fail to update for the department group: ' . $deptGroup->dept_grp . ".",
        //     'dept_grp_name.unique' => 'The department group name:' . $req->dept_grp_name . 'is already in use. Fail to update for the department group name: ' . $deptGroup->dept_grp_name . ".",
        // ];

        // // Define validation rules
        // $validatedData = $req->validate([
        //     'dept_grp' => [
        //         'required',
        //         'string',
        //         'size:6',
        //         'unique:dept_group,dept_grp,' . $dept_grp . ',dept_grp'
        //     ],
        //     'dept_grp_name' => [
        //         'required',
        //         'string',
        //         'max:60',
        //         'unique:dept_group,dept_grp_name,' . $deptGroup->dept_grp_name . ',dept_grp_name'
        //     ],
        //     'campus_code' => 'required',
        // ], $messages);

        // // Attempt to update the record
        // DeptGroup::where('dept_grp', $dept_grp)->update([
        //     'dept_grp' => $validatedData['dept_grp'],
        //     'dept_grp_name' => $validatedData['dept_grp_name'],
        //     'campus_code' => $validatedData['campus_code']
        // ]);

        return redirect()->route('dept_groups');
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
