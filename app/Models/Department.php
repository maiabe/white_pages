<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'Department';
    protected $fillable = [
        'campus_id',
        'group_no',
        'name',
        'email',
        'phone',
        'location',
        'fax',
        'website'
    ];
}
