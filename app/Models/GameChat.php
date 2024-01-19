<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameChat extends Model
{
    use HasFactory;
    protected $table = "gamechat";
    protected $primaryKey = "id";
    protected $fillable = ['game_id','message'];
    public $timestamps = false;
}
