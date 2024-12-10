<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Designation;
use App\Models\SalaryStructure;
use Illuminate\Support\Facades\Validator;

class DesignationController extends Controller
{
    public function designation()
    {
        $departments  =  Department::all();
        $salaries  =  SalaryStructure::all();
        return view('admin.pages.Designation.designation', compact('departments', 'salaries'));
    }

    public function designationStore(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'designation_name' => 'required',
            'salary_structure_id' => 'required|exists:salary_structures,id',
            'department_id' => 'required|exists:departments,id', // Validate department_id
            'leave_day' =>'required|integer|min:0',
        ]);

        if ($validate->fails()) {
            notify()->error($validate->getMessageBag());
            return redirect()->back();
        }

        $checkdesignation = Designation::orderBy('id', 'desc')->first();

        if (!empty($checkdesignation)) {
            $getNumber = Designation::orderBy('id', 'desc')->first()->designation_id;
            $Id = substr($getNumber,4);
            $DesignationId = str_pad(($Id + 1), 3, "0", STR_PAD_LEFT);
        } else {
            $DesignationId = str_pad((0 + 1), 3, "0", STR_PAD_LEFT);
        }

        Designation::create([
            'designation_name' => $request->designation_name,
            'designation_id' => 'Des_' .$DesignationId,
            'department_id' => $request->department_id, // Assign department_id
            'salary_structure_id' => $request->salary_structure_id, // Update salary_structure_id
            'leave_day' => $request->leave_day,
        ]);

        notify()->success('New Designation created successfully');
        return redirect()->back();
    }

    public function  designationList()
    {
        $designations = Designation::with(['department', 'salary'])
            ->latest('id')
            ->get();
        return view('admin.pages.Designation.designationList',  compact('designations'));
    }

    public function empdesignation(Request $request) 
    {
        $designationSelect = '';
        if ($request['id'] != "") {
            $designations = Designation::where('department_id' , $request['id'])->get();

            foreach ($designations as $designation) {
                $designationSelect .= '<option  value="' . $designation->id . '" ' .'>' . ucwords($designation->designation_name) . '</option>'; 
            }
        }
        return $designationSelect;
    }
}
