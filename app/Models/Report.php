<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    protected $table='reports';
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];

}
