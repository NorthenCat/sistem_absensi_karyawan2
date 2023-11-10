<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">
    <?= $title; ?>
  </h1>

  <a href="<?= base_url('learning/subject'); ?>"
    class="btn btn-danger bg-gradient-danger border btn-icon-split mb-4 rounded-0">
    <span class="icon text-white">
      <i class="fas fa-chevron-left"></i>
    </span>
    <span class="text">Kembali</span>
  </a>
  <div class="row justify-content-center">
    <form action="<?= base_url('learning/addSubject') ?>" method="POST" class="col-lg-5 col-md-6 col-sm-12  p-0">
      <div class="card rounded-0">
        <h5 class="card-header">Data Mata Pelajaran</h5>
        <div class="card-body">
          <h5 class="card-title">Tambah Mata Pelajaran Baru</h5>
          <p class="card-text">Formulir untuk menambahkan mata pelajaran baru ke sistem</p>
          <form>
            <?= $this->session->flashdata('message') ?>
            <div class="form-group">
              <label for="d_id" class="col-form-label-lg">ID Mapel</label>
              <input type="text" class="form-control" readonly autofocus name="d_id" id="d_id"
                value="MP-<?= time(); ?>">
              <?= form_error('d_id', '<small class="text-danger">', '</small>') ?>
            </div>
            <div class="form-group">
              <label for="d_name" class="col-form-label-lg">Nama Mapel</label>
              <input type="text" class="form-control form-control-lg" name="d_name" id="d_name"
                value="<?= !empty($this->input->post('d_id')) ? $this->input->post('d_name') : '' ?>" required>
              <?= form_error('d_name', '<small class="text-danger">', '</small>') ?>
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
<!-- End of Main Content -->