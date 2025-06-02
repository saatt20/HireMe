@component('mail::message')
<table width="100%" cellpadding="0" cellspacing="0" style="text-align: center;">
    <tr>
        <td>
            <img src="{{ asset('images/logo-hireme-new.png') }}" alt="HireMe Logo" height="60">
        </td>
    </tr>
</table>

# Reset Password Anda

Kami menerima permintaan untuk mereset password akun Anda.

@component('mail::button', ['url' => $url, 'color' => 'red'])
Reset Password
@endcomponent

Link ini hanya berlaku selama **60 menit**.

Jika Anda tidak merasa melakukan permintaan ini, abaikan saja email ini — akun Anda tetap aman.

Terima kasih telah menggunakan HireMe!

Salam hangat,
**Tim HireMe**

@slot('subcopy')
Jika tombol di atas tidak bisa diklik, salin dan tempel URL berikut di browser Anda:

[{{ $url }}]({{ $url }})
@endslot
@endcomponent
