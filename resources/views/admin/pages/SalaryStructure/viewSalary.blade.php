
<x-app-layout>
    <x-slot name="header">
    <div class="flex">
       
        <div class ="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:items-right">
            <h2 class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex font-semibold text-xl text-gray-800 leading-tight sm:ms-8">
                {{ __('Employee List') }}
            </h2>
        </div>
        <div class ="hidden sm:flex sm:items-center sm:ms-4">
             <x-nav-link :href="route('manageEmployee.addEmployee')">
                {{ __('Add Employee') }}
            </x-nav-link>
        </div>
    <div>
    </x-slot>

<div class="shadow p-4 d-flex justify-content-between align-items-center">
    <h4 class="text-uppercase">View Salary List</h4>
    <div>
        <a href="{{ route('salary.create.form') }}" class="btn btn-success p-2 text-lg rounded-pill"><i
                class="fa-solid fa-plus  me-1"></i>Create New
            Salary</a>
    </div>
</div>
<div class="container my-5 py-5">
    <table class="table align-middle mb-4 text-center bg-white">
        <thead class="bg-light">
            <tr>
                <th>SL NO</th>
                <th>Salary Class</th>
                <th>Basic Salary</th>
                <th>Medical Expenses</th>
                <th>Mobile Allowance</th>
                <th>House Rent Allowance</th> <!-- Added new header for House Rent Allowance -->
                <th>Total Salary</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salaries as $key => $salary)
            @php
            // Include house rent allowance in total salary calculation
            $totalSalary = $salary->basic_salary + $salary->medical_expenses +
            $salary->mobile_allowance + $salary->houseRent_allowance;
            $salary->total_salary = $totalSalary;
            $salary->save();
            @endphp
            <tr>
                <td>
                    <div>
                        <p class="fw-bold mb-1">{{ $key + 1 }}</p>
                    </div>
                </td>
                <td>{{ $salary->salary_class }}</td>
                <td>{{ $salary->basic_salary }} RS</td>
                <td>{{ $salary->medical_expenses }} RS</td>
                <td>{{ $salary->mobile_allowance }} RS</td>
                <td>{{ $salary->houseRent_allowance }} RS</td>
                <!-- Displaying House Rent Allowance -->
                <td>{{ $totalSalary }} RS</td>
                <td>
                    <a class="btn btn-success rounded-pill" href="{{ route('salaryEdit', $salary->id) }}"><i
                            class="fa-solid fa-pen-to-square"></i></a>
                    <a class="btn btn-danger rounded-pill" href="{{ route('salaryDelete', $salary->id) }}"><i
                            class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-25 mx-auto">
        {{ $salaries->links() }}
    </div>
</div>
</x-app-layout>
