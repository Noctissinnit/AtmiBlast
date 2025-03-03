@extends('layouts.app')

@section('head')
<script>
    $(document).ready(() => {
        $('#btn-upload').click(() => {
            $('#input-excel').click();
        });
        $('#input-excel').change(() => {
            if($('#input-excel').get(0).files.length === 0) return;
            $('#form-excel').submit();
        });

        // Fitur Pencarian Tanpa Reload
        $("#search-input").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            var found = false;
            $("#employee-table tbody tr").filter(function () {
                var rowText = $(this).text().toLowerCase();
                var match = rowText.includes(value);
                $(this).toggle(match);
                if (match) found = true;
            });
            $("#no-results").toggle(!found);
        });
    });
</script>
@endsection

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg p-4">
        <h2 class="text-center mb-4">Employees List</h2>

        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- SEARCH FORM (Tanpa Query ke Server) -->
        <div class="mb-3">
            <input type="text" id="search-input" class="form-control" placeholder="Search employees...">
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <a href="{{ route('employees.create') }}" class="btn btn-primary w-100">
                    <i class="bi bi-person-plus"></i> Add Employee
                </a>
            </div>

            <div class="col-md-6">
                <button type="button" class="btn btn-success w-100" id="btn-upload">
                    <i class="bi bi-upload"></i> Upload Excel
                </button>

                <form id="form-excel" action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data" class="d-none">
                    @csrf
                    <input type="file" name="excel" id="input-excel" class="form-control @error('excel') is-invalid @enderror" style="display: none;">
                </form>

                @error('excel')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered text-center" id="employee-table">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Division</th>
                        <th>Unit Karya</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $employee->user->name ?? $employee->name ?? '' }}</td>
                        <td>{{ $employee->user->email ?? $employee->email ?? '' }}</td>
                        <td>{{ $employee->division->name }}</td>
                        <td>{{ $employee->unitKarya->nama_unit_karya ?? 'No Unit Karya' }}</td>
                        <td>
                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr id="no-results">
                        <td colspan="6" class="text-muted">No employees found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
