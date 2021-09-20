<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Expenditure extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'tbl_expenditure';
    protected $guarded = [];

    public function createdBy(){
        return $this->hasMany(User::class, 'id', 'created_by');
    }

    public function updatedBy(){
        return $this->hasMany(User::class, 'id', 'updated_by');
    }
}
