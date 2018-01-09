 
 <div class="x_content">
                    <button type="button" class="btn btn-primary" id="add"><i class="fa fa-plus"></i> Add</button>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Kode Prodi</th>
                          <th>Nama Prodi</th>
                          <th>Nama Fakultas</th>
                          <th></th>
                        </tr>
                      </thead>

                      <tbody>
                        <?php $no=1; foreach($prodi as $prod){ ?>
                            <tr>
                              <td><?=$no?></td>
                              <td><?=$prod['prodi_id']?></td>
                              <td><?=$prod['prodi_name']?></td>
                              <td><?=$prod['fakultas_name']?></td>
                              <td style="text-align: center"><input type="hidden" class='id-prod' value="<?=$prod['prodi_id']?>"><a href="#" class="edit-prod"><i class="fa fa-pencil-square-o"></i></a> | <a href="#" class="delete-prod"><i class="fa fa-trash-o"></i></a>
                          </td>
                            </tr>
                        <?php $no++; } ?>
                      </tbody>
                    </table>
                  </div>
