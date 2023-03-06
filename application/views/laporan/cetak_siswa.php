<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Siswa</title>
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

<body>

    <p class="title">Laporan Siswa</p>
    <h2>SMK Negeri 8 Jember</h2>
    <h5>Jl. Pelita no 27 Sidomekar - Semboro - Jember
        Jawa Timur, Indonesia</h5>
    <hr>

    <table>
        <tr>
            <td width="80"></td>
            <td width="240">
            <td>
            <td width="80"></td>
            <td><?= 'Jember,'. mediumdate_indo(date('Y-m-d')); ?></td>

        </tr>
    </table>
    <br><br>
    <table id="table">
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Nama Kelas</th>
            <th>Alamat</th>
            <th>Nomer telpon</th>
            <th>Tahun Ajaran</th>
        </tr>
        <?php $i=1; foreach ($siswa as $sw) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $sw->nisn; ?></td>
            <td><?= $sw->nis; ?></td>
            <td><?= $sw->nama; ?></td>
            <td><?= $sw->nama_kelas; ?></td>
            <td><?= $sw->alamat; ?></td>
            <td><?= $sw->no_telp; ?></td>
            <td><?= $sw->tahun; ?></td>

        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>

</body>



</html>