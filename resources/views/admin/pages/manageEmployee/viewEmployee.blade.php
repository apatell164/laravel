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
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table align-middle text-center bg-white">
                        <thead class="bg-light">
                            <tr>
                                <th>SL NO</th>
                                <th>Employee Name</th>
                                <th>Image</th>
                                <th>Employee ID</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Salary Grade</th>
                                <th>Mode of Join</th>
                                {{-- <th>Password</th> --}}
                                {{-- <th>Phone</th> --}}
                                {{-- <th>Email</th> --}}
                                {{-- <th>Salary</th> --}}
                                {{-- <th>Location</th> --}}
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($employees as $key => $employee)
                            <tr>
                                <td>
                                    <div>
                                        <p class="fw-bold mb-1">{{ $key + 1 }}</p>
                                    </div>
                                </td>
                                <td>{{ $employee->name }}</td>
                                <td><img class="avatar p-1" src="" alt="">
                                </td>
                                <td>{{ $employee->employee_id }}</td>
                                <td>{{ optional($employee->department)->department_name }}</td>
                                <td>{{ optional($employee->designation)->designation_name }}</td>
                                <td>{{ optional($employee->salaryStructure)->salary_class }}</td>
                                <td>{{ $employee->joining_mode }}</td>
                                {{-- <td>{{ $employee->password }}</td> --}}
                                {{-- <td>{{ $employee->phone }}</td> --}}
                                {{-- <td>{{ $employee->email }}</td> --}}
                                {{-- <td>{{ $employee->salary }}</td> --}}
                                {{-- <td>{{ $employee->location }}</td> --}}
                                <td>
                                    <a class="btn btn-warning text-white rounded-pill fw-bold"
                                        href="{{ route('Employee.profile', $employee->id) }}">Profile</a>
                                    <a class="btn btn-success text-white rounded-pill fw-bold"
                                        href="{{ route('Employee.edit', $employee->id) }}">Edit</a>
                                    <a class="btn btn-danger text-white rounded-pill fw-bold" href="#" data-bs-toggle="modal"
                                        data-bs-target="#deleteEmployeeModal"
                                        onclick="prepareDeleteForm('{{ route('Employee.delete', $employee->id) }}')">
                                        Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="w-25 mx-auto mt-4">
                        {{ $employees->links() }}
                    </div>
                

                    <div class="modal" id="deleteEmployeeModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this employee?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <form id="deleteForm" method="get">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function prepareDeleteForm(deleteUrl) {
        document.getElementById('deleteForm').setAttribute('action', deleteUrl);
    }
</script>

