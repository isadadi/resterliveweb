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
	$('#add-tanggal').on('click',function(){
		$(".bs-modal-lg-tambah2").modal("show");
	});

	$('.add-jadwal').on('click',function($e){
		$e.preventDefault();
		var ruang = $(this).find('.ruang').val();
          var hari = $(this).find('.hari').val();
          var jam = $(this).find('.jam').val();    
          var id_tgl = $(this).find('.id_tgl').val();    
          $('#ruangan1').prop("value",ruang);
          $('#jam1').prop("value",jam);
          $("#hari1").prop("value",hari);     
          $('#id_tgl').val(id_tgl);
		$(".bs-modal-lg-tambah").modal("toggle");
	})

	$('#minus').on('click',function(){
		var id = $('select[name=tgl_ujian]').val();
		$('.id-tgl4').val(id);
		$(".bs-modal-lg-kurang").modal("show");
	});


	$('.hapus-semua').on('click',function(){
		var id = $('select[name=tgl_ujian]').val();
		$('.id-tgl5').val(id);
          $('.bs-modal-lg-delete-all').modal("show");
       });


	$('#pilih_tanggal').on('change',function(){
		var id = $(this).val();
		$('#ajax').load("<?=base_url('ujian/ajax_jadwal/')?>"+id);
	});


	$('.edit-jadwal').on('click',function($e){
		$e.preventDefault();		
          var id_jadwal = $(this).find('.id_jadwal').val();
          $.post("<?=base_url('ujian/get_jadwal/')?>"+id_jadwal,function(data){

            
            $("#hari2").prop("value",data['jad_uj_tanggal']);     
            $("#matkul2").val(data['mat_kul_id']);     
            $('.select_matkul').select2({width: "415"}).change();            
             $('#kelas2').val(data['jad_uj_kom']);

            $('#id_jadwal2').val(data['jad_uj_id']);
            $('.bs-modal-lg-edit').modal("toggle");
          });         
	});


	 $('.delete-jadwal').on('click',function($e){
          $e.preventDefault();
          var id_jadwal = $(this).find('.id_jadwal').val();          
          $('.id_jadwal3').val(id_jadwal);          
               $('.bs-modal-lg-delete').modal("toggle");
       });

	$('#form-ini').ajaxForm({
         success:  function(data){       
            $('.bs-modal-lg-tambah').modal("toggle");
            if(data==1)
                untuk_notif(data,'Data Berhasil Ditambah');
            else
                untuk_notif(data,'Data Gagal Ditambah');

            var id = $('select[name=tgl_ujian]').val();
          $("#ajax").load("<?=base_url('ujian/ajax_jadwal/')?>"+id);
         }
      });

	 $('#form-ini3').ajaxForm({
      success: function(data){
        $('.bs-modal-lg-delete').modal("toggle");
         if(data==1)
                untuk_notif(data,'Data Berhasil Dihapus');
            else
                untuk_notif(data,'Data Gagal Dihapus');
         var id = $('select[name=tgl_ujian]').val();
          $("#ajax").load("<?=base_url('ujian/ajax_jadwal/')?>"+id);
      }
    });


	$('#form-ini2').ajaxForm({
        success:  function(data){       
          $('.bs-modal-lg-edit').modal("toggle");
          if(data==1)
                untuk_notif(data,'Data Berhasil Diubah');
            else
                untuk_notif(data,'Data Gagal Diubah');

         var id = $('select[name=tgl_ujian]').val();
          $("#ajax").load("<?=base_url('ujian/ajax_jadwal/')?>"+id);
         }
      });



	$('#form-ini4').ajaxForm({
    		 success:  function(data){       
       			$('.bs-modal-lg-tambah2').modal("toggle");
			    if(data==1)
                untuk_notif(data,'Data Berhasil Ditambah');
            else
                untuk_notif(data,'Data Gagal Ditambah');
			     $("#ajax_tgl").load("<?=base_url('ujian/ajax_tanggal')?>");
		     }
    	});


	$('#form-ini5').ajaxForm({
    		 success:  function(data){       
       			$('.bs-modal-lg-kurang').modal("toggle");
			     if(data==1)
                untuk_notif(data,'Data Berhasil Dihapus');
            else
                untuk_notif(data,'Data Gagal Dihapus');
			     $("#ajax_tgl").load("<?=base_url('ujian/ajax_tanggal')?>");
			     var id = $('select[name=tgl_ujian]').val();
          		$("#ajax").empty();
		     }
    	});

	$('#form-ini6').ajaxForm({
    		 success:  function(data){       
       			$('.bs-modal-lg-delete-all').modal("toggle");
			     if(data==1)
                untuk_notif(data,'Data Berhasil Dihapus');
            else
                untuk_notif(data,'Data Gagal Dihapus');
			     $("#ajax_tgl").load("<?=base_url('ujian/ajax_tanggal')?>");
			     var id = $('select[name=tgl_ujian]').val();
          		$("#ajax").empty();
		     }
    	});

</script>

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