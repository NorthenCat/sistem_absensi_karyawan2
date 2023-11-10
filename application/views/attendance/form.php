<!-- DataTales -->
<div class="card shadow my-4 mx-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Daftar Mahasiswa
    </h6>
  </div>
  <div class="card-body">
    <form role="form" method="post" name="postform" enctype="multipart/form-data"
      action="<?= base_url('attendance/inputAbsensi?id_mkelas=' . $id_mkelas); ?>">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr align="center">
              <th>No</th> <!-- change this width to small -->
              <th>Profil</th>
              <th>NPM</th>
              <th>Nama</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody align="center">
            <?php $i = 1;
            foreach ($daftar_siswa as $siswa) { ?>
              <tr>
                <td>
                  <?= $i++; ?>
                </td>
                <td><img class="img-profile rounded-circle" style="width:50px;height:50px;"
                    src="<?= base_url('images/pp/') . $siswa['foto']; ?>"></td>
                <td>
                  <?= $siswa['nis'] ?>
                </td>
                <td>
                  <?= ucwords($siswa['nama_siswa']) ?>
                </td>
                <td>
                  <label class="radio-inline mr-2"><input type="radio" name="<?= $siswa['id_siswa'] ?>" value="H" <?php if ($siswa['ket'] == 'H')
                      echo 'checked'; ?>>Hadir</label>
                  <label class="radio-inline mr-2"><input type="radio" name="<?= $siswa['id_siswa'] ?>" value="S" <?php if ($siswa['ket'] == 'S')
                      echo 'checked'; ?>>Sakit</label>
                  <label class="radio-inline mr-2"><input type="radio" name="<?= $siswa['id_siswa'] ?>" value="I" <?php if ($siswa['ket'] == 'I')
                      echo 'checked'; ?>>Izin</label>
                  <label class="radio-inline mr-2"><input type="radio" name="<?= $siswa['id_siswa'] ?>" value="A" <?php if ($siswa['ket'] == 'A')
                      echo 'checked'; ?>>Alpha</label>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- Hidden Input -->
      <input type="hidden" id="userLocation" name="userLocation" value="">
      <button id="simpanAbsen" type="submit" class="btn btn-primary mt-4 col-md-2 offset-10" disabled>Simpan
        Data</button>
    </form>
  </div>
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




<!-- /.container-fluid -->
</div>