   <script src="<?= base_url('assets/select2-wg/dist/js/select2.full.min.js') ?>"></script>
    <script type="text/javascript">


     function untuk_notif(jenis,pesan){
        if(jenis=='1'){
              new PNotify({
                                  title: 'Berhasil',
                                  text: pesan,
                                  type: 'success',
                                  styling: 'bootstrap3'
                              });
          }else{
             new PNotify({
                                  title: 'Gagal',
                                  text: pesan,
                                  type: 'error',
                                  styling: 'bootstrap3'
                              });

      }
    } 


      $('.add-jadwal').on('click',function($e){
          $e.preventDefault();
          var ruang = $(this).find('.ruang').val();
          var hari = $(this).find('.hari').val();
          var jam = $(this).find('.jam').val();    
          $('#ruangan1').prop("value",ruang);
          $('#jam1').prop("value",jam);
          $("#hari1").prop("value",hari);     
          $('.bs-modal-lg-tambah').modal("toggle");
      });


       $('.edit-jadwal').on('click',function($e){
          $e.preventDefault();
          var ruang = $(this).find('.ruang').val();
          var hari = $(this).find('.hari').val();
          var jam = $(this).find('.jam').val();  
          var id_jadwal = $(this).find('.id_jadwal').val();
          $.post("<?=base_url('jadwal/get_jadwal/')?>"+id_jadwal,function(data){

            $('#ruangan2').prop("value",ruang);
            $('#jam2').prop("value",jam);
            $("#hari2").prop("value",hari);     
            $("#matkul2").val(data['mat_kul_id']);     
            $('.select_matkul').select2({width: "415"}).change();
            $("#dosen2").val(data['dosen_id']);     
             $('.select_dosen').select2({width: "415"}).change();
             $('#kelas2').val(data['jad_kom']);
             $('#kelas_sebelum').val(data['jad_kom']);
             $('#matkul_sebelum').val(data['mat_kul_id']);
            $('.bs-modal-lg-edit').modal("toggle");
          });            
      });

       $('.show-jadwal').on('click',function($e){
          $e.preventDefault();
          var id_jadwal = $(this).find('.id_jadwal').val();
          $.post("<?=base_url('jadwal/show_jadwal/')?>"+id_jadwal,function(data){
              $('#s_matkul').empty();
              $('#s_dosen').empty();
              $('#s_semester').empty();
              $('#s_kelas').empty();
              $('#s_matkul').append(data['mat_kul_name']);
              $('#s_dosen').append(data['dosen_name']);
              $('#s_semester').append(data['mat_semester']);
              $('#s_kelas').append(data['jad_kom']);
               $('.bs-modal-lg-show').modal("toggle");
          });
       });

       $('.delete-jadwal').on('click',function($e){
          $e.preventDefault();
          var id_matkul = $(this).find('.id_matkul').val();
          var id_kelas = $(this).find('.id_kelas').val();
          $('.id-matkul').val(id_matkul);
          $('.id-kelas').val(id_kelas);
               $('.bs-modal-lg-delete').modal("toggle");
       });

       $('.hapus-semua').on('click',function(){
          $('.bs-modal-lg-delete-all').modal("toggle");
       });

      $('#form-ini').ajaxForm({
         success:  function(data){       
            $('.bs-modal-lg-tambah').modal("toggle");
            if(data==1)
                untuk_notif(data,'Data Berhasil Ditambah');
            else
                untuk_notif(data,'Data Gagal Ditambah');

          $("#ajax").load("<?=base_url('jadwal/ajax_jadwal')?>");
         }
      });

  $('#form-ini2').ajaxForm({
        success:  function(data){       
          $('.bs-modal-lg-edit').modal("toggle");
          if(data==1)
                untuk_notif(data,'Data Berhasil Diubah');
            else
                untuk_notif(data,'Data Gagal Diubah');

        $("#ajax").load("<?=base_url('jadwal/ajax_jadwal')?>");
         }
      });

   $('#form-ini3').ajaxForm({
      success: function(data){
        $('.bs-modal-lg-delete').modal("toggle");
         if(data==1)
                untuk_notif(data,'Data Berhasil Dihapus');
            else
                untuk_notif(data,'Data Gagal Dihapus');
        $("#ajax").load("<?=base_url('jadwal/ajax_jadwal')?>");
      }
    });

    $('#form-ini4').ajaxForm({
      success: function(data){
        $('.bs-modal-lg-delete-all').modal("toggle");
         if(data==1)
                untuk_notif(data,'Data Berhasil Dihapus');
            else
                untuk_notif(data,'Data Gagal Dihapus');
        $("#ajax").load("<?=base_url('jadwal/ajax_jadwal')?>");
      }
    });
    </script>
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

        $('#datatable').dataTable({

        });

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

    <!-- Select2 -->
    <script>
      $(document).ready(function() {       
        $(".select_matkul").select2({
          placeholder: "Pilih Mata Kuliah",  
          allowClear: true,       
          width: "415"
        });
        $(".select_dosen").select2({
          placeholder: "Pilih Dosen",
          allowClear: true,
          width: "415"
        });
      });
    </script>
    <!-- /Select2 -->