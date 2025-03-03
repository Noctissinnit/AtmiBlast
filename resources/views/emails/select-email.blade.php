<div class="form-group mb-3">
    <label for="email">Email Pengirim</label>
    <select class="form-control" name="mail_id">
        <option>Pilih Email</option>
        @foreach($mails as $mail)
            <option value="{{ $mail->id }}">{{ $mail->email }}</option>
        @endforeach
    </select>
</div>