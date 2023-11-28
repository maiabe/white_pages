<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Department;

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
        'location',
        'fax',
        'website',
        'publishable',
        'lastApprovedAt',
        'lastApprovedBy',
        'pending',
    ];

    public $timestamps = false;

    public function departments()
    {
        return $this->belongsToMany(Person::class, 'person_department')->withPivot('dept_id');
    }

    // public function department()
    // {
    //     return $this->belongsTo(Department::class, 'dept_id');
    // }

    public function pendingPerson()
    {
        return $this->hasOne(PendingPerson::class, 'person_id');
    }
};
