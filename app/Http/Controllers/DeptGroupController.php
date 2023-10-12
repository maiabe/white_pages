<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeptGroup;

class DeptGroupController extends Controller
{
    public function index(){
        $data = DeptGroup::all();
        return view('dept_group',['data' => $data]);
    }
    
    public function destroy($dept_grp){
        DeptGroup::where('dept_grp',$dept_grp)->delete();
        return redirect()->route('dept_group.index');
    }
}
