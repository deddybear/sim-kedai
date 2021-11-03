<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Transaction;
use App\Models\Activity;
use App\Models\Stock;
use App\Models\Income;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];
    protected $table = 'tbl_users';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function income(){
        return $this->hasMany(Income::class, 'created_by', 'id');
    }

    public function activitys(){
        return $this->belongsToMany(Activity::class);
    }

    public function transactions(){
        return $this->belongsToMany(Transaction::class);
    }

    public function stocks(){
        return $this->belongsToMany(Stock::class);
    }

}
