

                   
                <div class="x_content" style="width: 100%">
                    <button type="button" class="btn btn-primary" id="add"><i class="fa fa-plus"></i> Add</button>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Kode Fakultas</th>
                          <th>Nama Fakultas</th>
                          <th></th>
                        </tr>
                      </thead>

                      <tbody id="ganti">
                        <?php $no=1; foreach($fakultas as $fak){ ?>
                          <tr>
                            <td><?=$no?></td>
                            <td><?=$fak['fakultas_id']?></td>
                            <td><?=$fak['fakultas_name']?></td>
                            <td style="text-align: center"><input type="hidden" class='id-fak' value="<?=$fak['fakultas_id']?>"><a href="#" class="edit-fak"><i class="fa fa-pencil-square-o"></i></a> | <a href="#" class="delete-fak"><i class="fa fa-trash-o"></i></a>
                          </td>
                          </tr>
                        <?php $no++; } ?>
                      </tbody>
                    </table>
                  </div>


                 