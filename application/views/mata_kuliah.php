<!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row" style="min-height: 580px">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Mata Kuliah</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div id="ajax">
                  <div class="x_content">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-modal-lg-tambah"><i class="fa fa-plus"></i> Add</button>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Kode Mata Kuliah</th>
                          <th>Nama Mata Kuliah</th>
                          <th>Tipe Mata Kuliah</th>
                          <th>SKS</th>
                          <th></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $no=1; foreach($matkul as $mtk){ ?>
                          <tr>
                            <td><?=$no?></td>
                            <td><?=$mtk['mat_kul_id']?></td>
                            <td><?=$mtk['mat_kul_name']?></td>
                            <td><?=$mtk['mat_kul_type']?></td>
                            <td><?=$mtk['mat_kul_sks']?></td>
                            <td style="text-align: center"><input type="hidden" class='id-mat' value="<?=$mtk['mat_kul_id']?>"><a href="#" class="edit-mat"><i class="fa fa-pencil-square-o"></i></a> | <a href="#" class="delete-mat"><i class="fa fa-trash-o"></i></a>
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
                          <h4 class="modal-title" id="myModalLabel">Tambah Mata Kuliah</h4>
                        </div>
                        <form class="form-horizontal form-label-left" id="form-ini" action="<?=base_url('matakuliah/tambah')?>"  method="POST">                         
                          <div class="modal-body">
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matkul-id">Kode Mata Kuliah <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="matkul-id" required="required" class="form-control col-md-7 col-xs-12" name="matkul_id" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matkul-name">Nama Mata Kuliah <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="matkul-name" required="required" class="form-control col-md-7 col-xs-12" name="matkul_name">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matkul-type">Tipe Mata Kuliah <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <p>
                                  <input type="radio" class="flat" name="matkul_type" value="W" checked="" required /> Wajib
                                  <input type="radio" class="flat" name="matkul_type" value="P" /> Pilihan
                                </p>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matkul-sks">SKS <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" placeholder="0" id="matkul-sks" required="required" class="form-control col-md-7 col-xs-12" name="matkul_sks" min="0">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matkul-sks">Semester <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" placeholder="0" id="matkul-semester" required="required" class="form-control col-md-7 col-xs-12" name="matkul_semester" min="0">
                              </div>
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


                   <div class="modal fade bs-modal-lg-edit" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Mata Kuliah</h4>
                        </div>
                        <form class="form-horizontal form-label-left" id="form-ini2" action="<?=base_url('matakuliah/edit')?>" method="POST">
                          <div class="modal-body">
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matkul-id">Kode Mata Kuliah <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="matkul-id2" required="required" class="form-control col-md-7 col-xs-12" name="matkul_id" >
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matkul-name">Nama Mata Kuliah <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="matkul-name2" required="required" class="form-control col-md-7 col-xs-12" name="matkul_name">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matkul-type">Tipe Mata Kuliah <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <p>
                                  <input type="radio" class="flat" name="matkul_type2" value="W" checked="" required /> Wajib
                                  <input type="radio" class="flat" name="matkul_type2" value="P" /> Pilihan
                                </p>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matkul-sks">SKS <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" placeholder="0" id="matkul-sks2" required="required" class="form-control col-md-7 col-xs-12" name="matkul_sks" min="0">
                              </div>
                            </div>
                             <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matkul-sks">Semester <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" placeholder="0" id="matkul-semester2" required="required" class="form-control col-md-7 col-xs-12" name="matkul_semester" min="0">
                              </div>
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


                    <div class="modal fade bs-modal-lg-delete" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Hapus Data Dosen</h4>                        
                        </div>                        
                          <form  id="form-ini3" action="<?=base_url('matakuliah/hapus')?>" method="POST">
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
