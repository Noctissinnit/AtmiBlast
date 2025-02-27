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
    });
</script>
@endsection

@section('content')
<div class="container mt-5">
    <h1>Employees</h1>
    <div class="row mb-3">
        <div class="col-md-2">
            <a href="{{ route('employees.create') }}" class="btn btn-primary w-100">Add Employee</a>
        </div>

        <div class="col-md-2">
            <!-- Tombol untuk membuka dialog file -->
            <button type="button" class="btn btn-primary w-100" id="btn-upload">Pilih File Excel</button>

            <!-- Input file yang disembunyikan -->
            <form id="form-excel" class="hidden" action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="excel" id="input-excel" class="form-control @error('excel') is-invalid @enderror" style="display: none;">
            </form>

            @error('excel')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
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
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No employees found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection