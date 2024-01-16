<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameDb extends Model
{
    use HasFactory;

    protected $table = "gamedb";
    protected $primaryKey = "id";
    protected $fillable = ['userCreateId'];
    public $timestamps = false;
}
