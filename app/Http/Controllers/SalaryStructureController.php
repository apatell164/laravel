<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalaryStructure;
use Illuminate\Support\Facades\Validator;

class SalaryStructureController extends Controller
{
    public function createSalary()
    {
        return view('admin.pages.SalaryStructure.createSalary');
    }

    public function viewSalary()
    {
        $salaries = SalaryStructure::paginate(3);
        return view('admin.pages.SalaryStructure.viewSalary', compact('salaries'));
    }

    public function salaryStore(Request $request)
    {
        // dd($request->all());
        $validate = Validator::make($request->all(), [
            'salary_class' => 'required|string',
            'basic_salary' => 'required|numeric|min:0',
            'medical_expenses' => 'required|numeric|min:0',
            'mobile_allowance' => 'required|numeric|min:0',
            'houseRent_allowance' => 'required|numeric|min:0',
        ]);

        if ($validate->fails()) {
            notify()->error($validate->getMessageBag());
            return redirect()->back();
        }

        SalaryStructure::create([
            'salary_class' => $request->salary_class,
            'basic_salary' => $request->basic_salary,
            'medical_expenses' => $request->medical_expenses,
            'mobile_allowance' => $request->mobile_allowance,
            'houseRent_allowance' => $request->houseRent_allowance,
        ]);
        notify()->success('New Salary created successfully.');
        return redirect()->back();
    }
}
