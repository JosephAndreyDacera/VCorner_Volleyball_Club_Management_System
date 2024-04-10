<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'c_name',
        'c_date_founded',
        'c_address',
        'c_logo',
        'c_email',
        'c_mobile',
        'c_facebook',
        'c_instagram',
        'c_x',
        'c_youtube',
        'c_website',
        'c_invite_code'
    ];

    use HasFactory;
}
