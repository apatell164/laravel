
<x-app-layout>

    <x-slot name="header">
     <div class="flex">
        <div class ="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:items-right">
            <h2 class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex font-semibold text-xl text-gray-800 leading-tight sm:ms-8">
                {{ __('Add Designation') }}
            </h2>
        </div>
        <div class ="hidden sm:flex sm:items-center sm:ms-6">
             <x-nav-link :href="route('organization.designationList')" >
                {{ __('Back') }}
            </x-nav-link>
        </div>
        </div>
    </x-slot>

  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
            <div class="card-body">
                <form action="{{ route('organization.designation.store') }}" method="post">
                    @csrf
                    <div class="row mb-4">
                        <div class=" col">
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label mt-2" for="form11Example1">Designation Name</label>
                                    <input type="text" class="form-control" name="designation_name" id="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label mt-2" for="form11Example1">Deparment Name</label>
                                <select type="text" class="form-control" name="department_id">
                                    @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{ $department->department_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <label class="form-label mt-2" for="form11Example1">Leave Days</label>
                                    <input type="text" class="form-control" name="leave_day" id="" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class=" col">
                            <div class="col">
                                <div class="form-outline">
                                    <label class="form-label mt-2" for="form11Example1">Salary Class</label>
                                    <select required class="form-control" name="salary_structure_id">
                                        @foreach ($salaries as $salary)
                                        <option value="{{$salary->id}}">{{ $salary->salary_class }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center w-25 mx-auto">
                        <button type="submit" class="btn btn-info p-2 rounded">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
