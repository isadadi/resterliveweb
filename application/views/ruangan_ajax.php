<div class="x_content">
                    <button type="button" class="btn btn-primary" id="add"><i class="fa fa-plus"></i> Add</button>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama Ruangan</th>                          
                          <th></th>                        
                        </tr>
                      </thead>

                      <tbody>
                      <?php $no=1; foreach($ruangan as $ruang){ ?>
                        <tr>
                          <td><?=$no?></td>
                          <td><?=$ruang['nama_ruangan']?></td>                          
                          <td style="text-align: center"><input type="hidden" class='id-ruang' value="<?=$ruang['id_ruangan']?>"><a href="#" class="edit-ruang"><i class="fa fa-pencil-square-o"></i></a> | <a href="#" class="delete-ruang"><i class="fa fa-trash-o"></i></a>
                          </td>
                        </tr>
                      <?php $no++; } ?>
                      </tbody>
                    </table>
                  </div>