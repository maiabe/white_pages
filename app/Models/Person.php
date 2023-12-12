<?php

namespace App\Models;
use App\Models\Role;
use App\Models\Department;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Person extends Model
{
    use HasFactory;

    protected $table = 'Person';

    protected $fillable = [
        'username',
        'name',
        'name_of_record',
        'job_title',
        'email',
        'alias_email',
        'phone',
        'fax',
        'location',
        'website',
        'publishable',
        'lastApprovedAt',
        'lastApprovedBy',
    ];

    public $timestamps = false;

    public function pendingPerson()
    {
        return $this->hasOne(PendingPerson::class, 'person_id');
    }

    public function roles() {
        return $this-> belongsToMany(role::class, 'Person_Role')->withPivot('role_id');
    }


    public function departments() {
        return $this-> belongsToMany(Department::class, 'Person_Department', 'person_id', 'dept_id')->withPivot('dept_id');
    }

};
