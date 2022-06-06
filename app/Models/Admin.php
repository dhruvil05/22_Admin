<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = "admins";
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'gender',
        'country',
        'image',

    ];
    
    public function setFirstnameAttribute($value)
    {
        $this->attributes['firstname'] = ucwords($value);
    }
    public function setLastnameAttribute($value)
    {
        $this->attributes['lastname'] = ucwords($value);
    }
}
