
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
                    <table >
                        <thead >
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
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->department_id }}</td>
                                <td>{{ $item->department_name }}</td>
                                <td>
                                    <a 
                                        href="{{ route('Organization.edit', $item->id) }}">Edit</a>
                                    <a 
                                        href="{{ route('Organization.delete', $item->id) }}">Delete</a>
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

