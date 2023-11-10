<div class="mx-4">
    <h1 class="h3 mb-4 text-gray-800">
        <?= $title; ?>
    </h1>
    <div class="row">
        <div class="col-lg-3">
            <a href="<?= base_url('learning/listSiswa?id=' . $kelas['kd_kelas']) ?>"
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
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card mx-4">
            <div class="card-header">
                <h1>Daftar Siswa</h1>
            </div>
            <div class="card-body">
                <div id="dataTable_filter" class="dataTables_filter text-right">
                    <label>
                        <input type=" search" id="searchInput" class="form-control form-control-md" placeholder="Search"
                            aria-controls="dataTable">
                    </label>
                </div>
                <form action="<?= base_url('learning/addSiswaToClass?id=' . $kelas['kd_kelas']) ?>" method="POST"
                    enctype="multipart/form-data">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No.</th>
                                    <th style="width: 5%;">Foto</th>
                                    <th style="width: 15%;">NIS</th>
                                    <th style="width: 20%;">Nama Siswa</th>
                                    <th style="width: 20%;">Alamat</th>
                                    <th style="width: 20%;">TTL</th>
                                    <th style="width: 2%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($siswa as $s) { ?>
                                    <tr>
                                        <td class="text-center">
                                            <?= $no++; ?>.
                                        </td>
                                        <td>
                                            <img src="<?= base_url('images/pp/') . $s['foto'] ?>" alt="" width="50px"
                                                class="rounded-circle">
                                        </td>
                                        <td>
                                            <?= $s['nis'] ?>
                                        </td>
                                        <td class="nama-siswa">
                                            <?= ucwords($s['nama_siswa']) ?>
                                        </td>
                                        <td>
                                            <?= ucwords($s['alamat']) ?>
                                        </td>
                                        <td>
                                            <?= ucwords($s['tempat_lahir']) ?>,
                                            <?= $s['tgl_lahir'] ?>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="nis[]" class="delete-checkbox checkbox-sm"
                                                value="<?= $s['nis'] ?>">
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <button type="submit"
                            class="btn btn-sm btn-primary bg-gradient-primary btn-icon-split mt-4 float-right rounded-0">
                            <span class="icon text-white">
                                <i class="fas fa-plus-circle"></i>
                            </span>
                            <span class="text">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>