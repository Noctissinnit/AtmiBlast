<div class="form-group">
    <label for="email">Email Pengirim</label>
    @foreach(explode(',', env('MAIL_USERNAME')) as $email)
        <div>
            <input type="checkbox" name="email[]" value="{{ $loop->index }}">
            <span class="ms-1">{{ empty($email) ? 'Tanpa Nama' : $email }}</span>
        </div>
    @endforeach
</div>