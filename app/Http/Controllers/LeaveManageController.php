<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class LeaveManageController extends Controller
{
    public function leaveList()
    {

        $leaves = Leave::with(['type' , 'employee' ,'employee.department' , 'employee.designation'])->paginate(5);
        return view('admin.pages.Leave.leaveList', compact('leaves'));
    }

    // Approve and Reject Leave
    public function approveLeave($id)
    {
        $leave = Leave::find($id);
        $leave->status = 'approved'; // Assuming 'status' is a field in your 'leaves' table
        $leave->save();

        notify()->success('Leave approved');
        return redirect()->back();
    }

    public function rejectLeave($id)
    {
        $leave = Leave::find($id);
        $leave->status = 'rejected'; // Assuming 'status' is a field in your 'leaves' table
        $leave->save();

        notify()->error('Leave rejected');
        return redirect()->back();
    }

    public function allLeaveReport()
    {
        $leaves = Leave::where('status', 'approved')
            ->with(['type' , 'employee' ,'employee.department' , 'employee.designation'])
            ->paginate(5);
// dd($leaves );
        return view('admin.pages.Leave.allLeaveReport', compact('leaves'));
    }
}
