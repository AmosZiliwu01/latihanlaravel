<table cellpadding="0" cellspacing="0" border="0" align="center" width="100%" style="background-color:#f9f9f9; border:1px solid #ddd; padding:10px;">
    <tr>
        <td align="center">
            <p style="font-size:16px; font-weight:bold; color:#333;">Halo, {{$user->name}}</p>
            <p style="font-size:14px; color:#666;">
                Terima kasih telah mendaftar menjadi bagian dari kami. Kami sangat senang Anda bergabung dengan kami.
            </p>
            <p style="font-size:14px; color:#666;">
                Untuk mengaktifkan akun Anda, silahkan klik link berikut:
                <br/>
                <a href="{{url("/register/activation/$user->token_activation")}}" style="color:#337ab7; text-decoration:underline;">Klik disini</a>
            </p>
        </td>
    </tr>
</table>
