
<x-app-layout>
    <x-slot name="header">
    <div class="flex">
       
        <div class ="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:items-right">
            <h2 class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex font-semibold text-xl text-gray-800 leading-tight sm:ms-8">
                {{ __('Add Employee') }}
            </h2>
        </div>
        <div class ="hidden sm:flex sm:items-center sm:ms-4">
             <x-nav-link :href="route('organization.department.store')" :active="request()->routeIs(['organization.designation','register','login'])">
                {{ __('Add Department') }}
            </x-nav-link>
        </div>
    <div>
    </x-slot>
    
 <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="card-body">
                    <form action="{{ route('manageEmployee.addEmployee.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class=" col-md-4">
                                <div class="form-outline">
                                    <label class="form-label mt-2 fw-bold" for="form11Example1">Employee
                                        Name</label>
                                    <input required placeholder="Enter Name" type="text" id="form11Example1"
                                        name="name" class="form-control" />
                                </div>
                                <div class="mt-2">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            {{-- <div class=" col-md-4">
                                <div class="form-outline">
                                    <label class="form-label mt-2 fw-bold" for="form11Example1">Employee ID</label>
                                    <input required placeholder="Enter ID" type="text" id="form11Example1"
                                        name="employee_id" class="form-control" />
                                </div>
                                <div class="mt-2">
                                    @error('employee_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}
                            <div class=" col-md-4">
                                <div class="form-outline">
                                    <label class="form-label mt-2" for="form11Example1">Deparment Name</label>
                                    <select type="text" class="form-control" name="department_id" id="depat">
                                        @foreach ($departments as $department)
                                        <option value="{{$department->id}}">{{ $department->department_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-2">
                                    @error('department_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-4">
                            <div class=" col-md-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label mt-2 fw-bold" for="form11Example3">Date of
                                        Birth</label>
                                    <input required type="date" id="form11Example3" name="date_of_birth"
                                        class="form-control" />
                                </div>
                                <div class="mt-2">
                                    @error('date_of_birth')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label mt-2" for="form11Example1">Designation</label>
                                    <select required class="form-control" name="designation_id" id="designation_id">
                                        {{-- @foreach ($designations as $designation)
                                        <option value="{{$designation->id}}">{{ $designation->designation_name }}
                                        </option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="mt-2">
                                    @error('designation_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class=" col-md-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label mt-2 fw-bold" for="form11Example4">Hire Date</label>
                                    <input required placeholder="Enter date here" type="date" id="form11Example4"
                                        name="hire_date" class="form-control" />
                                </div>
                                <div class="mt-2">
                                    @error('hire_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row mb-4">
                            <div class=" col-md-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label mt-2 fw-bold" for="form11Example5">Email</label>
                                    <input required placeholder="Enter Email" type="email" id="form11Example5"
                                        name="email" class="form-control"
                                        pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
                                        title="Enter a valid email address" />
                                </div>
                                <div class="mt-2">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label mt-2 fw-bold" for="form11Example6">Phone</label>
                                    <input required placeholder="Phone Number" type="text" id="form11Example6"
                                        name="phone" class="form-control" 
                                        title="Enter a valid Bangladeshi phone number with optional +88 or 01 preceding 11 digits" />
                                </div>
                                <div class="mt-2">
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class=" col-md-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label mt-2 fw-bold" for="form11Example6">Image</label>
                                    <input type="file" id="form11Example6" name="employee_image"
                                        class="form-control" />
                                </div>
                                <div class="mt-2">
                                    @error('employee_image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class=" col-md-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label mt-2" for="form11Example1">Salary Grade</label>
                                    <select required class="form-control" name="salary_structure_id">
                                        @foreach ( $salaries as $salary)
                                        <option value="{{ $salary->id}}">{{ $salary->salary_class }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-2">
                                    @error('salary_structure_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class=" col-md-4">
                                <div class="form-outline mb-4">
                                    <label class="form-label mt-2 fw-bold" for="form11Example7">Location</label>
                                    <input required placeholder="Enter Location" type="text" id="form11Example6"
                                        name="location" class="form-control" pattern="[A-Za-z0-9\s]+"
                                        title="Enter a valid location (letters, numbers, and spaces only)" />
                                </div>
                                <div class="mt-2">
                                    @error('location')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class=" col-md-4">
                                <div class="form-outline">
                                    <label class="form-label mt-2 fw-bold" for="joinMode">Mode of Joining</label>
                                    <select required id="joinMode" name="joining_mode" class="form-select">
                                        <option value="interview">Interview</option>
                                        <option value="referral">Referral</option>
                                        <option value="walk-in">Walk-in</option>
                                    </select>
                                </div>
                                <div class="mt-2">
                                    @error('joining_mode')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center w-25 mx-auto">
                            <button type="submit"
                                class="btn btn-success p-2 text-lg rounded-pill col-md-10">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    window.site_url = '{!! url("/") !!}';
    
</script>
<script type="text/javascript">
    $("#depat").change(function () {
        var department = $(this).val(); 
        var ajaxUrl = site_url + '/employee/designation '; 
            jQuery.ajax({
                type: "POST",
                url: ajaxUrl,
                dataType: 'HTML',
                data: {"id": department},
                async: false,
                success: function (result) { 
                    $("#designation_id").html(result).trigger('change');
                },
            });
    });

</script>







