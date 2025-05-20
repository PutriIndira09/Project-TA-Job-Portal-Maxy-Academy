@component('mail::message')
# Halo, {{ $user ? $user->name : 'Guest' }}

    Kami menerima permintaan untuk mereset password Anda. Anda dapat mereset password dengan mengklik tombol di bawah ini:

    @component('mail::button', ['url' => $resetUrl])
        Reset Password
    @endcomponent

    Jika Anda tidak meminta reset password, harap abaikan email ini.

    Terima kasih,  
    {{ config('app.name') }}
@endcomponent
