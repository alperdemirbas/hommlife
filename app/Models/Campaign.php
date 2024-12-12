<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;
    protected $table = 'campaign';
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
    ];

    protected array $dates = [
        'start_date',
        'end_date'
    ];

}
