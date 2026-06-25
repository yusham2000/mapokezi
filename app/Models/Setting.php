<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'court_name',
        'welcome_text',
        'directions_text',
        'map_image',
        'slide_interval_seconds',
    ];
}
