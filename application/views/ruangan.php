<!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Ruangan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div id="ajax">
                  <div class="x_content">
                    <button type="button" class="btn btn-primary" id="add"><i class="fa fa-plus"></i> Add</button>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Ruangan</th>                          
                          <th></th>                        
                        </tr>
                      </thead>

                      <tbody>
                      <?php $no=1; foreach($ruangan as $ruang){ ?>
                        <tr>
                          <td><?=$no?></td>
                          <td><?=$ruang['nama_ruangan']?></td>                          
                          <td style="text-align: center"><input type="hidden" class='id-ruang' value="<?=$ruang['id_ruangan']?>"><a href="#" class="edit-ruang"><i class="fa fa-pencil-square-o"></i></a> | <a href="#" class="delete-ruang"><i class="fa fa-trash-o"></i></a>
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
                          <h4 class="modal-title" id="myModalLabel">Tambah Data Ruangan</h4>
                        </div>
                        <form class="form-horizontal form-label-left" id="form-ini" action="<?=base_url('ruangan/tambah')?>" method="POST">
                          <div class="modal-body">
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dosen-nip">Nama Ruangan
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="nama-ruang" class="form-control col-md-7 col-xs-12" name="nama">
                              </div>
                            </div>                            
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>                   




                </div>
              </div>


               <div class="modal fade bs-modal-lg-delete" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Hapus Data Dosen</h4>                        
                        </div>                        
                          <form  id="form-ini3" action="<?=base_url('ruangan/hapus')?>" method="POST">
                            <p style="margin-left: 20px">Apakah Anda Yakin Ingin Menghapus Data?</p>
                            <input type="hidden" class="id-ru3" name="id" value="">
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

          <div class="modal fade bs-modal-lg-edit" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Data Ruangan</h4>
                        </div>
                        <form class="form-horizontal form-label-left" id="form-ini2" action="<?=base_url('ruangan/edit')?>" method="POST">
                          <div class="modal-body">
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dosen-nip">Nama Ruangan
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="hidden" id="id-ru2" name="id" value="">
                                <input type="text" id="nama-ruang2" class="form-control col-md-7 col-xs-12" name="nama">
                              </div>
                            </div>                            
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>                        


        </div>
        <!-- /page content -->

