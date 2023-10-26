<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeptGroup extends Model
{
    use HasFactory;

    protected $table = 'dept_group';
    public $timestamps = false;
}
