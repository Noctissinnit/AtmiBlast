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

        <!-- Pilih Divisi -->
        <div class="form-group">
            <label for="division_id">Divisi</label>
            <select name="division_id" id="division_id" class="form-control" required>
                <option value="">Pilih Divisi</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->id }}" 
                        @if(old('division_id') == $division->id) selected @endif>
                        {{ $division->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Unit Karya -->
        <div class="form-group">
            <label for="unit_karya_id">Unit Karya</label>
            <select name="unit_karya_id" id="unit_karya_id" class="form-control" required>
                <option value="">Pilih Unit Karya</option>
                @foreach($units as $unit)
                    <option value="{{ $unit->id }}" 
                        @if(old('unit_karya_id') == $unit->id) selected @endif>
                        {{ $unit->nama_unit_karya }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        // Ketika divisi dipilih
        $('#division_id').change(function() {
            var divisionId = $(this).val();  // Ambil ID divisi yang dipilih
            if (divisionId) {
                // Mengirim AJAX request untuk mengambil unit karya berdasarkan divisi
                $.ajax({
                    url: '/get-units/' + divisionId, // Ganti URL sesuai route yang akan dipanggil
                    type: 'GET',
                    success: function(response) {
                        // Kosongkan dropdown unit karya
                        $('#unit_karya_id').empty();
                        $('#unit_karya_id').append('<option value="">Pilih Unit Karya</option>');
                        
                        // Tambahkan unit karya yang sesuai dengan divisi yang dipilih
                        $.each(response.units, function(index, unit) {
                            $('#unit_karya_id').append('<option value="' + unit.id + '">' + unit.nama_unit_karya + '</option>');
                        });
                    }
                });
            } else {
                // Jika tidak ada divisi yang dipilih, kosongkan dropdown unit karya
                $('#unit_karya_id').empty();
                $('#unit_karya_id').append('<option value="">Pilih Unit Karya</option>');
            }
        });
    });
</script>

{{--  --}}
@endsection
