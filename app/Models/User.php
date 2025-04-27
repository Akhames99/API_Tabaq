<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens , Notifiable , HasFactory;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id', 'email', 'password_hash', 'name'];

}
