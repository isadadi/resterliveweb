<!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>

            <div class="row" style="min-height: 580px">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Data Dosen</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div id="ajax">
                  <div class="x_content">
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
                  </div>
                  <div class="modal fade bs-modal-lg-tambah" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Tambah Data Dosen</h4>
                        </div>
                        <form class="form-horizontal form-label-left" id='form-ini' action="<?=base_url('dosen/tambah')?>" method="POST">
                          <div class="modal-body">
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dosen-nip">NIP
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="dosen-nip" class="form-control col-md-7 col-xs-12" name="dosen_nip">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dosen-name">Nama Dosen <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="dosen-name" required="required" class="form-control col-md-7 col-xs-12" name="dosen_name">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dosen-kode">Kode Dosen <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="dosen-kode" required="required" class="form-control col-md-7 col-xs-12" name="dosen_kode">
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


                   <div class="modal fade bs-modal-lg-edit" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Data Dosen</h4>
                        </div>
                        <form class="form-horizontal form-label-left" id="form-ini2" action="<?=base_url('dosen/edit')?>" method="POST">
                        <input type="hidden" name="id" id="dosen-id2">
                          <div class="modal-body">
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dosen-nip">NIP
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="dosen-nip2" class="form-control col-md-7 col-xs-12" name="dosen_nip">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dosen-name">Nama Dosen <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="dosen-name2" required="required" class="form-control col-md-7 col-xs-12" name="dosen_name">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="dosen-kode">Kode Dosen <span class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="dosen-kode2" required="required" class="form-control col-md-7 col-xs-12" name="dosen_kode">
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


                    <div class="modal fade bs-modal-lg-delete" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Hapus Data Dosen</h4>                        
                        </div>                        
                          <form  id="form-ini3" action="<?=base_url('dosen/hapus')?>" method="POST">
                            <p style="margin-left: 20px">Apakah Anda Yakin Ingin Menghapus Data?</p>
                            <input type="hidden" class="id-dos3" name="id" value="">
                          <div class="modal-footer">
                            <button type="button"  class="btn btn-default" data-dismiss="modal">Tidak</button>
                            <button type="submit" name="submit" class="btn btn-primary">Ya</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

    <!-- jQuery -->
    <script src="<?=base_url("assets/vendors/jquery/dist/jquery.min.js")?>"></script>
    <!-- Bootstrap -->
    <script src="<?=base_url("assets/vendors/bootstrap/dist/js/bootstrap.min.js")?>"></script>
    <!-- FastClick -->
    <script src="<?=base_url("assets/vendors/fastclick/lib/fastclick.js")?>"></script>
    <!-- NProgress -->
    <script src="<?=base_url("assets/vendors/nprogress/nprogress.js")?>"></script>

    <!-- Datatables -->
    <script src="<?=base_url("assets/vendors/datatables.net/js/jquery.dataTables.min.js")?>"></script>
    <script src="<?=base_url("assets/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js")?>"></script>
    <script src="<?=base_url("assets/vendors/datatables.net-buttons/js/dataTables.buttons.min.js")?>"></script>
    <script src="<?=base_url("assets/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js")?>"></script>
    <script src="<?=base_url("assets/vendors/datatables.net-buttons/js/buttons.flash.min.js")?>"></script>
    <script src="<?=base_url("assets/vendors/datatables.net-buttons/js/buttons.html5.min.js")?>"></script>
    <script src="<?=base_url("assets/vendors/datatables.net-buttons/js/buttons.print.min.js")?>"></script>
    <script src="<?=base_url("assets/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js")?>"></script>
    <script src="<?=base_url("assets/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js")?>"></script>
    <script src="<?=base_url("assets/vendors/datatables.net-responsive/js/dataTables.responsive.min.js")?>"></script>
    <script src="<?=base_url("assets/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js")?>"></script>
    <script src="<?=base_url("assets/vendors/datatables.net-scroller/js/datatables.scroller.min.js")?>"></script>
    <script src="<?=base_url("assets/vendors/jszip/dist/jszip.min.js")?>"></script>
    <script src="<?=base_url("assets/vendors/pdfmake/build/pdfmake.min.js")?>"></script>
    <script src="<?=base_url("assets/vendors/pdfmake/build/vfs_fonts.js")?>"></script>
    
    <!-- Custom Theme Scripts -->
    <script src="<?=base_url("assets/build/js/custom.min.js")?>"></script>

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();

        $('#datatable-keytable').DataTable({
          keys: true
        });

        $('#datatable-responsive').DataTable();

        $('#datatable-scroller').DataTable({
          ajax: "js/datatables/json/scroller-demo.json",
          deferRender: true,
          scrollY: 380,
          scrollCollapse: true,
          scroller: true
        });

        $('#datatable-fixed-header').DataTable({
          fixedHeader: true
        });

        var $datatable = $('#datatable-checkbox');

        $datatable.dataTable({
          'order': [[ 1, 'asc' ]],
          'columnDefs': [
            { orderable: false, targets: [0] }
          ]
        });
        $datatable.on('draw.dt', function() {
          $('input').iCheck({
            checkboxClass: 'icheckbox_flat-green'
          });
        });

        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->