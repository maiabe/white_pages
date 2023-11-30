<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeptContactController extends Controller
{
    public function index()
    {

        // $columnNames = ['Campus Code', 'Group Number', 'Name', 'Email', 'Phone', 'Location', 'Fax', 'Website'];
        // $campusData = Campus::distinct()->pluck('code');
        
        // $data = Person::select('id', 'campus_id', 'group_no', 'name', 'email', 'phone', 'location', 'fax', 'website')
        // ->get()
        // ->map(function($item) use ($campusData) {
        //     $campus = Campus::where('id', $item->campus_id)->first();
        //     return (object) [
        //         'dept_id' => ['columnName' => 'id', 
        //                             'name' => 'dept-id', 
        //                             'value' => $item->id,
        //                             'type' => gettype($campus->code),
        //                             'inputType' => 'hidden',
        //                         ],
        //         'campus_code' => ['columnName' => 'Campus Code', 
        //                             'name' => 'campus-code', 
        //                             'value' => $campus->code,
        //                             'type' => gettype($campus->code),
        //                             'inputType' => 'select',
        //                             'options' => $campusData,
        //                         ],
        //         'group_number' => ['columnName' => 'Group Number', 
        //                             'name' => 'group-number', 
        //                             'value' => $item->group_no,
        //                             'type' => gettype($item->group_no),
        //                             'inputType' => 'text'
        //                         ],
        //         'dept_name' => ['columnName' => 'Department Name', 
        //                             'name' => 'dept-name', 
        //                             'value' => $item->name,
        //                             'type' => gettype($item->name),
        //                             'inputType' => 'text'
        //                         ],
        //         'email' => ['columnName' => 'Email', 
        //                             'name' => 'email', 
        //                             'value' => $item->email,
        //                             'type' => gettype($item->email),
        //                             'inputType' => 'email',
        //                         ],
        //         'phone' => ['columnName' => 'Phone', 
        //                             'name' => 'phone', 
        //                             'value' => $item->phone,
        //                             'type' => gettype($item->phone),
        //                             'inputType' => 'tel',
        //                         ],
        //         'location' => ['columnName' => 'Location', 
        //                             'name' => 'location', 
        //                             'value' => $item->location,
        //                             'type' => gettype($item->location),
        //                             'inputType' => 'text'
        //                         ],
        //         'fax' => ['columnName' => 'Fax', 
        //                             'name' => 'fax', 
        //                             'value' => $item->fax,
        //                             'type' => gettype($item->fax),
        //                             'inputType' => 'tel'
        //                         ],
        //         'website' => ['columnName' => 'Website', 
        //                             'name' => 'website', 
        //                             'value' => $item->website,
        //                             'type' => gettype($item->website),
        //                             'inputType' => 'url'
        //                         ],
        //     ];
        // });


        
        // return view('DeptContacts.dept_contacts', ['columnNames' => $columnNames,'data' => $data, 'campusData' => $campusData]);
        return view('DeptContacts.dept_contacts');
    }
    



}