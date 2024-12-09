<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function department()
    {
        $departments = Department::all();
        return view('admin.pages.Department.department', compact('departments'));
    }

    public function add()
    {
        return view('admin.pages.Department.add');
    }


    public function store(Request $request)
    {
        // dd($request->all());

        $checkdepartment = Department::orderBy('id', 'desc')->first();

        if (!empty($checkdepartment)) {
            $getNumber = Department::orderBy('id', 'desc')->first()->DepartmentId;
            $DepartmentId = str_pad(($getNumber + 1), 3, "0", STR_PAD_LEFT);
        } else {
            $DepartmentId = str_pad((0 + 1), 3, "0", STR_PAD_LEFT);
        }


        $validate = Validator::make($request->all(), [
            'department_name' => 'required',
            // 'department_id' => 'required',
        ]);

        if ($validate->fails()) {

            notify()->error($validate->getMessageBag());
            return redirect()->back();

            // return redirect()->back()->withErrors($validate);
        }

        Department::create([
            'department_name' => $request->department_name,
            'department_id' =>'D_' .$DepartmentId,
        ]);
        notify()->success('New Department created successfully.');
        return redirect()->back();
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('admin.pages.Department.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $department = Department::find($id);
        if ($department) {
            $department->update([
                'department_name' => $request->department_name,
                'department_id' => $request->department_id,
            ]);
            notify()->success('Updated successfully.');
            return redirect()->route('organization.department');
        }
    }
}
