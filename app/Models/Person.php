<?php

namespace App\Models;
use App\Models\Role;


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
        'location',
        'fax',
        'website',
        'publishable',
        'lastApprovedAt',
        'lastApprovedBy',
        'pending',
    ];

    public $timestamps = false;

    public function pendingPerson()
    {
        return $this->hasOne(PendingPerson::class, 'person_id');
    }

    public function roles() {
        return $this-> belongsToMany(Role::class, 'Person_Role')->withPivot('role_id');
    }

};
