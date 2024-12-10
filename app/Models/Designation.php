<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Designation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function salary()
    {
        return $this->belongsTo(SalaryStructure::class, 'salary_structure_id', 'id');
    }
}
