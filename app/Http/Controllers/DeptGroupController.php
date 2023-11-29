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
        $columnNames = ['Campus Code', 'Group Number', 'Name'];
        $campusData = Campus::distinct()->pluck('code');

        $data = DeptGroup::select('campus_code', 'dept_grp', 'dept_grp_name')
        ->get()
        ->map(function($item) use ($campusData) {

            return (object) [
                'campus_code' => ['displayName' => 'Campus Code', 
                                    'name' => 'campus-code', 
                                    'value' => $item->campus_code,
                                    'type' => gettype($item->campus_code),
                                    'inputType' => 'select',
                                    'options' => $campusData,
                                ],
                'group_number' => ['displayName' => 'Group Number', 
                                    'name' => 'group-number', 
                                    'value' => $item->dept_grp,
                                    'type' => gettype($item->dept_grp),
                                    'inputType' => 'text'
                                ],
                'group_name' => ['displayName' => 'Group Name', 
                                    'name' => 'group-name', 
                                    'value' => $item->dept_grp_name,
                                    'type' => gettype($item->dept_grp_name),
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
            $grp_num = $req['group-number'];
            $grp_name = $req['group-name'];
            $campus_code = $req['campus-code'];
    
            $dept_group = DeptGroup::where('dept_grp', $grp_num)->first();
    
            // echo $req;
    
            $messages = [
                'dept_grp.unique' => 'The department group: ' . $grp_num . ' is already in use. Fail to update for the department group: ' . $grp_num . ".",
                'dept_grp_name.unique' => 'The department group name:' . $grp_name . 'is already in use. Fail to update for the department group name: ' . $grp_name. ".",
            ];
    
            // Define validation rules
            $validatedData = $req->validate([
                'group-number' => [
                    'required',
                    'string',
                    'size:6',
                    'unique:dept_group,dept_grp,' . $grp_num . ',dept_grp'
                ],
                'group-name' => [
                    'required',
                    'string',
                    'max:60',
                    'unique:dept_group,dept_grp_name,' . $grp_name . ',dept_grp_name'
                ],
                'campus-code' => 'required',
            ], $messages);
    
    
            // Attempt to update the record
            DeptGroup::where('dept_grp', $grp_num)->update([
                'dept_grp' => $validatedData['group-number'],
                'dept_grp_name' => $validatedData['group-name'],
                'campus_code' => $validatedData['campus-code']
            ]);

            return redirect()->route('dept_groups');

        } catch (ValidationException $e) {
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
