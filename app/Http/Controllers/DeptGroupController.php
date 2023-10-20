<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeptGroup;
use App\Models\Campus;

class DeptGroupController extends Controller
{
    public function index(){
        $data = DeptGroup::all();
        $campusData = Campus::distinct()->pluck('campus_code');
        return view('dept_group', ['data' => $data, 'campusData' => $campusData]);
    }

    public function destroy($dept_grp,){
        DeptGroup::where('dept_grp',$dept_grp)->delete();
        return redirect()->route('dept_group.index');
    }

    public function update(Request $req, $dept_grp) {
        $deptGroup = DeptGroup::where('dept_grp', $dept_grp)->first();
        // Define validation rules
        $validatedData = $req->validate([
            'dept_grp' => [
                'required',
                'string',
                'size:6',
                'unique:dept_group,dept_grp,' . $dept_grp . ',dept_grp'
            ],
            'dept_grp_name' => [
                'required',
                'string',
                'max:60',
                'unique:dept_group,dept_grp_name,' . $deptGroup->dept_grp_name . ',dept_grp_name'
            ],
            'campus_code' => 'required|string|max:6',
        ]);

        // Attempt to update the record
        DeptGroup::where('dept_grp', $dept_grp)->update([
            'dept_grp' => $validatedData['dept_grp'],
            'dept_grp_name' => $validatedData['dept_grp_name'],
            'campus_code' => $validatedData['campus_code']
        ]);

        return redirect()->route('dept_group.index');
    }


}
