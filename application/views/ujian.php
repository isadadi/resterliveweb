
<style type="text/css">
  th{
    text-align: center;
  }

  .table{
      display: block !important;
      overflow-x: auto;      
    } 

    th{
      width: 150px;
    }

</style>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row">           
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Jadwal Ujian</h2>      
                     <button class="btn btn-danger hapus-semua" style="float: right;">Hapus</button>              
                    <div class="clearfix"></div>
                  </div>
                 
                  <div class="x_content" style="min-height: 450px"> 
                  <div id="ajax_tgl">
                  <select name="tgl_ujian" class="form-control" style="width: 200px;float: left;margin-right: 20px" id="pilih_tanggal">
                    <option value=""></option>
                  <?php foreach($tanggal as $tgl){ 
                        $tgl1 = explode('-', $tgl['tgl_mulai_ujian']);
                        $tgl2 = explode('-', $tgl['tgl_selesai_ujian']);
                    ?>
                    <option value="<?=$tgl['id_tgl_ujian']?>"><?=$tgl1[2].'/'.$tgl1[1].'/'.$tgl1[0].' - '.$tgl2[2].'/'.$tgl2[1].'/'.$tgl2[0] ?></option>
                  <?php } ?>
                  </select>
                  </div>
                   <button type="button" class="btn btn-primary" id="add-tanggal"><i class="fa fa-plus"></i></button>
                   <button type="button" class="btn btn-danger" id="minus"><i class="fa fa-minus"></i></button>



                   <div id="ajax" style="margin-top: 30px">
                       
                   </div>
                  </div>
                



<div class="modal fade bs-modal-lg-tambah2" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Tambah Tanggal Ujian</h4>
                        </div>
                        <form class="form-horizontal form-label-left" action="<?=base_url('ujian/tambah_tgl')?>" method="POST" id="form-ini4">                         
                          <div class="modal-body">
                              <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fakultas-name">Tanggal Mulai <span class="required">*</span>
                              </label>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" id="tgl_mulai" required="required" class="form-control col-md-7 col-xs-12" name="tgl_mulai">
                              </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fakultas-name">Tanggal Selesai <span class="required">*</span>
                              </label>
                             <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" id="tgl_selesai" required="required" class="form-control col-md-7 col-xs-12" name="tgl_selesai">
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


<!--modal -->
                 <div class="modal fade bs-modal-lg-tambah" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Tambah Jadwal Ujian</h4>
                        </div>
                        <form class="form-horizontal form-label-left" action="<?=base_url('ujian/tambah')?>" method="POST" id="form-ini">
                         <input type="hidden" name="ruangan" value="" id="ruangan1">
                          <input type="hidden" name="jam" value="" id="jam1">
                          <input type="hidden" name="hari" value="" id="hari1">
                          <input type="hidden" name="id_tgl" value="" id="id_tgl">
                          <div class="modal-body">
                              <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fakultas-name">Mata Kuliah <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="matkul1" required="required" class="form-control col-md-7 col-xs-12 select_matkul" name="matkul">                                  
                                  <?php foreach($matkul as $mtk){ ?>
                                      <option value="<?=$mtk['mat_kul_id']?>"><?=$mtk['mat_kul_id'].' - '.$mtk['mat_kul_name']?></option>
                                  <?php } ?>                                  
                                </select>
                              </div>
                            </div>                            
                                                        
                             <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prodi-name">Kelas <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="kelas1" required="required" class="form-control col-md-7 col-xs-12" name="kelas">
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



                   <div class="modal fade bs-modal-lg-edit" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Jadwal Ujian</h4>
                        </div>
                        <form class="form-horizontal form-label-left" action="<?=base_url('ujian/edit')?>" method="POST" id="form-ini2">                         
                          <input type="hidden" name="id_jadwal" value="" id="id_jadwal2">
                          <div class="modal-body">
                              <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fakultas-name">Mata Kuliah <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="matkul2" required="required" class="form-control col-md-7 col-xs-12 select_matkul" name="matkul">                                  
                                  <?php foreach($matkul as $mtk){ ?>
                                      <option value="<?=$mtk['mat_kul_id']?>"><?=$mtk['mat_kul_id'].' - '.$mtk['mat_kul_name']?></option>
                                  <?php } ?>                                  
                                </select>
                              </div>
                            </div>
                            
                                                        
                             <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prodi-name">Kelas <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="kelas2" required="required" class="form-control col-md-7 col-xs-12" name="kelas">
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
        <!-- /page content -->



                   <div class="modal fade bs-modal-lg-delete" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Hapus Jadwal Ujian</h4>                        
                        </div>                        
                          <form  id="form-ini3" action="<?=base_url('ujian/hapus')?>" method="POST">
                            <p style="margin-left: 20px">Apakah Anda Yakin Ingin Menghapus Data?</p>
                            <input type="hidden" class="id_jadwal3" name="id_jadwal" value="">                            
                          <div class="modal-footer">
                            <button type="button"  class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <button type="submit" name="submit" class="btn btn-primary">Ya</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>



                   <div class="modal fade bs-modal-lg-delete-all" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Hapus Jadwal</h4>                        
                        </div>                        
                          <form  id="form-ini6" action="<?=base_url('ujian/hapus_semua')?>" method="POST">
                            <p style="margin-left: 20px">Apakah Anda Yakin Ingin Menghapus Data?</p>
                           <input type="hidden" class="id-tgl5" name="id-tgl5" value="">          
                          <div class="modal-footer">
                            <button type="button"  class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <button type="submit" name="submit" class="btn btn-primary">Ya</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                   <div class="modal fade bs-modal-lg-kurang" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Hapus Tanggal Ujian</h4>                        
                        </div>                        
                          <form  id="form-ini5" action="<?=base_url('ujian/hapus_tgl')?>" method="POST">
                            <p style="margin-left: 20px">Apakah Anda Yakin Ingin Menghapus Data?</p>
                            <input type="hidden" class="id-tgl4" name="id" value="">
                          <div class="modal-footer">
                            <button type="button"  class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <button type="submit" name="submit" class="btn btn-primary">Ya</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>