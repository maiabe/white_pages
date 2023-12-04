<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $table = 'Announcement';

    protected $fillable = ['message', 'begin_date', 'end_date'];

    protected $dates = ['begin_date', 'end_date'];
}
