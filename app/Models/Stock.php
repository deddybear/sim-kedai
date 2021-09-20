<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Stock extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'tbl_stocks';
    protected $guarded = [];

    public function createdBy(){
        return $this->hasMany(User::class, 'id', 'created_by');
    }

    public function updatedBy(){
        return $this->hasMany(User::class, 'id', 'updated_by');
    }
}
