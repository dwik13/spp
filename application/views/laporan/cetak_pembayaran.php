<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
    .title {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    }

    .title,
    .tanggal {
        text-align: center;
        font-family: sans-serif;
    }

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

    /* 
        #table tr:nth-child(even) {
            background-color: #f9f8f8;
        } */

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
    </style>
</head>

<body>

    <table width="500" border="0">
        <tr>
            <td class="title">
                Laporan Pembayaran
            </td>
        </tr>
    </table>
    <table width="500" border="0">
        <tr>
            <td class="tanggal">
                Dari tanggal <?= mediumdate_indo($this->session->userdata('tanggal_mulai')) ?> Sampai Tanggal
                <?= mediumdate_indo($this->session->userdata('tanggal_ahir')); ?>
            </td>
        </tr>
    </table>
    <br><br>
    <table id="table">
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>Nama</th>
            <th>Pembayaran SPP</th>
            <th>Tanggal Bayar</th>
            <th>Petugas</th>
            <th>Nominal</th>
        </tr>
        <?php $i=1; foreach ($laporan as $l) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $l->nisn; ?></td>
            <td><?= $l->nama; ?></td>
            <td><?='Biaya SPP Tahun '. $l->tahun_dibayar . ' Bulan ' . $l->bulan_dibayar ?></td>
            <td><?= mediumdate_indo($l->tgl_bayar); ?></td>
            <td><?= $l->nama_petugas; ?></td>
            <td><?= "Rp. " . number_format($l->jumlah_bayar, 0, '.', '.'); ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
        <tr>
            <td scope="row" colspan="6"
                style="text-align:center ; font-weight:bold; font-size: 13px;background-color: #f9f8f8;">Grand Total
            </td>
            <td style="font-weight:bold; font-size: 13px;background-color: #f9f8f8;">
                <?= "Rp. " . number_format($grandtotransaksicetak['jumlah_bayar'], 0, '.', '.'); ?></td>

            </td>
        </tr>
    </table>

</body>



</html>