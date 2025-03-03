<div class="form-group">
    <label for="email">Email Pengirim</label>
    @foreach($mails as $mail)
        <div class="mb-3">
            <input type="checkbox" name="mail_ids[]" value="{{ $mail->id }}">
            <span class="ms-1">{{ $mail->email }}</span>
        </div>
    @endforeach
</div>