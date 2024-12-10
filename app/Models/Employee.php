<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Authenticatable
{
    use  Notifiable;
    use HasFactory;

    protected $guarded = [];
    // protected $fillable = ['name', 'email', 'password'];

    // protected $hidden = ['password', 'remember_token'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }

    public function salaryStructure()
    {
        return $this->belongsTo(SalaryStructure::class);
    }

    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }

}


