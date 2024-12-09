<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Designation;
use App\Models\SalaryStructure;

class DesignationController extends Controller
{
    public function designation()
    {
        $departments  =  Department::all();
        $salaries  =  SalaryStructure::all();
        return view('admin.pages.Designation.designation', compact('departments', 'salaries'));
    }
}
