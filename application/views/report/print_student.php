<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>Laporan Kehadiran</title>
</head>

<body>
  <div class="container border">
    <div class="row mb-2">
      <div class="col">
        <h2 class="text-center">Laporan Kehadiran Siswa Kelas</h2>
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-6">
        <h1 class="h5">Kode Kelas :
          <?= $kelas['kd_kelas'] ?>
        </h1>
      </div>
      <div class="col-6 text-right">
        <?php if ($start != null || $end != null): ?>
          <h1 class="h5">From: <i>
              <?= $start; ?>
            </i> To: <i>
              <?= $end; ?>
            </i></h1>
        <?php else: ?>
          <h1 class="h5">All</h1>
        <?php endif; ?>
      </div>
    </div>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>No</th>
          <th>Kelas</th>
          <th>Mata Pelajaran</th>
          <th>Nama Siswa</th>
          <th>Tanggal</th>
          <th>Jam Absen</th>
          <th>Keterangan Absen</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // looping attendance list
        $i = 1;
        foreach ($attendance as $atd):
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
                <span>Hadir</span>
              <?php elseif ($atd['ket'] == 'S'): ?>
                <span>Sakit</span>
              <?php elseif ($atd['ket'] == 'I'): ?>
                <span>Izin</span>
              <?php elseif ($atd['ket'] == 'A'): ?>
                <span>Alpha</span>
              <?php endif; ?>
            </td>
          <?php endforeach; ?>
      </tbody>
    </table>
  </div>



  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>

  <!-- Optional JavaScript -->
  <script>
    $(function () {
      window.print();
      setTimeout(() => {
        window.close()
      }, 300);
    })
  </script>
</body>

</html>