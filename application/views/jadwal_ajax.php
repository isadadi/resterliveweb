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
                                    <?php $mtk = $this->general_model->select('rl_mata_kuliah','mat_kul_id',$jwd['mat_kul_id'])->row_array()?>
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