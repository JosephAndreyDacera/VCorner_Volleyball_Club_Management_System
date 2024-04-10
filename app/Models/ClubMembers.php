<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubMembers extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cm_ui_id',
        'cm_c_id',
        'cm_mt_id',
        'cm_date_joined'
    ];

    use HasFactory;
}
