<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Players extends Model
{
    use HasFactory;
    protected $table = "playerspergame";
    protected $primaryKey = "id";
    protected $fillable = ['game_id','user_id','role_id','name','is_bot'];
    public $timestamps = false;
}
