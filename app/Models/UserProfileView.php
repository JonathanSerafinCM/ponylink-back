<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfileView extends Model
{
    protected $table = 'user_profile_view';
    protected $primaryKey = 'user_id';
    public $timestamps = false;
}