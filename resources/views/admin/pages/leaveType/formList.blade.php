<x-app-layout>
    <x-slot name="header">
    <div class="flex">
       
        <div class ="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:items-right">
            <h2 class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex font-semibold text-xl text-gray-800 leading-tight sm:ms-8">
                {{ __('Leave Type') }}
            </h2>
        </div>
        {{-- <div class ="hidden sm:flex sm:items-center sm:ms-4">
             <x-nav-link :href="route('manageEmployee.addEmployee')">
                {{ __('Add Employee') }}
            </x-nav-link>
        </div> --}}
    <div>
    </x-slot>

<div class="container my-5 py-5">
@include('notify::components.notify')
    <!--Section: Form Design Block-->
    <section>
        <div class="d-flex gap-5 justify-content-center align-content-center ">

            {{-- Department Form start --}}
            <div class="text-left w-25 ">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h5 class="text-uppercase">New Leave</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('leave.leaveType.store') }}" method="post">
                            @csrf
                            <div class="row mb-4">
                                <div class="col">
                                    <div class="form-outline">
                                        <label class="form-label mt-2" for="form11Example1">Leave Type</label>
                                        <input placeholder="Enter Leave Type" class="form-control" name="leave_type_id"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class=" col">
                                    <div class="col">
                                        <div class="form-outline">
                                            <label class="form-label mt-2" for="form11Example1">Leave Days</label>
                                            <input placeholder="Number of Days" class="form-control" name="leave_days"
                                                required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center w-25 mx-auto">
                                <button type="submit" class="btn btn-success p-2 px-3 rounded-pill">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Department Table start --}}
            <div class="w-75 card">
                <div>
                    <table class="table align-middle mb-4 text-center bg-white">
                        <thead class="bg-light">
                            <tr>
                                <th>SL NO</th>
                                <th>Leave Type</th>
                                <th>Leave Days</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leaveTypes as $key => $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->leave_type_id }}</td>
                                <td>{{ $item->leave_days }}</td>
                                <td>
                                    <a class="btn btn-success rounded-pill fw-bold text-white"
                                        href="{{ route('leave.leaveType.edit', $item->id) }}">Edit</a>
                                    <a class="btn btn-danger rounded-pill fw-bold text-white"
                                        href="{{ route('leave.leaveType.delete', $item->id) }}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
</div>
</x-app-layout>