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

	$('.edit-dos').on('click',function(){
		var id = $(this).parent().find('.id-dos').val();    	
    	$.post("<?=base_url('dosen/get_dosen/')?>"+id,function(data){    		
    		$('#dosen-nip2').prop("value",data['dosen_nip']);
    		$('#dosen-name2').prop("value",data['dosen_name']);
    		$('#dosen-kode2').prop("value",data['dosen_kode']);
    		$('#dosen-id2').prop("value",data['dosen_id']);
    		$('.bs-modal-lg-edit').modal("toggle");
    	});
    	
	});

	$('.delete-dos').on('click',function(){
		var id = $(this).parent().find('.id-dos').val(); 
		$('.id-dos3').prop("value",id);   	
		$('.bs-modal-lg-delete').modal("toggle");
	})


	$('#form-ini').ajaxForm({
    		 success:  function(data){       
       			$('.bs-modal-lg-tambah').modal("toggle");
			     untuk_notif(data,'Data Berhasil Ditambah');
			     $("#ajax").load("<?=base_url('dosen/ajax_dosen')?>");
		     }
    	});

	$('#form-ini2').ajaxForm({
    		success:  function(data){       
       		$('.bs-modal-lg-edit').modal("toggle");
  		    untuk_notif(data,'Data Berhasil Diubah');
		     $("#ajax").load("<?=base_url('dosen/ajax_dosen')?>");
		     }
    	});

	 $('#form-ini3').ajaxForm({
    	success: function(data){
    		$('.bs-modal-lg-delete').modal("toggle");
		      untuk_notif(data,'Data Berhasil Dihapus');
    		$("#ajax").load("<?=base_url('dosen/ajax_dosen')?>");
    	}
    });


</script>

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