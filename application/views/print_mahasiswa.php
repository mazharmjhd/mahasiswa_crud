<html>

<head>
    <title></title>
</head>

<body>

    <table>
        <tr>
            <th>NO</th>
            <th>NIM</th>
            <th>NAMA</th>
            <th>ALAMAT</th>
            <th>TANGGAL LAHIR</th>
            <th>JURUSAN</th>
            <th>EMAIL</th>
            <th>NO TELP</th>
        </tr>

        <?php
        $no = 1;
        foreach ($mahasiswa as $mhs) : ?>

            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $mhs->nim ?></td>
                <td><?php echo $mhs->nama ?></td>
                <td><?php echo $mhs->alamat ?></td>
                <td><?php echo $mhs->tgl_lahir ?></td>
                <td><?php echo $mhs->jurusan ?></td>
                <td><?php echo $mhs->email ?></td>
                <td><?php echo $mhs->no_tlp ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>