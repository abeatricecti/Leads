<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\LeadSaved;

class Lead extends Model
{
    use HasFactory;

    protected $dispatchesEvents = [
        'saved' => LeadSaved::class,
    ];

}
