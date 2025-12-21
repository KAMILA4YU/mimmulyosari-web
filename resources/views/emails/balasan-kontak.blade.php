<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Email Balasan</title>
</head>
<body style="margin:0; padding:0; background-color:#f2f4f6; font-family:Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:20px 0;">
    <tr>
        <td align="center">

            <!-- CONTAINER -->
            <table width="100%" cellpadding="0" cellspacing="0"
                   style="max-width:600px; background:#ffffff; border-radius:8px; overflow:hidden;">

                <!-- HEADER -->
                <tr>
                    <td style="background:#0d6efd; padding:24px; text-align:center;">
                        <img src="{{ config('app.url') }}/logo.png"
                            alt="MI Muhammadiyah Mulyosari"
                            style="height:60px; display:block; margin:0 auto;">
                        <h2 style="margin:0; color:#ffffff; font-size:20px; letter-spacing:0.5px;">
                            MI Muhammadiyah Mulyosari
                        </h2>
                    </td>
                </tr>

                <!-- BODY -->
                <tr>
                    <td style="padding:28px; color:#333333; font-size:14px; line-height:1.7;">

                        <p style="margin-top:0;">Yth. <strong>{{ $nama }}</strong>,</p>

                        <p>
                            Terima kasih telah menghubungi kami. Menanggapi pesan Anda dengan perihal
                            <strong>{{ $subjek }}</strong>, berikut kami sampaikan:
                        </p>

                        <div style="
                            margin:18px 0;
                            padding:16px 18px;
                            background:#f8f9fa;
                            border-left:4px solid #0d6efd;
                            border-radius:4px;
                        ">
                            {{ $balasan }}
                        </div>

                        <p>
                            Apabila masih terdapat pertanyaan atau membutuhkan informasi lebih lanjut,
                            silakan menghubungi kami kembali.
                        </p>

                        <p>
                            Terima kasih atas perhatian Anda.
                        </p>

                        <br>

                        <p style="margin-bottom:0;">
                            Hormat kami,<br>
                            <strong>Admin MI Muhammadiyah Mulyosari</strong>
                        </p>

                    </td>
                </tr>

                <!-- FOOTER CONTACT -->
                <tr>
                    <td style="
                        background:#f1f3f5;
                        padding:16px;
                        text-align:center;
                        font-size:12px;
                        color:#555;
                        line-height:1.6;
                    ">
                        MI Muhammadiyah Mulyosari<br>
                        <a href="https://mimmulyosari.sch.id"
                        style="color:#0d6efd; text-decoration:none;">
                            mimmulyosari.sch.id
                        </a>
                        &nbsp;|&nbsp; Telp: {{ $telepon ?? '-' }}
                    </td>
                </tr>

                <!-- FOOTER LEGAL -->
                <tr>
                    <td style="
                        background:#fafafa;
                        padding:18px;
                        font-size:12px;
                        color:#666;
                        text-align:center;
                        line-height:1.6;
                    ">
                        <p style="margin:0 0 8px 0;">
                            <strong>Butuh bantuan atau informasi lebih lanjut?</strong><br>
                            Hubungi kami melalui email di atas.
                        </p>

                        <p style="margin:8px 0;">
                            <a href="{{ url('/syarat-ketentuan') }}"
                               style="color:#666; text-decoration:underline;">
                                Syarat dan Ketentuan
                            </a>
                            &nbsp;|&nbsp;
                            <a href="{{ url('/kebijakan-privasi') }}"
                               style="color:#666; text-decoration:underline;">
                                Kebijakan Privasi
                            </a>
                        </p>

                        <p style="margin:8px 0 0 0; font-size:11px; color:#888;">
                            © {{ date('Y') }} MI Muhammadiyah Mulyosari.<br>
                            Seluruh hak cipta dilindungi.
                        </p>
                    </td>
                </tr>

            </table>
            <!-- END CONTAINER -->

        </td>
    </tr>
</table>

</body>
</html>
