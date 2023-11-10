<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">
    <?= $title; ?>
  </h1>
  <div class="row">
    <div class="col-lg-3">
      <a href="<?= base_url('learning/students'); ?>"
        class="btn btn-primary bg-gradient-primary border btn-icon-split mb-4 rounded-0">
        <span class="icon text-danger">
          <i class="fas fa-chevron-left"></i>
        </span>
        <span class="text">Kembali</span>
      </a>
    </div>
    <div class="col-lg-5 offset-lg-4">
      <?= $this->session->flashdata('message'); ?>
    </div>
  </div>
  <div class="row justify-content-center">
    <div class="col-lg-10 p-0">
      <form method="POST" action="<?= base_url('learning/addStud') ?>" enctype="multipart/form-data">
        <div class="card rounded-0">
          <h5 class="card-header">Master Siswa</h5>
          <div class="card-body">
            <h5 class="card-title">Tambah Siswa Baru</h5>
            <p class="card-text">Formulir untuk menambahkan siswa baru ke sistem</p>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group row">
                  <label for="e_name" class="col-form-label col-lg-4">Nama Siswa</label>
                  <div class="col p-0">
                    <input type="text" placeholder="Nama Lengkap Siswa" class="form-control col-lg" name="e_name"
                      id="e_name" autofocus required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="d_id" class="col-form-label col-lg-4">NIS</label>
                  <div class="col p-0">
                    <input type="text" class="form-control"  autofocus name="d_id" id="d_id"
                      placeholder="NIS">
                  </div>

                </div>
                <div class="form-group row">
                  <label for="alamat" class="col-form-label col-lg-4">Alamat</label>
                  <div class="col p-0">
                    <input type="text" placeholder="Alamat Siswa" class="form-control col-lg" name="alamat" id="alamat"
                      required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="e_gender" class="col-form-label col-lg-4">Jenis Kelamin</label>
                  <div class="form-check form-check-inline my-0">
                    <input class="form-check-input" type="radio" name="e_gender" id="m" value="L" checked required>
                    <label class="form-check-label" for="m">
                      Laki - Laki
                    </label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="e_gender" id="f" value="P" required>
                    <label class="form-check-label" for="f">
                      Perempuan
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group row">
                  <label for="image" class="col-form-label col-lg-4">Foto Siswa</label>
                  <div class="col-lg-8 p-0">
                    <input type="file" name="image" id="image">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="tmpt" class="col-form-label col-lg-4">Tempat Lahir</label>
                  <div class="col p-0">
                    <input type="text" placeholder="Kota Kelahiran" class="form-control col-lg" name="tmpt" id="tmpt"
                      autofocus required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="e_birth_date" class="col-form-label col-lg-4">Tanggal Lahir</label>
                  <div class="col-lg p-0">
                    <input type="date" class="form-control col-lg" name="e_birth_date" id="e_birth_date"
                      min="1990-01-01" max="2005-01-01" required>
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
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
  // Add the following code if you want the name of the file appear on select
  $(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>