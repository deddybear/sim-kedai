<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    use HasFactory;


    public $incrementing = false;
    protected $keyType = 'string';
    protected $table = 'tbl_expenditure';
    protected $guarded = [];

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
