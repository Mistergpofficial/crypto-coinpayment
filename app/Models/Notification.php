<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['id', 'user_id', 'user_full_name', 'upline_username', 'status', 'note'];
}
