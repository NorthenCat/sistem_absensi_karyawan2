<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
      <?= $title; ?>
    </h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <div class="col">
      <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
          <div class="card shadow mb-4" style="min-height: 543px">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-dark">Cek Kehadiran Anda!</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
              <?php if ($weekends == true): ?>
                <h1 class="text-center my-5">TERIMA KASIH ATAS KEHADIRANNYA</h1>
                <h5 class="card-title text-center mb-4 px-4">Selamat Beristirahat <b>AKHIR PEKAN</b></h5>
                <b>
                  <p class="text-center text-dark pt-3">Sampai jumpa di hari Senin!</p>
                </b>
                <div class="row">
                  <!--                          <button disabled class="btn btn-danger rounded-0 btn-sm text-xs mx-auto" style="font-size: 35px; width: 200px; height: 200px">
                           <i class="fas fa-fw fa-sign-out-alt fa-2x"></i>
                         </button> -->
                </div>
              <?php else: ?>
                <?php if ($in == false): ?>
                  <?= form_open_multipart('attendance') ?>
                  <div class="row mb-3">
                    <div class="col-lg-5">
                      <input type="hidden" name="work_shift" value="<?= $account['shift']; ?>">
                      <label for="work_shift" class="col-form-label">Pergeseran Kerja</label>
                      <input class="form-control" type="text"
                        placeholder="<?= date("h:i A", strtotime('2022-06-23 ' . $startTime)); ?> - <?= date("h:i A", strtotime('2022-06-25 ' . $endTime)); ?>"
                        value="<?= date("h:i A", strtotime('2022-06-23 ' . $startTime)); ?> - <?= date("h:i A", strtotime('2022-06-23 ' . $endTime)); ?>"
                        readonly>
                    </div>
                    <div class="col-lg-5 offset-lg-1">
                      <label for="location" class="col-form-label">Time In Location</label>
                      <select class="form-control" name="location" id="location">
                        <?php foreach ($location as $lct): ?>
                          <option value="<?= $lct['id'] ?>">
                            <?= $lct['id']; ?> =
                            <?= $lct['name'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-lg-5 text-center">
                      <div class="row col">
                        <label for="image" class="col-form-label float-left">Unggah Gambar Anda</label>
                      </div>
                      <img id="output" style="max-height: 252px;" class="img-thumbnail rounded mb-2"
                        src="<?= base_url('images/attendance/default.png') ?>">
                      <input type="file" class="d-block" id=image name="image" accept="image/*" onchange="loadFile(event)">
                      <script>
                        var loadFile = function (event) {
                          var output = document.getElementById('output');
                          output.src = URL.createObjectURL(event.target.files[0]);
                          output.onload = function () {
                            URL.revokeObjectURL(output.src) // free memory
                          }
                        };
                      </script>
                    </div>
                    <div class="col-lg-5 offset-lg-1 text-center">
                      <label for="notes" class="float-left">Notes</label>
                      <textarea maxlength="120" class="form-control mb-4" name="notes" id="notes" rows="3"
                        style="resize: none;"></textarea>
                      <hr>
                      <input type="hidden" id="userLocation" name="userLocation" value="">
                      <button type="submit" id="simpanAbsen"
                        class="btn btn-primary bg-gradient-primary px-5 btn-lg rounded-pill" disabled>
                        <i class="fas fa-fw fa-sign-in-alt"></i> Time In
                      </button>
                      <hr>
                    </div>
                  </div>
                  <?= form_close() ?>
                <?php else: ?>ABSENSI TELAH TEREKAM</h3>
                  <h6 class="card-title text-center mb-4 px-4">Semoga hari ini lebih baik dari hari sebelumnnya<br>Terima
                    kasih telah mencerdaksan anak bangsa</h6>
                  <?php if ($disable == false): ?>
                    <div class="row">
                      <a href="<?= base_url('attendance/checkout') ?>"
                        onclick="return confirm('Time Out now? Make sure you are done with you work!')"
                        class="btn btn-danger bg-gradient-danger rounded-pill px-5 btn-lg mx-auto">
                        <i class="fas fa-fw fa-sign-out-alt"></i> <b>Time Out</b>
                      </a>
                    <?php else: ?>
                      <b>
                        <p class="text-center text-dark pt-3">Sampai jumpa besok!</p>
                      </b>

                    <?php endif; ?>
                  <?php endif; ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End  -->
  </div>
  <!-- /.container-fluid -->

</div>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const simpanDataButton = document.getElementById("simpanAbsen");
    const userLocationInput = document.getElementById("userLocation");

    // Function to handle location permission request
    function locationPermission() {
      if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
          // Location permission granted, enable Simpan Data button
          simpanDataButton.removeAttribute("disabled");
          userLocationInput.value = `${position.coords.latitude},${position.coords.longitude}`;
          console.log(userLocationInput.value);
        }, function (error) {
          alert("Location permission denied. Simpan Data button is disabled.");
        }, {
          enableHighAccuracy: true, // Enable high-accuracy mode
        });
      } else {
        alert("Geolocation is not supported in your browser.");
      }
    }

    // Automatically request location permission when the page loads
    locationPermission();
  });
</script>
<!-- End of Main Content -->