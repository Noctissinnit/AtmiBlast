@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Add Employee</h1>
   
    
    <form action="{{ route('employees.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="division_id">Division</label>
            <select name="division_id" class="form-control" required>
                <option value="">Select Division</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
