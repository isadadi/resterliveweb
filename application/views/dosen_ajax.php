 <div class="x_content" style="width: 100%">
                    <button type="button" class="btn btn-primary" id="add"><i class="fa fa-plus"></i> Add</button>
                    <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>NIP</th>
                          <th>Nama Dosen</th>
                          <th>Kode Dosen</th>
                          <th></th>                        
                        </tr>
                      </thead>

                      <tbody>
                      <?php $no=1; foreach($dosen as $dsn){ ?>
                        <tr>
                          <td><?=$no?></td>
                          <td><?=$dsn['dosen_nip']?></td>
                          <td><?=$dsn['dosen_name']?></td>
                          <td><?=$dsn['dosen_kode']?></td>
                          <td style="text-align: center"><input type="hidden" class='id-dos' value="<?=$dsn['dosen_id']?>"><a href="#" class="edit-dos"><i class="fa fa-pencil-square-o"></i></a> | <a href="#" class="delete-dos"><i class="fa fa-trash-o"></i></a>
                          </td>
                        </tr>
                      <?php $no++; } ?>
                      </tbody>
                    </table>
                  </div>