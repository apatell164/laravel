<div class="card-body">
    <form action="{{ route('Organization.update', $department->id) }}" method="post">
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