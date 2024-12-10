<x-app-layout>
    <x-slot name="header">
     <div class="flex">
        <div class ="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 sm:items-right">
            <h2 class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex font-semibold text-xl text-gray-800 leading-tight sm:ms-8">
                {{ __('Designation List') }}
            </h2>
        </div>
        <div class ="hidden sm:flex sm:items-center sm:ms-6">
             <x-nav-link :href="route('organization.designation')" >
                {{ __('Add Designation') }}
            </x-nav-link>
        </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="table align-middle mb-4 text-center bg-white">
                        <thead class="bg-light">
                            <tr>
                                <th>SL NO</th>
                                <th>Designation ID</th>
                                <th>Designation Name</th>
                                <th>Department Name</th>
                                <th>Salary Class</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($designations as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->designation_id }}</td>
                                <td>{{ $item->designation_name }}</td>
                                <td>{{ optional($item->department)->department_name }}</td>
                                {{-- <td>{{ $item->salary->salary_class }}</td> --}}
                                <td>{{ optional($item->salary)->salary_class }}</td>
                                <td>
                                    <a class="btn btn-success rounded-pill fw-bold text-white"
                                        href="{{ route('designation.edit', $item->id) }}">Edit</a>
                                    <a class="btn btn-danger rounded-pill fw-bold text-white"
                                        href="{{ route('designation.delete', $item->id) }}">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>