<div class="form-group">
    <label for="email">Email Pengirim</label>
    <select class="form-control" name="email">
        <option>Pilih Email</option>
        @foreach(explode(',', env('MAIL_USERNAME')) as $email)
            <option value="{{ $loop->index }}">{{ empty($email) ? 'Tanpa Nama' : $email }}</option>
        @endforeach
    </select>
</div>