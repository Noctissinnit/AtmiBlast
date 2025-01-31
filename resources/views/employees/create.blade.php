@extends('layouts.app')
@section('head')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
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
        <div class="form-group mb-3">
            <label for="unit_karya_id">Unit Karya</label>
            <select name="unit_id" class="form-control" id="unit_id" required>
                <option value="">Select Unit Karya</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>

<script>
    document.getElementById('division_id').addEventListener('change', function() {
        var division_id = this.value;
        if (division_id) {
            // Lakukan request ke server untuk mendapatkan unit karya berdasarkan divisi
            fetch(`/units/${division_id}`)
                .then(response => response.json())
                .then(data => {
                    // Kosongkan dan tambahkan opsi unit karya yang relevan
                    var unitKaryaSelect = document.getElementById('unit_karya_id');
                    unitKaryaSelect.innerHTML = '<option value="">Select Unit Karya</option>';
                    data.unit_karyas.forEach(function(unit) {
                        var option = document.createElement('option');
                        option.value = unit.id;
                        option.textContent = unit.nama_unit_karya;
                        unitKaryaSelect.appendChild(option);
                    });
                });
        } else {
            document.getElementById('unit_karya_id').innerHTML = '<option value="">Select Unit Karya</option>';
        }
    });

    $(document).ready(function() {
        $('#division_id').on('change', function() {
            var divisionId = $(this).val();
            $('#unit_id').html('<option value="">Loading...</option>');

            if (divisionId) {
                $.ajax({
                    url: '/get-units/' + divisionId,
                    type: 'GET',
                    success: function(data) {
                        $('#unit_id').html('<option value="">Select Unit Karya</option>');
                        $.each(data, function(key, unit) {
                            $('#unit_id').append('<option value="' + unit.id + '">' + unit.name + '</option>');
                        });
                    },
                    error: function() {
                        $('#unit_id').html('<option value="">Error loading data</option>');
                    }
                });
            } else {
                $('#unit_id').html('<option value="">Select Unit Karya</option>');
            }
        });
    });
    
</script>
@endsection
