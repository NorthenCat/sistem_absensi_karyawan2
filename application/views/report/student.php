<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-flex w-100 align-items-center">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <h1 class="h3 mb-0 text-gray-800">
        <?= $title; ?>
      </h1>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
      <a href="<?= base_url('admin') ?>"
        class="btn btn-md btn-light btn-sm bg-gradient-light border rounded-0 mb-2 btn-icon-split">
        <span class="icon text-white-600">
          <i class="fas fa-angle-left"></i>
        </span>
        <span class="text">Tambahkan Kembali</span>
      </a>
    </div>
  </div>
  <hr>
  <div class="card rounded-0 shadow mb-3">
    <div class="card-body">
      <fieldset class="border rounded-0 px-2 pb-2">
        <legend class="ml-3 pxto-3 w-au">Cari Laporan</legend>
        <form action="" method="GET">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
              <input type="date" name="start" class="form-control form-control-sm rounded-0"
                value="<?= !empty($this->input->get('start')) ? $this->input->get('start') : '' ?>">
              <?= form_error('start', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
              <input type="date" name="end" class="form-control form-control-sm rounded-0"
                value="<?= !empty($this->input->get('end')) ? $this->input->get('end') : '' ?>">
              <?= form_error('end', '<small class="text-danger pl-3">', '</small>') ?>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
              <select name="mapel" class="form-control form-control-sm rounded-0">
                <option value="">Select Mata Pelajaran</option>
                <?php foreach ($mapel as $subject): ?>
                  <option value="<?= $subject['id_mapel'] ?>" <?= ($this->input->get('mapel') == $subject['id_mapel']) ? 'selected' : '' ?>>
                    <?= $subject['mapel'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
              <select name="kelas" class="form-control form-control-sm rounded-0">
                <option value="">Select Kelas</option>
                <?php foreach ($kelas as $class): ?>
                  <option value="<?= $class['id_mkelas'] ?>" <?= ($this->input->get('kelas') == $class['id_mkelas']) ? 'selected' : '' ?>>
                    <?= $class['kelas'] ?> -
                    <?= $class['nama_kelas'] ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-2 my-2">
              <button type="submit" class="btn btn-primary btn-sm rounded-0 bg-gradient-primary "><i
                  class="fa fa-file"></i> Show Report</button>
            </div>
          </div>
        </form>
      </fieldset>
    </div>
  </div>
  <!-- End of row show -->
  <?php if ($data['attendance'] == false): ?>
    <h3 class="text-center my-5">Silakan Pilih Departemen dan Tanggal.</h3>
  <?php else: ?>
    <?php if ($data['attendance'] != null): ?>
      <div class="card shadow mb-4 rounded-0">
        <div class="card-header py-3">
          <div class="d-flex w-100 align-items-center">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <h6 class="m-0 font-weight-bold text-dark">Kehadiran Data</h6>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 text-right">
              <a href="<?= base_url('report/print_student/') . $data['start'] . '/' . $data['end'] . '/' . $data['mapel'] . '/' . $data['kelas'] ?>"
                target="blank" class="btn btn-sm btn-light bg-gradient-light border shadow-sm rounded-0"><i
                  class="fas fa-download fa-sm text-dark"></i> Print Report</a>
            </div>
          </div>
        </div>
        <form
          action="<?= base_url('report/edit_history_student?start=' . $data['start'] . '&end=' . $data['end'] . '&mapel=' . $data['mapel'] . '&kelas=' . $data['kelas']) ?>"
          method="POST" enctype="multipart/form-data">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-gradient-primary text-white">
                  <tr>
                    <th>No</th>
                    <th>Kelas</th>
                    <th>Mata Pelajaran</th>
                    <th>Nama Siswa</th>
                    <th>Tanggal</th>
                    <th>Jam Absen</th>
                    <th>Keterangan Absen</th>
                    <th>Status</th>
                    <th>Location</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // looping attendance list
                  $i = 1;
                  foreach ($data['attendance'] as $atd):
                    ?>
                    <tr>
                      <td>
                        <?= $i++; ?>
                      </td>
                      <td>
                        <?= $atd['kelas']; ?> -
                        <?= $atd['nama_kelas']; ?>
                      </td>
                      <td>
                        <?= ucwords($atd['mapel']); ?>
                      </td>
                      <td>
                        <?= ucwords($atd['nama_siswa']); ?>
                      </td>
                      <td>
                        <?= date('d-m-Y', strtotime($atd['tgl_absen'])); ?>
                      </td>
                      <td>
                        <?= date('H:i:s', strtotime($atd['jam_absen'])); ?>
                      </td>
                      <td>
                        <?= $atd['ket_absen']; ?>
                      </td>
                      <td>
                        <select name="attendance_status[<?= $atd['id_presensi'] ?>]" id="status"
                          class="form-control form-control-sm rounded-lg">
                          <option value="H" <?php if ($atd['ket'] == 'H')
                            echo 'selected'; ?>>Hadir
                          </option>
                          <option value="S" <?php if ($atd['ket'] == 'S')
                            echo 'selected'; ?>>Sakit
                          </option>
                          <option value="I" <?php if ($atd['ket'] == 'I')
                            echo 'selected'; ?>>Izin
                          </option>
                          <option value="A" <?php if ($atd['ket'] == 'A')
                            echo 'selected'; ?>>Alpha
                          </option>
                        </select>
                      </td>
                      <td class="text-center">
                        <!-- Display the location if available -->
                        <?php if (!empty($atd['latitude']) && !empty($atd['longitude']) && $atd['latitude'] != 0 && $atd['longitude'] != 0): ?>
                          <a href="https://www.google.com/maps?q=<?= $atd['latitude'] ?>,<?= $atd['longitude'] ?>"
                            target="_blank">View on Maps</a>
                        <?php else: ?>
                          Location Not Available
                        <?php endif; ?>
                      </td>
                    <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- simpan button -->
          <button type="submit" class="btn btn-primary mt-4 mb-2 col-md-2 offset-10">Simpan
            Data</button>
        </form>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->