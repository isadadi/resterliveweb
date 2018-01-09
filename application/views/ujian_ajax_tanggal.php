 <select name="tgl_ujian" class="form-control" style="width: 200px;float: left;margin-right: 20px" id="pilih_tanggal">
                    <option></option>
                  <?php foreach($tanggal as $tgl){ 
                        $tgl1 = explode('-', $tgl['tgl_mulai_ujian']);
                        $tgl2 = explode('-', $tgl['tgl_selesai_ujian']);
                    ?>
                    <option value="<?=$tgl['id_tgl_ujian']?>"><?=$tgl1[2].'/'.$tgl1[1].'/'.$tgl1[0].' - '.$tgl2[2].'/'.$tgl2[1].'/'.$tgl2[0] ?></option>
                  <?php } ?>
                  </select>