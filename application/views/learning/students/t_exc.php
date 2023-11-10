<?php 

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
?>


<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<div class="row">
    <div class="col-md-12">
        <div class="card mx-4">
            <div class="card-header">
                <div class="card-title">
                    <h3>Import Siswa</h3>
                    <a href="<?= base_url('learning/down') ?>" class="btn btn-success btn-sm"> <i
                            class="fas fa-fw fa-download"></i> Download Template</a>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url('Learning/addEx') ?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
            <label class="form-label">Pilih file untuk di import ke database siswa</label>
            <input class="form-control form-control-sm"  type="file" name="file_excel" accept=".xls,.xlsx">
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