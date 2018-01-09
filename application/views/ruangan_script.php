
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


      $('#add').on('click',function(){
        $(".bs-modal-lg-tambah").modal("toggle");
      });

      $('.edit-ruang').on('click',function(){
         var id = $(this).parent().find('.id-ruang').val();      
          $.post("<?=base_url('ruangan/get_ruang/')?>"+id,function(data){       
          $('#id-ru2').prop("value",data['id_ruangan']);
          $('#nama-ruang2').prop("value",data['nama_ruangan']);
          $('.bs-modal-lg-edit').modal("toggle");
        });        
      });

     $('.delete-ruang').on('click',function(){
      var id = $(this).parent().find('.id-ruang').val();      
      $('.id-ru3').prop("value",id);
      $('.bs-modal-lg-delete').modal("toggle");

  });
       $('#form-ini').ajaxForm({
         success:  function(data){       
            $('.bs-modal-lg-tambah').modal("toggle");
            if(data==1)
                untuk_notif(data,'Data Berhasil Ditambah');
            else
                untuk_notif(data,'Data Gagal Ditambah');

          $("#ajax").load("<?=base_url('ruangan/ajax_ruangan')?>");
         }
      });

  $('#form-ini2').ajaxForm({
        success:  function(data){       
          $('.bs-modal-lg-edit').modal("toggle");
          if(data==1)
                untuk_notif(data,'Data Berhasil Diubah');
            else
                untuk_notif(data,'Data Gagal Diubah');

         $("#ajax").load("<?=base_url('ruangan/ajax_ruangan')?>");
         }
      });

   $('#form-ini3').ajaxForm({
      success: function(data){
        $('.bs-modal-lg-delete').modal("toggle");
         if(data==1)
                untuk_notif(data,'Data Berhasil Dihapus');
            else
                untuk_notif(data,'Data Gagal Dihapus');
        $("#ajax").load("<?=base_url('ruangan/ajax_ruangan')?>");
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