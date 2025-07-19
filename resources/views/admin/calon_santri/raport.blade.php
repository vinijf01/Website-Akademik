<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Calon Santri</title>
</head>

<body style="page size:8in 7.5in">
    <div style="width: auto; height: auto; position:absolute; padding-left: 30px; padding-right: 30px;">
        <table style="width: 100%; text-align: center;">
            <tr>
                <td>
                    <font style=" font-size:4mm"> Yayasan Roudhotul Quran Al-Islamiyah </font><br>
                    <font style="font-size:5mm"> Pondok Pesantren Abdurrahman Bin Auf </font><br>
                    <font style="font-size:3mm">
                        Jl. Lkr. Durian Sebatang, Suka Damai, Kec. Ujung Batu, Kabupaten Rokan Hulu, Riau 28557
                    </font>
                </td>
            </tr>
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
        </table>

        <table style="width: 100%; text-align: center;" width='470'>
            <tr>
                <td>
                    <font style="margin: 0; font-size:4mm">Laporan Calon Santri Tahun Ajaran:
                        {{ $calon_santri->first()->TA }}</font><br>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td>
                    <center>
                        <table border="1">
                            <tr>
                                <th style="text-align: center;">No</th>
                                <th style="text-align: center;">Nama Santri</th>
                                <th style="text-align: center;">No Whatsapp</th>
                                <th style="text-align: center;">Program Akademik Pilihan</th>
                                <th style="text-align: center;">Status</th>
                            </tr>
                            @php
                                $totalSantri = 0;
                                $totalDiterima = 0;
                                $totalDitolak = 0;
                            @endphp
                            @foreach ($calon_santri as $index => $item)
                                <tr>
                                    <td style="text-align: center;">{{ $index + 1 }}</td>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td style="text-align: center;">{{ $item->no_wa }}</td>
                                    <td>{{ $item->program->nama_program }}</td>
                                    <td style="text-align: center;">{{ $item->status }}</td>
                                </tr>
                                @php
                                    $totalSantri += 1;
                                    if ($item->status == 'Diterima') {
                                        $totalDiterima += 1;
                                    } elseif ($item->status == 'Ditolak') {
                                        $totalDitolak += 1;
                                    }
                                @endphp
                            @endforeach

                            <tr>
                                <td colspan="4" style="text-align: center;">Total Santri</td>
                                <td style="text-align: center;">{{ $totalSantri }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: center;">Total Santri Yang Diterima</td>
                                <td style="text-align: center;">{{ $totalDiterima }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: center;">Total Santri Yang Ditolak</td>
                                <td style="text-align: center;">{{ $totalDitolak }}</td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
        </table>

        <br>
        <div style="width: 17%; text-align: right; float: left;">
            Ujung Batu, <?php echo date('d F Y'); ?> <br>
            Yang Bertanda Tangan,
        </div>
        <br><br><br><br><br>
        <div style="width: 16%; text-align:right; float:left;">Kepala Pondok Pesantren</div>
    </div>
</body>

</html>
