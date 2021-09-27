<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Activity extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    protected $table = 'tbl_activitys';
    public $timestamps = false;

    public function user(){
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
