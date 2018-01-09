<!-- page content -->
        <div class="right_col" role="main" style="min-height: 650px">
    

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Fakultas</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div id="ajax">
                  <div class="x_content">
                    <button type="button" class="btn btn-primary" id="add"><i class="fa fa-plus"></i> Add</button>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Kode Fakultas</th>
                          <th>Nama Fakultas</th>
                          <th></th>
                        </tr>
                      </thead>

                      <tbody id="ganti">
                      	<?php $no=1; foreach($fakultas as $fak){ ?>
                      		<tr>
                      			<td><?=$no?></td>
                      			<td><?=$fak['fakultas_id']?></td>
                      			<td><?=$fak['fakultas_name']?></td>
                      			<td style="text-align: center"><input type="hidden" class='id-fak' value="<?=$fak['fakultas_id']?>"><a href="#" class="edit-fak"><i class="fa fa-pencil-square-o"></i></a> | <a href="#" class="delete-fak"><i class="fa fa-trash-o"></i></a>
                      		</td>
                      		</tr>
                      	<?php $no++; } ?>
                      </tbody>
                    </table>
                  </div>
                  </div>
                  <div class="modal fade bs-modal-lg-tambah" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Tambah Data Fakultas</h4>
                        </div>
                        <form class="form-horizontal form-label-left" id="form-ini" action="<?=base_url('fakultas/tambah')?>" method="POST">
                          <div class="modal-body">
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fakultas-kode">Kode Fakultas <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="fakultas-kode" required="required" class="form-control col-md-7 col-xs-12" name="id">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fakultas-name">Nama Fakultas <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="fakultas-name" required="required" class="form-control col-md-7 col-xs-12" name="name">
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>


                   <div class="modal fade bs-modal-lg-edit" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Data Fakultas</h4>
                        </div>
                        <form class="form-horizontal form-label-left" id="form-ini2" action="<?=base_url('fakultas/edit')?>" method="POST">
                          <div class="modal-body">
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fakultas-kode">Kode Fakultas <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="fakultas-kode2" required="required" class="form-control col-md-7 col-xs-12" name="id">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fakultas-name">Nama Fakultas <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="fakultas-name2" required="required" class="form-control col-md-7 col-xs-12" name="name">
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button"  class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>


                   <div class="modal fade bs-modal-lg-delete" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Hapus Data Fakultas</h4>                        
                        </div>                        
                          <form  id="form-ini3" action="<?=base_url('fakultas/hapus')?>" method="POST">
                            <p style="margin-left: 20px">Apakah Anda Yakin Ingin Menghapus Data?</p>
                            <input type="hidden" class="id-fak3" name="id" value="">
                          <div class="modal-footer">
                            <button type="button"  class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <button type="submit" name="submit" class="btn btn-primary">Ya</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
