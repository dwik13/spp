<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran SPP</title>

    <style>
    #table {
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;

    }

    #table td,
    #table th {
        border: 1px solid #ddd;
        padding: 8px;
        font-size: 13px;

    }

    #table tr:nth-child(even) {
        background-color: #f9f8f8;
    }

    #table tr:hover {
        background-color: #ddd;
    }

    #table th {
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: left;
        background-color: #538b82;
        color: white;
        font-size: 13px;
    }

    h2,
    h5 {
        text-align: center;
        letter-spacing: 1.5px;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    }

    h4 {
        text-align: center;
    }

    hr {
        border: 0;
        border-top: 2px solid black;
    }
    </style>
</head>

<body class="body">

    <h2> Pembayaran SPP Siswa</h2>
    <h2>SMK Negeri 8 Jember</h2>
    <h5>Jl. Pelita no 27 Sidomekar - Semboro - Jember
        Jawa Timur, Indonesia</h5>
    <hr>

    <h4>Bukti Pembayaran</h4>

    <table>
        <tr>
            <td width="80">Nama</td>
            <td width="240"><?= ' : '. $siswatransaksi['nama']; ?></td>
            <td width="80">Kelas</td>
            <td><?= ' : '. $siswatransaksi['nama_kelas']; ?></td>

        </tr>
        <tr>
            <td width="80">NISN </td>
            <td width="240"><?= ' : '. $siswatransaksi['nisn']; ?></td>

        </tr>


    </table>
    <br>
    <hr>

    <table id="table"><br><br>
        <tr>
            <th>No</th>
            <th>Nama Pembayaran</th>
            <th>Tanggal Bayar</th>
            <th>Nominal</th>
        </tr>
        <?php $no = 1;
        foreach ($transaksi as $tran) : ?>
        <input type="hidden" value="<?= $tran->id_pembayaran ?>">
        <tr>

            <td><?= $no++ ?></td>
            <td><?= 'Biaya SPP Tahun '. $tran->tahun .' Bulan ' . $tran->bulan_dibayar ?></td>
            <td><?=  mediumdate_indo($tran->tgl_bayar); ?></td>
            <td><?= "Rp. " . number_format($tran->jumlah_bayar, 0, '.', '.'); ?></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td scope="row" colspan="3"
                style="text-align:center ; font-weight:bold; font-size: 13px;background-color: #f9f8f8;">Grand Total
            </td>
            <td style="font-weight:bold; font-size: 13px;background-color: #f9f8f8;">
                <?= "Rp. " . number_format($grandtotaltransaksi['jumlah_bayar'], 0, '.', '.'); ?></td>
            </td>
        </tr>
    </table>
    <br><br>
    <hr>
    <table>
        <tr>
            <td width="80"></td>
            <td width="240"></td>

        </tr>
        <tr>
            <td width="60"></td>
            <td width="240"></td>
            <td width="80"><?= 'Jember,'. mediumdate_indo(date('Y-m-d')); ?></td>
        </tr>
        <tr>
            <td width="80"></td>
            <td width="240"></td>
            <td width="80"> Petugas</td>
            <td></td>
        </tr>
        <br><br><br>
        <tr>
            <td width="80"></td>
            <td width="240"></td>
            <td width="80"><?= $siswatransaksi['nama_petugas'] ?></td>
        </tr>
    </table>

</body>

</html>
