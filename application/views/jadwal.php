
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
                    <h2>Jadwal</h2>      
                     <button class="btn btn-danger hapus-semua" style="float: right;">Hapus</button>              
                    <div class="clearfix"></div>
                  </div>
                  <div id="ajax">
                  <div class="x_content">                    
                    <table class="table table-striped" style="text-align: center;">
                      <thead>
                        <tr>
                          <th>Hari</th>
                          <th>Jam</th>
                          <?php foreach($ruangan as $ruang){ ?>
                            <th><?=$ruang['nama_ruangan']?></th>                                                   
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody>

                        <?php  $hari = array("Senin","Selasa","Rabu","Kamis","jumat"); 
                                $jam = array(
                                    array("08.00 - 08.50","08:00:00"),
                                    array("08.50 - 09.40","08:50:00"),
                                    array("09.40 - 10.30","09:40:00"),
                                    array("10.30 - 11.20","10:30:00"),
                                    array("11.20 - 12.10","11:20:00"),
                                    array("12.10 - 13.00","12:10:00"),
                                    array("13.00 - 13.50","13:00:00"),
                                    array("13.50 - 14.40","13:50:00"),
                                    array("14.40 - 15.30","14:40:00")
                                  );
                          foreach($hari as $hr){
                            $har = 1;
                            foreach($jam as $jm){
                        ?>
                        <tr>
                          <?php if($har){ ?>
                          <th scope="row" rowspan="9" style="vertical-align: middle;"><?=$hr?></th>
                          <?php $har=0; } ?>
                          <td style="vertical-align: middle;"><?=$jm[0]?></td>

                          <?php foreach($ruangan as $ruang){ $isi=0; ?>
                           <?php 
                              $jadwal = $this->jadwal_model->get_jadwal($this->session->userdata('rl_prodi'),$ruang['id_ruangan'],$hr)->result_array();                              
                            ?>
                          <td style="height: 50px">   
                          <?php foreach($jadwal as $jwd){ ?>
                             
                            <?php if(count($jwd)>0){ ?>  

                                <?php if( $jwd['jad_hari'] == $hr and $jwd['id_ruangan']== $ruang['id_ruangan'] and $jwd['jad_jam_mulai']==$jm[1]){ ?>
                                    <?php $mtk = $this->general_model->select_by_id('rl_mata_kuliah','mat_kul_id',$jwd['mat_kul_id'])->row_array()?>
                                    <?=$jwd['mat_kul_id']."(".$mtk['mat_semester'].$jwd['jad_kom'].")"?><br><?=$jwd['dosen_kode']?><br>
                                    <a href= "#" style="padding: 5px" class="show-jadwal">
                                        <input type="hidden" class="id_jadwal" value="<?=$jwd['jad_id']?>"> 
                                    <i class="fa fa-link"></i></a>
                                    <a href="#" style="padding: 5px" class='edit-jadwal'><i class="fa fa-pencil"></i>
                                        <input type="hidden" class="id_jadwal" value="<?=$jwd['jad_id']?>"> 
                                        <input type="hidden" class="ruang" value="<?=$ruang['id_ruangan']?>"> 
                                        <input type="hidden" class="jam" value="<?=$jm[1]?>">
                                        <input type="hidden" class="hari" value="<?=$hr?>">
                                    </a>
                                    <a href="#" style="padding: 5px" class="delete-jadwal">
                                    <input type="hidden" class="id_matkul" value="<?=$jwd['mat_kul_id']?>"> 
                                    <input type="hidden" class="id_kelas" value="<?=$jwd['jad_kom']?>"> 
                                    <i class="fa fa-times"></i></a>
                                  <?php $isi=1; } ?>
                                  <?php } ?>                          
                                 
                          <?php } ?>
                              <?php if(!$isi){ ?>                              
                             <button class="btn btn-primary add-jadwal">+ 
                             <input type="hidden" class="ruang" value="<?=$ruang['id_ruangan']?>"> 
                             <input type="hidden" class="jam" value="<?=$jm[1]?>">
                             <input type="hidden" class="hari" value="<?=$hr?>">
                             </button>                              
                             <?php } ?>
                           </td>  
                          <?php } ?>
                                        
                        </tr>
                        <?php } ?>
                        <?php } ?>

                    
                      </tbody>
                    </table>
                   
                  </div>
                </div>




<!--modal -->
                 <div class="modal fade bs-modal-lg-tambah" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Tambah Jadwal</h4>
                        </div>
                        <form class="form-horizontal form-label-left" action="<?=base_url('jadwal/tambah')?>" method="POST" id="form-ini">
                         <input type="hidden" name="ruangan" value="" id="ruangan1">
                          <input type="hidden" name="jam" value="" id="jam1">
                          <input type="hidden" name="hari" value="" id="hari1">

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
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fakultas-name">Dosen <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="matkul1" required="required" class="form-control col-md-7 col-xs-12 select_dosen" name="dosen">                                  
                                  <?php foreach($dosen as $dsn){ ?>
                                      <option value="<?=$dsn['dosen_id']?>"><?=$dsn['dosen_name']?> (<?=$dsn['dosen_kode']?>)</option>
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
                          <h4 class="modal-title" id="myModalLabel">Ubah Jadwal</h4>
                        </div>
                        <form class="form-horizontal form-label-left" action="<?=base_url('jadwal/edit')?>" method="POST" id="form-ini2">
                         <input type="hidden" name="ruangan" value="" id="ruangan2">
                          <input type="hidden" name="jam" value="" id="jam2">
                          <input type="hidden" name="hari" value="" id="hari2">
                          <input type="hidden" name='matkul_sebelum' value='' id='matkul_sebelum'>
                          <input type="hidden" name='kelas_sebelum' value='' id='kelas_sebelum'>
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
                              <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="fakultas-name">Dosen <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="dosen2" required="required" class="form-control col-md-7 col-xs-12 select_dosen" name="dosen">                                  
                                  <?php foreach($dosen as $dsn){ ?>
                                      <option value="<?=$dsn['dosen_id']?>"><?=$dsn['dosen_name']?> (<?=$dsn['dosen_kode']?>)</option>
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


                 <div class="modal fade bs-modal-lg-show" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-md">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Rincian Jadwal</h4>
                        </div>
                            <div style="padding: 10px; font-size: 15px">
                                <table>                                 
                                  <tr>
                                    <td style="min-width: 130px">Nama Mata Kuliah </td><td style="min-width: 20px"> : </td><td id="s_matkul"></td>    
                                  </tr>
                                  <tr>
                                    <td style="min-width: 130px">Dosen Pengajar </td><td style="min-width: 20px"> : </td><td id="s_dosen"></td>                                
                                  </tr>
                                  <tr>
                                     <td style="min-width: 130px">Semester </td><td style="min-width: 20px"> : </td><td id="s_semester"></td> 
                                  </tr>
                                  <tr>
                                      <td style="min-width: 130px">Kelas </td><td style="min-width: 20px"> : </td><td id="s_kelas"></td>                                       
                                  </tr>
                                </table>
                            </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                        
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
                          <h4 class="modal-title" id="myModalLabel">Hapus Jadwal</h4>                        
                        </div>                        
                          <form  id="form-ini3" action="<?=base_url('jadwal/hapus')?>" method="POST">
                            <p style="margin-left: 20px">Apakah Anda Yakin Ingin Menghapus Data?</p>
                            <input type="hidden" class="id-matkul" name="id_matkul" value="">
                            <input type="hidden" class="id-kelas" name="id_kelas" value="">
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
                          <form  id="form-ini4" action="<?=base_url('jadwal/hapus_semua')?>" method="POST">
                            <p style="margin-left: 20px">Apakah Anda Yakin Ingin Menghapus Semua Data?</p>
                            <input type="hidden" class="id-matkul" name="id_matkul" value="">
                            <input type="hidden" class="id-kelas" name="id_kelas" value="">
                          <div class="modal-footer">
                            <button type="button"  class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <button type="submit" name="submit" class="btn btn-primary">Ya</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>