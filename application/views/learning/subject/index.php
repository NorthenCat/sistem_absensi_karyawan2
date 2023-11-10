<div class="row">
    <div class="col-md-12">
        <div class="card mx-4">
            <div class="card-header">
                <div class="card-title">
                    <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i
                            class="fa fa-plus mr-1"></i>Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message') ?>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode</th>
                                <th>Nama Mapel</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($mapel as $k) { ?>
                                <tr>
                                    <td>
                                        <?= $no++; ?>.
                                    </td>

                                    <td>
                                        <?= $k['kode_mapel']; ?>
                                    </td>
                                    <td>
                                        <?= $k['mapel']; ?>
                                    </td>
                                    <td>

                                        <a href="<?= base_url('learning/e_sub?id=' . $k['kode_mapel']) ?>"
                                            class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit<?= $k['id_mapel'] ?>"><i class="far fa-edit"></i> Edit</a>
                                        <a class="btn btn-danger btn-sm" onclick="return confirm('Yakin Hapus Data ?')"
                                            href="<?= base_url('learning/delSub?id=' . $k['kode_mapel']) ?>"><i
                                                class="fas fa-trash"></i> Del</a>
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

<!-- Modal Edit Subject -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="edit<?= $k['id_mapel'] ?>"
    class="modal fade" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="exampleModalLabel" class="modal-title">Edit Mapel</h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('learning/editSub') ?>" method="post">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="hidden" name="kode" value="<?= $k['kode_mapel'] ?>">
                            <div class="form-group">
                                <label>Nama mapel</label>
                                <input name="mapel" type="text" value="<?= $k['mapel'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <button name="edit" class="btn btn-primary" type="submit">Edit</button>

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

<!-- Modal Tambah Subject -->
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
                <form action="<?= base_url('learning/addSubject') ?>" method="post" enctype="multipart/form-data"
                    class="form-horizontal">
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