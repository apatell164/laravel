
<x-app-layout>
    <x-slot name="header">
    <div class="flex">
       
        <div class ="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:items-right">
            <h2 class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex font-semibold text-xl text-gray-800 leading-tight sm:ms-8">
                {{ __('Department List') }}
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
                    <table class="table align-middle text-center bg-white">
                        <thead class="bg-light">
                            <tr>
                                <th>SL NO</th>
                                <th>Deparment ID</th>
                                <th>Department Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $key => $item)
                            <tr>
                                <td>{{ $item->id}}</td>
                                <td>{{ $item->department_id }}</td>
                                <td>{{ $item->department_name }}</td>
                                <td>
                                    <a class="btn btn-success text-white rounded-pill fw-bold"
                                        href="{{ route('Organization.edit', $item->id) }}">Edit</a>
                                    <a class="btn btn-danger text-white rounded-pill fw-bold" href="#" data-bs-toggle="modal"
                                        data-bs-target="#deleteEmployeeModal"
                                        onclick="prepareDeleteForm('{{ route('Organization.delete', $item->id) }}')">
                                        Delete</a>
                                    {{-- <a class="btn btn-danger text-white"
                                        href="{{ route('Organization.delete', $item->id) }}">Delete</a> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="modal" id="deleteEmployeeModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this Department?</p>
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
