<!-- DataTales -->
<div class="card shadow my-4 mx-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Kelas </h6>
  </div>
  <div class="card-body">

    <form role="form" method="post" name="postform" enctype="multipart/form-data">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr align="center">
              <th>Kelas</th>
              <th>Mata Pelajaran</th>
              <th>Aksi</th>

            </tr>
          </thead>
          <tbody align="center">
            <?php foreach ($mengajar as $jd) { ?>
              <tr>
                <td>
                  <?= $jd['kelas']; ?> -
                  <?= $jd['nama_kelas']; ?>
                </td>
                <td>
                  <?= $jd['mapel']; ?>
                </td>
                <td>
                  <a href="<?= base_url('Attendance/form') . '?id_mkelas=' . $jd['id_mkelas']; ?>">
                    <span class="icon text-white-600">
                      <i class="fas fa-plus-circle"></i>
                    </span>
                    <span class="text">Tambah Absen</span>
                  </a> |
                  <a
                    href="<?= base_url('Attendance/absence_history') . '?id_mkelas=' . $jd['id_mkelas'] . '&id_mapel=' . $jd['id_mapel']; ?> ">
                    <span class="icon text-white-600">
                      <i class="fas fa-book"></i>
                    </span>
                    <span class="text">Rekap Absen</span>
                  </a>
                </td>
              </tr>

            <?php } ?>
          </tbody>
        </table>
      </div>
      <!--  <button type="submit" class="btn btn-primary mt-4 col-md-2 offset-10">Simpan Data</button>  -->
  </div>
  </form>

</div>

</div>

<!-- /.container-fluid -->