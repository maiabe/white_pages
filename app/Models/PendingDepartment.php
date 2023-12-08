<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Person;

class PendingDepartment extends Model
{
    use HasFactory;

    protected $table = 'PendingDepartment';
    protected $fillable = [
        'status',
        'dept_id',
        'campus_id',
        'group_no',
        'name',
        'email',
        'phone',
        'location',
        'fax',
        'website'
    ];

    public $timestamps = false;
    
}
