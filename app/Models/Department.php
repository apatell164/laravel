<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Designation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function designations()
    {
        return $this->hasMany(Designation::class ,'designation_id' ,'id' );
    }
}
