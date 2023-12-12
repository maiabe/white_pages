<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingPerson extends Model
{
    use HasFactory;

    protected $table = 'PendingPerson';

    protected $fillable = [
        'status',
        'person_id',
        'username',
        'name',
        'name_of_record',
        'job_title',
        'email',
        'alias_email',
        'phone',
        'location',
        'fax',
        'website',
        'publishable',
        'lastApprovedAt',
        'lastApprovedBy'
    ];

    public $timestamps = false;

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function roles() {
        return $this-> belongsToMany(role::class, 'PPerson_Role')->withPivot('role_id');
    }

    public function departments() {
        return $this-> belongsToMany(Department::class, 'PPerson_Department', 'pperson_id', 'dept_id')->withPivot('dept_id');
    }

};
