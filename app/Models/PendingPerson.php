<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingPerson extends Model
{
    use HasFactory;

    protected $table = 'PendingPerson';

    protected $fillable = [
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

};
