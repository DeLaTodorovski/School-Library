<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Librarian extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;

    // Define your model configurations, such as fillable fields
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'image'];
}
