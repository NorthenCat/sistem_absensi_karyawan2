<div class="row">
    <div class="col-md-12">
        <div class="card mx-4">
            <div class="card-header">
                <div class="card-title">
                    <a href="" class="btn btn-primary btn-sm text-white"
                        data-toggle="modal" data-target="#addKelas"><i class="fa fa-plus"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message') ?>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kode Kelas</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Nama Kelas</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($kelas as $k) { ?>
                            <tr>
                                <td><b>
                                        <?= $no++; ?>.
                                    </b></td>
                                <td>
                                    <?= $k['kd_kelas']; ?>
                                </td>
                                <td>
                                    <?= $k['kelas']; ?>
                                </td>
                                <td>
                                    <?= $k['nama_kelas']; ?>
                                </td>
                                <td>

                                    <a href="<?= base_url('learning/e_class?id=' . $k['kd_kelas']) ?>"
                                        class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#edit<?= $k['id_mkelas'] ?>"><i class="far fa-edit"></i> Edit</a>
                                    <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ?')"
                                        href="<?= base_url('learning/delClass?id=' . $k['kd_kelas']) ?>"><i
                                            class="fas fa-trash"></i> Del</a>
                                    <a href="<?= base_url('learning/listSiswa?id=' . $k['kd_kelas']) ?>"
                                        class="btn btn-info btn-sm text-white">
                                        <i class="fa fa-user"></i> List</a>

                                    <!-- Modal -->
                                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
                                        id="edit<?= $k['id_mkelas'] ?>" class="modal fade" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 id="exampleModalLabel" class="modal-title">Edit Kelas</h4>
                                                    <button type="button" data-dismiss="modal" aria-label="Close"
                                                        class="close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url('learning/editClass') ?>" method="post"
                                                        enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="form-group">
                                                                        <label>Kode Kelas</label>
                                                                        <input name="kode" type="text"
                                                                            value="<?= $k['kd_kelas'] ?>"
                                                                            class="form-control" readonly>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="d_class">Kelas</label>
                                                                        <select name="d_class" id="d_class"
                                                                            class="form-control">
                                                                            <option value="X"
                                                                                <?= $k['kelas'] == 'X' ? 'selected' : '' ?>>
                                                                                X</option>
                                                                            <option value="XI"
                                                                                <?= $k['kelas'] == 'XI' ? 'selected' : '' ?>>
                                                                                XI</option>
                                                                            <option value="XII"
                                                                                <?= $k['kelas'] == 'XII' ? 'selected' : '' ?>>
                                                                                XII</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Nama Kelas</label>
                                                                        <input name="kelas" type="text"
                                                                            value="<?= $k['nama_kelas'] ?>"
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button name="edit" class="btn btn-primary"
                                                                        type="submit">Edit</button>
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



        <!-- Modal -->
        <div id="addKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
            class="modal fade text-left">
            <div role="document" class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="exampleModalLabel" class="modal-title">Tambah Kelas</h4>
                        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= base_url('learning/addClass') ?>" method="post" enctype="multipart/form-data"
                            class="form-horizontal">
                            <div class="form-group">
                                <div class="form-group">
                                    <label>Kode Kelas</label>
                                    <input name="kode" type="text" value="KL-<?= time(); ?>" class="form-control"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="d_class">Kelas</label>
                                    <select name="d_class" id="d_class" class="form-control">
                                        <option value="X">X</option>
                                        <option value="XI">XI</option>
                                        <option value="XII">XII</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Nama Kelas</label>
                                    <input name="kelas" type="text" placeholder="Nama kelas .." class="form-control">
                                </div>
                                <div class="form-group">
                                    <button name="save" class="btn btn-primary" type="submit">Simpan</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Batal</button>
                                </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </div>
</div>