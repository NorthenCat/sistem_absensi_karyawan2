<div class="row">
    <div class="col-md-12">
        <div class="card mx-4">
            <div class="card-header">
                <div class="card-title">
                    <a href="<?= base_url('learning/t_stud'); ?>" class="btn btn-primary btn-sm"><i
                            class="fa fa-plus"></i> Tambah</a>
                            <a href="<?= base_url('learning/t_exc'); ?>" class="btn btn-info btn-sm"><i
                            class="fas fa-fw fa-upload"></i> Excel</a>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message') ?>
                <div id="dataTable_filter" class="dataTables_filter text-right">
                    <label>
                        <input type=" search" id="searchInput" class="form-control form-control-md" placeholder="Search"
                            aria-controls="dataTable">
                    </label>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No.</th>
                                <th style="width: 5%;">Foto</th>
                                <th style="width: 15%;">NIS</th>
                                <th style="width: 20%;">Nama Siswa</th>
                                <th style="width: 20%;">Alamat</th>
                                <th>TTL</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($siswa as $s) { ?>
                                <tr>
                                    <td>
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
                                    <td>
                                    <td>

                                        <a href="<?= base_url('learning/e_stud?id=' . $s['nis']) ?>"
                                            class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit<?= $s['nis'] ?>"><i class="far fa-edit"></i> Edit</a>
                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ??')"
                                            href="<?= base_url('learning/delStud?id=' . $s['nis']) ?>"><i
                                                class="fas fa-trash"></i> Del</a>

                                        <!-- Modal -->
                                        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
                                            id="edit<?= $s['nis'] ?>" class="modal fade" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 id="exampleModalLabel" class="modal-title">Ubah Data Siswa</h4>
                                                        <button type="button" data-dismiss="modal" aria-label="Close"
                                                            class="close"><span aria-hidden="true">×</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url('learning/editStud') ?>" method="post"
                                                            enctype="multipart/form-data">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <!-- Image Profile -->
                                                                    <div
                                                                        class="mx-auto d-flex justify-content-center align-items-center mb-3">
                                                                        <img src="<?= base_url('images/pp/') . $s['foto'] ?>"
                                                                            alt="" width="100px" class="rounded-circle">
                                                                        <div class="ml-2">
                                                                            <label for="profile_image">Ubah Foto
                                                                                Siswa</label>
                                                                            <input type="file" class="form-control-file"
                                                                                name="profile_image" id="profile_image">
                                                                            <input type="hidden" name='old_image'
                                                                                value="<?= $s['foto'] ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="d_id">NIS</label>
                                                                        <input type="text" class="form-control" readonly
                                                                            autofocus name="d_id" id="d_id"
                                                                            value="<?= $s['nis'] ?>">
                                                                        <label>Nama Siswa</label>
                                                                        <input name="name" type="text"
                                                                            value="<?= ucwords($s['nama_siswa']) ?>"
                                                                            class="form-control">
                                                                        <label for="kelamin">Jenis Kelamin</label>
                                                                        <input type="text" class="form-control" readonly
                                                                            autofocus name="kelamin" id="kelamin"
                                                                            value="<?= ($s['jk'] == 'L') ? 'Laki - Laki' : 'Perempuan' ?>">
                                                                        <label for="alamat">Alamat</label>
                                                                        <input type="text" class="form-control"
                                                                            name="alamat" id="alamat"
                                                                            value="<?= ucwords($s['alamat']) ?>">
                                                                        <label for="tempat_lahir">Tempat Lahir</label>
                                                                        <input type="text" class="form-control"
                                                                            name="tempat_lahir" id="tempat_lahir"
                                                                            value="<?= ucwords($s['tempat_lahir']) ?>">
                                                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                                                        <input type="date" class="form-control"
                                                                            name="tgl_lahir" id="tgl_lahir"  value="<?= $s['tgl_lahir'] ?>">


                                                                    </div>

                                                                    <div class="form-group text-center">
                                                                        <button name="edit" class="btn btn-primary"
                                                                            type="submit">Ubah</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.modal -->



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


<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="exampleModalLabel" class="modal-title">Tambah Mapel</h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label>Kode mapel</label>
                        <input name="kode" type="text" value="MP-<?= time() ?>" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama mapel</label>
                        <input name="mapel" type="text" placeholder="Nama mapel" class="form-control">
                    </div>


                    <div class="form-group">
                        <button name="save" class="btn btn-primary" type="submit">Save</button>
                    </div>
                </form>



            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $(document).ready(function () {
        var searchTimer;

        $("#searchInput").on("input", function () {
            clearTimeout(searchTimer);

            var searchText = $(this).val().toLowerCase();

            searchTimer = setTimeout(function () {
                $("table tbody tr").each(function () {
                    var namaSiswaCell = $(this).find(".nama-siswa");

                    var rowText = namaSiswaCell.text().toLowerCase();

                    if (rowText.includes(searchText)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }, 200);
        });
    });
</script>