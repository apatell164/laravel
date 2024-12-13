<x-app-layout>

<div class="shadow p-4 d-flex justify-content-between align-items-center">
    <h4 class="text-uppercase">Leave Request</h4>

    <div>
      
        <a href="allLeaveReport" class="btn btn-danger text-capitalize border-0" data-mdb-ripple-color="dark"><i
            class="fa-regular fa-paste me-1"></i>Leave Report</a>
    </div>
    
</div>
<div class="my-5 py-5">

    <div class="d-flex justify-content-between align-items-center mb-5">
        
        
    </div>

    <table class="table align-middle text-center w-100 bg-white">
        <thead class="bg-light">
            <tr>
                <th>SL NO</th>
                <th>Employee Name</th>
                <th>Department</th>
                <th>Designation</th>
                <th>Leave Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Days</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaves as $key => $leave)
            <tr>
                <td>
                    <div>
                        <p class="fw-bold mb-1">{{ $key + 1 }}</p>
                    </div>
                </td>
                <td>{{ $leave->employee->name }}</td>
                <td>{{ $leave->employee->department->department_name }}</td>
                <td>{{ $leave->employee->designation->designation_name }}</td>
                <td>{{ $leave->type->leave_type_id }}</td>
                <td>{{ $leave->from_date }}</td>
                <td>{{ $leave->to_date }}</td>
                <td>{{ $leave->total_days }}</td> <!-- Display total_days -->
                <td>{{ $leave->description }}</td>
                <td>
                    @if ($leave->status == 'approved')
                    <span class=" fw-bold bg-green rounded-pill p-2">Approved</span>
                    @elseif ($leave->status == 'rejected')
                    <span class=" fw-bold bg-red rounded-pill p-2">Rejected</span>
                    @else

                    <a class="btn btn-success rounded-pill" href="#" data-bs-toggle="modal"
                        data-bs-target="#approveModal"
                        onclick="prepareApproveForm('{{ route('leave.approve', $leave->id) }}')">
                        Approve</a>

                    {{-- <a class="btn btn-success rounded-pill "
                        href="{{ route('leave.approve', ['id' => $leave->id]) }}">Approve</a> 
                    <a class="btn btn-danger rounded-pill "
                        href="{{ route('leave.reject', ['id' => $leave->id]) }}">Reject</a> --}}

                    <a class="btn btn-danger rounded-pill" href="#" data-bs-toggle="modal"
                    data-bs-target="#rejectModal"
                    onclick="prepareRejectForm('{{ route('leave.reject', $leave->id) }}')">
                    Reject</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-25 mx-auto mt-4">
        {{ $leaves->links() }}
    </div>

    <div class="modal" id="approveModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to approve this leave ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="approveForm" method="get">
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-danger">Approve</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="rejectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to reject this leave ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="rejectForm" method="get">
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function prepareApproveForm(approveUrl) {
        document.getElementById('approveForm').setAttribute('action', approveUrl);
    }

    function prepareRejectForm(rejectUrl) {
        document.getElementById('rejectForm').setAttribute('action', rejectUrl);
    }
</script>