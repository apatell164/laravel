
<x-app-layout>

    <x-slot name="header">
     <div class="flex">
        <div class ="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:items-right">
            <h2 class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex font-semibold text-xl text-gray-800 leading-tight sm:ms-8">
                {{ __('edit Department') }}
            </h2>
        </div>
        <div class ="hidden sm:flex sm:items-center sm:ms-6">
             <x-nav-link :href="route('organization.department')" >
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
                        <form action="{{ route('Organization.update', $department->id) }}" method="post" id="frmDept">
                            @csrf
                            @method('put')
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label mt-2" for="form11Example1">Department ID</label>
                                        <input value="{{ $department->department_id }}" placeholder="Enter ID"
                                            class="form-control" name="department_id" id="" required readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class=" col">
                                    <div class="col">
                                        <div class="form-outline">
                                            <label class="form-label mt-2" for="form11Example1">Department Name</label>
                                            <input value="{{ $department->department_name }}" placeholder="Enter Name"
                                                class="form-control" name="department_name" id="" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center w-25 mx-auto">
                                <button type="submit" class="btn btn-info p-2 rounded">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ config('constants.APP_URL') .'js/department/department_validations.js?v=0.1' }}" type="text/javascript"></script>