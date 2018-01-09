  <div class="x_content">
                    <button type="button" class="btn btn-primary" id="add"><i class="fa fa-plus"></i> Add</button>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Tanggal Mulai</th>
                          <th>Tanggal Selesai</th>
                          <th>Keterangan</th>
                          <th></th>
                        </tr>
                      </thead>

                       <tbody id="ganti">
                        <?php $no=1; foreach($libur as $lbr){ ?>
                          <tr>
                            <td><?=$no?></td>
                            <td><?=$lbr['libur_tgl_mulai']?></td>
                            <td><?=$lbr['libur_tgl_selesai']?></td>
                            <td><?=$lbr['libur_keterangan']?></td>
                            <td style="text-align: center"><input type="hidden" class='id-fak' value="<?=$lbr['libur_id']?>"><a href="#" class="edit-fak"><i class="fa fa-pencil-square-o"></i></a> | <a href="#" class="delete-fak"><i class="fa fa-trash-o"></i></a>
                          </td>
                          </tr>
                        <?php $no++; } ?>
                      </tbody>
                    </table>
                  </div>