<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\LeaveType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class LeaveController extends Controller
{
    public function leave()
    {
        $leaves = Leave::all();
        $leaveTypes = LeaveType::all();
        return view('employee.pages.Leave.leaveForm', compact('leaves', 'leaveTypes'));
    }


    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'leave_type_id' => 'required',
            'description' => 'required',
        ]);

        if ($validate->fails()) {
            notify()->error($validate->getMessageBag());
            return redirect()->back();
        }

        // Ensure 'from_date' is not in the past
        $today = Carbon::today();
        $fromDate = Carbon::parse($request->from_date);

        if ($fromDate->lessThanOrEqualTo($today)) {
            notify()->error('Leave start date should be a future date.');
            return redirect()->back();
        }


        $fromDate = Carbon::parse($request->from_date);
        $toDate = Carbon::parse($request->to_date);
        $totalDays = $toDate->diffInDays($fromDate) + 1; // Calculate total days

        $leaveType = LeaveType::findOrFail($request->leave_type_id);
        $leaveTypeTotalDays = $leaveType->leave_days;

        $userId = auth('front-user')->user()->id; // auth()->user()->id;

        $totalTakenDaysForLeaveType = Leave::where('employee_id', $userId)
            ->where('leave_type_id', $request->leave_type_id)
            ->where('status', 'approved')
            ->sum('total_days');

        if (($totalTakenDaysForLeaveType + $totalDays) > $leaveTypeTotalDays) {
            notify()->error('Exceeds available leave days for this type.');
            return redirect()->back();
        }


        // Check if this is the first leave for the employee
        $firstLeave = Leave::where('employee_id', $userId)->count() === 0;

        if (!$firstLeave) {
            // Check if the employee's first leave is rejected or approved by the admin
            $firstLeaveStatus = Leave::where('employee_id', $userId)
                ->where('status', '!=', 'pending') // Exclude pending status (includes rejected and approved)
                ->orderBy('created_at', 'asc')
                ->value('status');

            if ($firstLeaveStatus === 'rejected') {
                // Allow reapplication if the first leave was rejected
                $firstLeaveStatus = 'approved';
            }

            if ($firstLeaveStatus !== 'approved') {
                notify()->error('You cannot take leave until your first leave is approved by the admin.');
                return redirect()->back();
            }
        }

        // Check if the previous leave's end date has passed
        $previousLeaveEndDate = Leave::where('employee_id', $userId)
            ->where('status', 'approved')
            ->orderBy('to_date', 'desc')
            ->value('to_date');

        if ($previousLeaveEndDate && Carbon::parse($previousLeaveEndDate)->isFuture()) {
            notify()->error('You cannot take leave until your previous leave date is over.');
            return redirect()->back();
        }

        Leave::create([
            // 'employee_name' => auth()->user()->name,
            // 'department_name' => optional(auth()->user()->employee->department)->department_name ?? 'Not specified',
            // 'designation_name' => optional(auth()->user()->employee->designation)->designation_name ?? 'Not specified',
            'employee_id' => $userId,
            'from_date' => $fromDate,
            'to_date' => $toDate,
            'total_days' => $totalDays,
            'leave_type_id' => $request->leave_type_id,
            'description' => $request->description,
        ]);

        notify()->success('New Leave created');
        return redirect()->back();
    }


    public function myLeave()
    {
        $userId = auth('front-user')->user()->id;
        // Retrieve leave records for the authenticated user only
        $leaves = Leave::where('employee_id', $userId)
            ->with(['type'])
            ->paginate(5);

        return view('employee.pages.Leave.myLeave', compact('leaves'));
    }


    public function showLeaveBalance()
    {
        $userId = auth('front-user')->user()->id;
    
        $designation = auth('front-user')->user()->designation->designation_name;
        
        // Define leave days based on designations
        $designationLeaveDays = [            
            auth('front-user')->user()->designation->designation_name => auth('front-user')->user()->designation->leave_day ,
        ];

        $leaveTypeBalances = [];
        $totalTakenDays = 0;

        $leaves = Leave::where('employee_id', $userId)
            ->whereYear('from_date', '=', date('Y'))
            ->with('type')
            ->get();

        foreach ($leaves as $leave) {
            $leaveType = $leave->type->leave_type_id;
            $leaveLimit = $leave->type->leave_days;

            if (!isset($leaveTypeBalances[$leaveType])) {
                $leaveTypeBalances[$leaveType] = [
                    'totalDays' => $leaveLimit,
                    'takenDays' => 0,
                    'availableDays' => $leaveLimit,
                ];
            }

            if ($leave->status === 'approved') {
                $leaveTypeBalances[$leaveType]['takenDays'] += $leave->total_days;
                $leaveTypeBalances[$leaveType]['availableDays'] -= $leave->total_days;
                $totalTakenDays += $leave->total_days;
            }
        }

        // Update available days based on designation 
        
        $availableDays = auth('front-user')->user()->designation->leave_day - $totalTakenDays;  
        $leaveTypeBalances[$designation] = [
            'totalDays' => auth('front-user')->user()->designation->leave_day,
            'takenDays' => $totalTakenDays,
            'availableDays' => $availableDays,
        ];

        return view('employee.pages.Leave.myLeaveBalance', compact('leaveTypeBalances', 'totalTakenDays', 'designationLeaveDays', 'designation', 'availableDays'));
    }

    public function myLeaveReport()
    {
        $userId = auth('front-user')->user()->id;

        // Retrieve only approved leave records for the authenticated user
        $leaves = Leave::where('employee_id', $userId)
            ->where('status', 'approved') // Fetch only approved leaves
            ->with(['type'])
            ->paginate(5);

        return view('employee.pages.Leave.myLeaveReport', compact('leaves'));
    }

     // search my leave
     public function searchMyLeave(Request $request)
     {
         $userId = auth('front-user')->user()->id;
         $searchTerm = $request->search;
 
         $query = Leave::where('employee_id', $userId)->with('type');
 
         if ($searchTerm) {
             $query->where(function ($q) use ($searchTerm) {
                 $q->whereHas('type', function ($typeQuery) use ($searchTerm) {
                     $typeQuery->where('leave_type_id', 'LIKE', '%' . $searchTerm . '%');
                 })
                     ->orWhere('from_date', 'LIKE', '%' . $searchTerm . '%')
                     ->orWhere('to_date', 'LIKE', '%' . $searchTerm . '%')
                     ->orWhere('total_days', 'LIKE', '%' . $searchTerm . '%')
                     ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                     ->orWhere('status', 'LIKE', '%' . $searchTerm . '%');
             });
         }
 
         $leaves = $query->paginate(5);
 
         return view('employee.pages.Leave.searchMyLeave', compact('leaves'));
     }
}
