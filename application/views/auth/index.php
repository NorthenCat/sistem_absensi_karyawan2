<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center mt-5 pt-5">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-logo">         
          <h1 class="h1 text-center-1200 mb-4 mx-3">SMK SORE TULUNGAGUNG</h1>
      </a>


      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-3">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Sistem Absensi Karyawan</h1>
                  <hr>
                </div>
                <?= $this->session->flashdata('message'); ?>
                <form class="user" method="post" action="<?= base_url(); ?>">
                  <div class="form-group mt-4">
                    <input type="text" class="form-control form-control-user" name="username" placeholder="Username ( ID Karyawan )">
                    <?= form_error('username', '<small class="text-danger pl-3">', '</small>') ?>
                  </div>
                  <div class="form-group mt-4 mb-4">
                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                  </div>
                  <button class="btn btn-primary bg-gradient-primary btn-user btn-block mt-4" type="submit">
                    Login
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>