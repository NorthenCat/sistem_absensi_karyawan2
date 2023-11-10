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
    </div>
  </div>
  <hr>
  <div class="card rounded-0 shadow mb-3">
    <div class="card-body">
      <fieldset class="border rounded-0 px-2 pb-2">
        <legend class="ml-3 px-3 w-auto">Saring Laporan
        </legend>
        <form action="" method="GET">
          <input type="hidden" name="id_mkelas" value="<?= $id_mkelas ?>">
          <input type="hidden" name="id_mapel" value="<?= $id_mapel ?>">
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

            <div class="col-2">
              <button type="submit" class="btn btn-primary btn-sm rounded-0 bg-gradient-primary ">
                <i class="fa fa-file"></i> Show Attendance
              </button>
            </div>
          </div>

        </form>
      </fieldset>
    </div>
  </div>

  <?php if ($data['logabsensi']): ?>
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
                <th>Lokasi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              // looping attendance list
              $i = 1;
              foreach ($data['logabsensi'] as $atd):
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
                    <?php if ($atd['ket'] == 'H'): ?>
                      <span class="badge badge-success">Hadir</span>
                    <?php elseif ($atd['ket'] == 'S'): ?>
                      <span class="badge badge-warning">Sakit</span>
                    <?php elseif ($atd['ket'] == 'I'): ?>
                      <span class="badge badge-danger">Izin</span>
                    <?php elseif ($atd['ket'] == 'A'): ?>
                      <span class="badge badge-dark">Alpha</span>
                    <?php endif; ?>
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
    </div>
  <?php else: ?>
    <h1 class="text-center">Silakan Pilih Tanggal Anda</h1>
  <?php endif; ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->