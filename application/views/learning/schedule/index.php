<div class="row">
  <div class="col-md-12">
    <div class="card mx-4">
      <div class="card-header">
        <div class="card-title">
          <a href="<?= base_url('learning/t_sche') ?>" class="btn btn-primary btn-sm text-white"><i
              class="fa fa-plus"></i> Tambah</a>
        </div>
      </div>

      <div class="card-body">
        <?= $this->session->flashdata('message') ?>
        <div class="table-responsive">
          <table id="basic-datatables" class="display table table-striped table-hover">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Guru</th>
                <th>Mata Pelajaran</th>
                <th>Kelas</th>
                <th>Hari</th>
                <th>Jam Pelajaran</th>
                <th>Semester</th>
                <th>Opsi </th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($mapel as $d) {
                ?>
                <tr>
                  <th scope="row"><b>
                      <?= $no++; ?>.
                    </b></th>
                  <td>
                    <?= ucwords($d['name']) ?>
                  </td>
                  <td>
                    <?= $d['mapel'] ?>
                  </td>
                  <td>
                    <?= $d['kelas'] ?> -
                    <?= $d['nama_kelas'] ?>
                  </td>
                  <td>
                    <?= $d['hari'] ?>
                  </td>
                  <td>
                    <?= date("h:00 A", strtotime($d['jam_mulai'])) ?> -
                    <?= date("h:00 A", strtotime($d['jam_akhir'])) ?>
                  <td>
                    <?= $d['semester'] ?>
                  </td>
                  <td>
                    <a onclick="return confirm('Yakin Hapus Data ?')"
                      href="<?= base_url('learning/delSche?id=' . $d['kode_pelajaran']) ?>"
                      class="btn btn-danger btn-sm"><i class="fa fa-times"></i> Batal</a>

                    <!-- <a  href="?page=nilai&mapel=<?= $d['id_pelajaran']; ?>" class="btn btn-success btn-sm"><i class="fas fa-file-contract"></i> Lihat Absen</a> -->
                  </td>
                </tr>
              <?php } ?>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>