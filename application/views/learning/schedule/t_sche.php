<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">
    <?= $title; ?>
  </h1>

  <a href="<?= base_url('learning/schedule') ?>"
    class="btn btn-danger bg-gradient-danger border btn-icon-split mb-4 rounded-0">
    <span class="icon text-white">
      <i class="fas fa-chevron-left"></i>
    </span>
    <span class="text">Kembali</span>
  </a>
  <div class="row justify-content-center">
    <form action="<?= base_url('learning/addSche') ?>" method="POST" class="col-lg-5 col-md-6 col-sm-12  p-0">
      <div class="card rounded-1 my-4">
        <h5 class="card-header">Data Jadwal</h5>
        <div class="card-body">
          <h5 class="card-title">Tambah Jadwal Pelajaran Baru</h5>
          <p class="card-text">Formulir untuk menambahkan data pelajaran baru ke sistem</p>
          <form>
            <?= $this->session->flashdata('message') ?>
            <label for="guru" class="col-form-label-lg">Guru Mata Pelajaran</label>
            <select name="guru" id="guru_list" class="guru form-control" required>
              <option value="">- Pilih -</option>
            </select>
            <label for="mapel" class="col-form-label-lg"> Mata Pelajaran</label>
            <select name="mapel" class="form-control" required>
              <option value="">- Pilih -</option>
              <?php foreach ($mapel as $m): ?>
                <option value="<?= $m['id_mapel'] ?>"><?= $m['mapel'] ?></option>
              <?php endforeach; ?>
            </select>
            <label for="kelas" class="col-form-label-lg">Kelas</label>
            <select name="kelas" class="form-control" required>
              <option value="">- Pilih -</option>
              <?php foreach ($kelas as $k): ?>
                <option value="<?= $k['id_mkelas'] ?>"><?= $k['kelas'] ?> - <?= $k['nama_kelas'] ?></option>
              <?php endforeach; ?>
            </select>
            <label for="semester" class="col-form-label-lg">Semester</label>
            <select name="semester" class="form-control" required>
              <option value="">- Pilih -</option>
              <?php foreach ($semester as $s): ?>
                <option value="<?= $s['id_semester'] ?>"><?= $s['semester'] ?></option>
              <?php endforeach; ?>
            </select>
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                  <div class="form-check">
                    <label for="hari" class="col-form-label-lg">Hari</label><br />
                    <label class="form-radio-label">
                      <input class="form-radio-input" type="radio" name="hari" value="Senin">
                      <span class="form-radio-sign">Senin</span>
                    </label>
                    <label class="form-radio-label">
                      <input class="form-radio-input" type="radio" name="hari" value="Selasa">
                      <span class="form-radio-sign">Selasa</span>
                    </label>
                    <label class="form-radio-label">
                      <input class="form-radio-input" type="radio" name="hari" value="Rabu">
                      <span class="form-radio-sign">Rabu</span>
                    </label>
                    <label class="form-radio-label">
                      <input class="form-radio-input" type="radio" name="hari" value="Kamis">
                      <span class="form-radio-sign">Kamis</span>
                    </label>
                    <label class="form-radio-label">
                      <input class="form-radio-input" type="radio" name="hari" value="Jum'at">
                      <span class="form-radio-sign">Jum'at</span>
                    </label>
                    <label class="form-radio-label">
                      <input class="form-radio-input" type="radio" name="hari" value="Sabtu">
                      <span class="form-radio-sign">Sabtu</span>
                    </label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="form-group">
                  <label for="waktu" class="col-form-label-lg">Waktu</label>
                  <div class="inline-selects d-flex">
                    <div class="form-group inline-select mr-4">
                      <label for="waktu" class="mr-2">Jam Mulai</label>
                      <select name="jam_mulai" class="form-control">
                        <?php for ($i = 7; $i <= 15; $i++): ?>
                          <?php $time = sprintf("%02d:00", $i); ?>
                          <option value="<?= $time ?>"><?= $time ?></option>
                        <?php endfor; ?>
                      </select>
                    </div>
                    <div class="form-group inline-select">
                      <label for="waktu" class="mr-2">Jam Akhir</label>
                      <select name="jam_akhir" class="form-control">
                        <?php for ($i = 7; $i <= 15; $i++): ?>
                          <?php $time = sprintf("%02d:00", $i); ?>
                          <option value="<?= $time ?>"><?= $time ?></option>
                        <?php endfor; ?>
                      </select>
                    </div>
                  </div>
                </div>

              </div>

            </div>

            <button type="submit"
              class="btn btn-sm btn-primary bg-gradient-primary btn-icon-split mt-4 float-right rounded-0">
              <span class="icon text-white">
                <i class="fas fa-plus-circle"></i>
              </span>
              <span class="text">Simpan</span>
            </button>
          </form>
        </div>
      </div>
    </form>
  </div>
</div>
<!-- /.container-fluid -->

</div>

<!-- Search Script -->
<script>
  $('#guru_list').select2({
    ajax: {
      url: "<?= base_url('learning/search_guru') ?>",
      type: "post",
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          searchTerm: params.term // search term
        };
      },
      processResults: function (response) {
        return {
          results: response
        };
      },
      cache: true
    }
  });
</script>
<!-- End of Main Content -->