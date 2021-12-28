<!DOCTYPE html>
<html>
	<head>
		<?= $this->load->view('head'); ?>
	</head>
	<body class="sidebar-mini wysihtml5-supported sidebar-collapse <?= $this->config->item('color')?>">
		<div class="wrapper">
			<?= $this->load->view('nav'); ?>
			<?= $this->load->view('menu_groups'); ?>
			<div class="content-wrapper">
				<section class="content-header">
					<h1>Pengiriman Detail #<?= $id_pengiriman?></h1>
				</section>
				<section class="invoice">
					<div class="row">
						

						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
								<button type="button" class="btn btn-primary" onclick="kembali()"><i class='fa fa-arrow-left'></i> Kembali</button>
								 List Pengiriman Details
								

													
													
								
									
								</div>
								<div class="panel-body">
									<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="buTable">
											<thead>
												<tr>
													<th>#</th>
													<th>KD Keluar</th>
													<th>Toko</th>
													<th>Tanggal Keluar</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<?= $this->load->view('basic_js'); ?>
		<script type='text/javascript'>
			var buTable = $('#buTable').DataTable({
				"ordering" : false,
				"scrollX": true,
				"processing": true,
				"serverSide": true,
				ajax: 
				{
					url: "<?= base_url()?>pengiriman/ax_data_pengiriman_detail/",
					type: 'POST',
					data: function ( d ) {
			         return $.extend({}, d, { 
			         	
			         	"id_pengiriman": <?= $id_pengiriman ?>,

			         });
			     	}
				},
				columns: 
				[
					
					
					{ data: "id_pengiriman_detail" },
					{ data: "kd_keluar" },
					{ data: "nm_toko" },
					{ data: "tgl_keluar" },
					
					
				]
			});

			var detailTable = $('#detailTable').DataTable({
				"ordering" : false,
				"scrollX": true,
				"processing": true,
				"serverSide": true,
				ajax: 
				{
					url: "<?= base_url()?>pengiriman/ax_data_keluar/",
					type: 'POST'
				},
				columns: 
				[
					{
						data: "id_keluar", render: function(data, type, full, meta){
							var str = '';
							str += '<div class="btn-group">';
							str += '<button type="button" class="btn btn-primary" onclick="PilihData(' + data + ')">Pilih</button>';
					
							str += '</div>';
							return str;
						}
					},
					
					{ data: "id_keluar" },
					{ data: "kd_keluar" },
					{ data: "tgl_keluar" },
					{ data: "nm_toko" },
					
					
				]
			});
			
			$('#btnSave').on('click', function () {
				Savedata();
			});

			function Savedata(){
				if($('#kd_keluar').val() == '')
				{
					alertify.alert("Warning", "Pilih Kode Keluar.");
				}
				else
				{
					var url = '<?=base_url()?>pengiriman/ax_set_details';
					var data = {
						id_pengiriman: <?= $id_pengiriman ?>,
						id_keluar: $('#id_keluar').val(),
						// tgl_keluar: $('#tgl_keluar').val(),
						id_toko: $('#id_toko').val(),
						status: $('#status').val(),
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						if(data['status'] == "success")
						{
							alertify.success("Data Berhasil di tambah");
							buTable.ajax.reload();
						}
					});
				}
			}
			
			
			function DeleteData(id_pengiriman_detail)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>pengiriman/ax_unset_detail';
						var data = {
							id_pengiriman_detail: id_pengiriman_detail
						};
								
						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							buTable.ajax.reload();
							alertify.error('pengiriman data deleted.');
						});
					},
					function(){ }
				);
			}

			function PilihData(id_keluar){

					var url = '<?=base_url()?>pengiriman/ax_get_keluar_by_id/';
					var data = {
						id_keluar: id_keluar
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						
						$('#kd_keluar').val(data['kd_keluar']);
						$('#tgl_keluar').val(data['tgl_keluar']);
						$('#id_keluar').val(data['id_keluar']);
					});
			}


			$( "#tgl_pengiriman").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd"
			});
			$( "#tgl_pengiriman" ).inputmask("yyyy-mm-dd",{"placeholder": "yyyy-mm-dd"});

			$(document).ready(function() {
	
	
			// $("#status").keydown(function (e) {			
			// 	if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
									
			// 		(e.keyCode == 65 && e.ctrlKey === true) ||
									
			// 		(e.keyCode == 67 && e.ctrlKey === true) ||
									
			// 		(e.keyCode == 88 && e.ctrlKey === true) ||
									
			// 		(e.keyCode >= 35 && e.keyCode <= 39)) {
									
			// 		return;
			// 		}
								
			// 		if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			// 		e.preventDefault();
			// 		}
			// });
		});

			$(document).on('keydown', 'body', function(e){
			var charCode = ( e.which ) ? e.which : event.keyCode;

			if(charCode == 112) //F1
			{
				Savedata();
				return false;
			}

			
			});

			function kembali(){
                window.location.href="<?=base_url();?>pengiriman";
            }

		</script>
	</body>
</html>
