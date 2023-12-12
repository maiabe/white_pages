<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\role;

class AdminController extends Controller
{
    public function index()
    {

        // Get Person records with Admin roles
        $admins = Person::whereHas('roles', function($query) {
            $query->where('name', 'Admin');
        })->get();

        $columnNames = ['Username', 'Name', 'Job Title', 'Email', 'Phone', 'Location'];

        $data = $admins->map(function($item) {
            return (object) [
                        'person_id' => ['columnName' => 'id', 
                                            'name' => 'person-id', 
                                            'value' => $item['id'],
                                            'type' => gettype($item['id']),
                                            'inputType' => 'hidden',
                                        ],
                        'username' => ['columnName' => 'Username', 
                                            'name' => 'username', 
                                            'value' => $item['username'],
                                            'type' => gettype($item['username']),
                                            'inputType' => 'text',
                                        ],
                        'name' => ['columnName' => 'Name', 
                                            'name' => 'name', 
                                            'value' => $item['name'],
                                            'type' => gettype($item['name']),
                                            'inputType' => 'text'
                                        ],
                        'job_title' => ['columnName' => 'Job Title', 
                                            'name' => 'job-title', 
                                            'value' => $item['job_title'],
                                            'type' => gettype($item['job_title']),
                                            'inputType' => 'text'
                                        ],
                        'email' => ['columnName' => 'Email', 
                                            'name' => 'email', 
                                            'value' => $item['email'],
                                            'type' => gettype($item['email']),
                                            'inputType' => 'email',
                                        ],
                        'phone' => ['columnName' => 'Phone', 
                                            'name' => 'phone', 
                                            'value' => $item['phone'],
                                            'type' => gettype($item['phone']),
                                            'inputType' => 'tel',
                                        ],
                        'location' => ['columnName' => 'Location', 
                                            'name' => 'location', 
                                            'value' => $item['location'],
                                            'type' => gettype($item['location']),
                                            'inputType' => 'text'
                                        ],
                    ];
        });

        // dd($data);


        return view('Admins.admins', ['data'=> $data]);
    }
}





