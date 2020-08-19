<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Mahasiswa
      <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url('mahasiswa/index'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Data Mahasiswa</li>
    </ol>
  </section>

  <section class="content">
    <!-- notif flashdata run message->mahasiswa -->
    <?php echo $this->session->flashdata('message'); ?>
    <!--btnn toogle modal/ Tambah Mahasiswa -->
    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data Mahasiswa</button>
    <!-- btn Print -->
    <a class="btn btn-danger" href="<?php echo base_url('mahasiswa/print') ?>"><i class="fa fa-print"></i> Print</a>
    <!-- btn Export -->
    <!-- <a class="btn btn-warning" href="#"><i class="fa fa-file"></i> Export PDF</a> -->

    <div class="dropdown inline">
      <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <i class="fa fa-download"></i> Export
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <li><a href="<?php echo base_url('mahasiswa/export_pdf') ?>">PDF</a></li>
        <li><a href="<?php echo base_url('mahasiswa/excel') ?>">EXCEL</a></li>
      </ul>
    </div>

    <div class="navbar-form navbar-right">
      <?php echo form_open('mahasiswa/search') ?>
      <input type="text" name="keyword" class="form-control" placeholder="Seacrh">
      <button type="submit" class="btn btn-success">Cari</button>
      <?php echo form_close() ?>
    </div>

    <table class="table">
      <tr>
        <th>NO</th>
        <th>NAMA MAHASISWA</th>
        <th>NIM</th>
        <th>ALAMAT</th>
        <th>TANGGAL LAHIR</th>
        <th>JURUSAN</th>
        <th colspan="2">ACTION</th>
      </tr>

      <?php

      $no = 1;
      foreach ($data->result() as $row) : ?>
        <tr>
          <td><?php echo $no++ ?></td>
          <td><?php echo $row->nama ?></td>
          <td><?php echo $row->nim ?></td>
          <td><?php echo $row->alamat ?></td>
          <td><?php echo $row->tgl_lahir ?></td>
          <td><?php echo $row->jurusan ?></td>
          <td><?php echo anchor('mahasiswa/detail/' . $row->id, '<div class="btn btn-success btn-sm"><i class="fa fa-search-plus"></i></div>') ?></td>
          <td onclick="javascript: return confirm('Anda yakin ingin menghapus?')">
            <?php echo anchor('mahasiswa/hapus/' . $row->id, '<div class="btn btn-danger"><i class="fa fa-trash"></i></div>') ?></td>
          <td><?php echo anchor('mahasiswa/edit/' . $row->id, '<div class="btn btn-primary"><i class="fa fa-edit"></i></div>') ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
    <div class="row">
      <div class="col">
        <!--Tampilkan pagination-->
        <?php echo $pagination; ?>
      </div>
    </div>
  </section>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">FORM INPUT DATA MAHASISWA</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

          <!-- open_multipart untuk upload foto -->
          <?php echo form_open_multipart('mahasiswa/tambah_aksi'); ?>

          <div class="form-group">
            <label>Nama Mahasiswa</label>
            <input type="text" name="nama" class="form-control">
          </div>
          <div class="form-group">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control">
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control">
          </div>
          <div class="form-group">
            <label>Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" class="form-control">
          </div>
          <div class="form-group">
            <label>Jurusan</label>
            <select type="text" name="jurusan" class="form-control">
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
            <input type="text" name="email" class="form-control">
          </div>
          <div class="form-group">
            <label>No Telp</label>
            <input type="text" name="no_tlp" class="form-control">
          </div>
          <div class="form-group">
            <label>Upload Foto</label>
            <input type="file" name="foto" class="form-control">
          </div>

          <button type="reset" class="btn btn-danger" data-dismiss="modal">Reset</button>
          <button type="submit" class="btn btn-primary">Simpan</button>

          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</div>