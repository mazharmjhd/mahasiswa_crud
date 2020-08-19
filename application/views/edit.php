<div class="content-wrapper">
    <section class="content">
        <?php foreach ($mahasiswa as $mhs) { ?>

            <?php echo form_open_multipart('mahasiswa/update'); ?>

                <div class="form-group">
                    <label>Nama Mahasiswa</label>
                    <input type="hidden" name="id" class="form-control" value="<?php echo $mhs->id ?> ">
                    <input type="text" name="nama" class="form-control" value="<?php echo $mhs->nama ?> ">
                </div>
                <div class="form-group">
                    <label>NIM</label>
                    <input type="text" name="nim" class="form-control" value="<?php echo $mhs->nim ?> ">
                </div>
                <div class="form-group">
                    <label>ALAMAT</label>
                    <input type="text" name="alamat" class="form-control" value="<?php echo $mhs->alamat ?> ">
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="text" name="tgl_lahir" class="form-control" value="<?php echo $mhs->tgl_lahir ?> ">
                </div>
                <div class="form-group">
                    <label>Jurusan</label>
                    <select type="text" name="jurusan" class="form-control" value="<?php echo $mhs->jurusan ?>">
                        <option value="">Pilih Jurusan</option>
                        <option value="Fakultas Teknologi Informasi">Fakultas Teknologi Informasi</option>
                        <option value="Fakultas Sistem Informasi">Fakultas Sistem Informasi</option>
                        <option value="Fakultas Hukum">Fakultas Hukum</option>
                        <option value="Fakultas Sistem Komputer">Fakultas Sistem Komputer</option>
                        <option value="Fakultas Public Relation">Fakultas Public Relation</option>
                        <option value="Fakultas Ilmu Komunikasi">Fakultas Ilmu Komunikasi</option>
                        <option value="Fakultas Kedokteran">Fakultas Kedokteran</option>
                        <option value="Fakultas Pertanian">Fakultas Pertanian</option>
                        <option value="Fakultas Sastra Inggris">Fakultas Sastra Inggris</option>
                        <option value="Fakultas Sastra Indonesia">Fakultas Sastra Indonesia</option>
                        <option value="Fakultas Elektro">Fakultas Elektro</option>
                        <option value="Fakultas Akutansi">Fakultas Akutansi</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $mhs->email ?> ">
                </div>
                <div class=" form-group">
                    <label>No Telp</label>
                    <input type="text" name="no_tlp" class="form-control" value="<?php echo $mhs->no_tlp ?> ">
                </div>
                <div class=" form-group">
                    <label>Upload Foto</label>
                    <input type="file" name="foto" class="form-control">
                </div>

                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="<?php echo base_url('mahasiswa/index'); ?>" class="btn btn-primary">Kembali</a>
                <?php echo form_close(); ?>
        <?php } ?>
    </section>
</div>