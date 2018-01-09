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