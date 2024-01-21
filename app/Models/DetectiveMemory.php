<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetectiveMemory extends Model
{
    use HasFactory;
    protected $table = "detectivememory";
    protected $primaryKey = "id";
    protected $fillable = ['game_id','player_id'];
    public $timestamps = false;
}
