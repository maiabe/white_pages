<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeptGroup extends Model
{
    use HasFactory;

    protected $table = 'dept_group';
    protected $fillable = ['campus_code','dept_grp','dept_grp_name'];
    public $timestamps = false;

}
