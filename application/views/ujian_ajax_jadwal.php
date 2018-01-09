<table class="table table-bordered" style="text-align: center;">
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

                        <?php                                  
                                $hari['Mon'] = 'Senin';
                                $hari['Tue'] = 'Selasa';
                                $hari['Wed'] = 'Rabu';
                                $hari['Thu'] = 'Kamis';
                                $hari['Fri'] = 'Jumat';
                                $enhari = array("Mon","Tue","Wed","Thu","Fri");

                                $tgl1 = new DateTime($tanggal['tgl_mulai_ujian']);
                                $tgl2 = new DateTime($tanggal['tgl_selesai_ujian']);

                                $diff = $tgl2->diff($tgl1)->format("%a");
                                
                                $jam = array(
                                    array("08.15 - 09.45","08:15:00"),
                                    array("10.00 - 11.30","10:00:00"),
                                    array("13.00 - 14.30","13:00:00")                                   
                                  );

                          for($i=0;$i<=$diff;$i++){
                            $har = 1;
                            $date = date('Y-m-d', strtotime($tanggal['tgl_mulai_ujian'] . "+$i days"));  
                            $newdate = explode('-', $date);  
                            $nhari = date('D', strtotime($date));                        

                          if(in_array($nhari, $enhari))                              
                            foreach($jam as $jm){
                        ?>
                        <tr>
                          <?php if($har){ ?>
                          <th scope="row" rowspan="3" style="vertical-align: middle;"><?=$hari[$nhari]?><br> <?=$newdate[2].'/'.$newdate[1].'/'.$newdate[0]?> </th>
                          <?php $har=0; } ?>
                          <td style="vertical-align: middle;"><?=$jm[0]?></td>

                          <?php foreach($ruangan as $ruang){ $isi=0; ?>                          
                          <td style="height: 50px">   
                                <?php foreach($jadwal as $jwd){ ?>
                             
                            <?php if(count($jwd)>0){ ?>  

                                <?php if( $jwd['jad_uj_tanggal'] == $date and $jwd['id_ruangan']== $ruang['id_ruangan'] and $jwd['jad_uj_waktu']==$jm[1]){ ?>
                                    <?php $mtk = $this->general_model->select_by_id('rl_mata_kuliah','mat_kul_id',$jwd['mat_kul_id'])->row_array()?>
                                    <p title="<?=$mtk['mat_kul_name']?>"><?=$jwd['mat_kul_id']."(".$mtk['mat_semester'].$jwd['jad_uj_kom'].")"?></p>                                    
                                    <a href="#" style="padding: 5px" class='edit-jadwal'><i class="fa fa-pencil"></i>
                                        <input type="hidden" class="id_jadwal" value="<?=$jwd['jad_uj_id']?>">                                         
                                    </a>
                                    <a href="#" style="padding: 5px" class="delete-jadwal">
                                    <input type="hidden" class="id_jadwal" value="<?=$jwd['jad_uj_id']?>">
                                    <i class="fa fa-times"></i></a>
                                  <?php $isi=1; } ?>
                                  <?php } ?>                          
                                 
                          <?php } ?>
                              <?php if(!$isi){ ?>                         
                             <button class="btn btn-primary add-jadwal">+ 
                             <input type="hidden" class="ruang" value="<?=$ruang['id_ruangan']?>"> 
                             <input type="hidden" class="jam" value="<?=$jm[1]?>">
                             <input type="hidden" class="hari" value="<?=$date?>">
                             <input type="hidden" class="id_tgl" value="<?=$id_tgl?>">
                             </button>                              
                             <?php } ?>
                           </td>  
                          <?php } ?>
                                        
                        </tr>
                        <?php } ?>
                        <?php } ?>

                    
                      </tbody>
                    </table>