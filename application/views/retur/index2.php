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
						<div class="col-lg-6">
							<div class="panel panel-default">
								<div class="panel-heading">
								
									
								</div>
								<div class="panel-body">
									<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="detailTable">
											<thead>
												<tr>
													<th>Options</th>
													<th>#</th>
													<th>KD keluar</th>
													<th>Tanggal Keluar</th>
													<th>Toko</th>
												</tr>
											</thead>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-6">
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
													<th>Options</th>
													<th>#</th>
													<th>KD keluar</th>
													<th>Tanggal Keluar</th>
													<th>Toko</th>
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
					{
						data: "id_pengiriman_detail", render: function(data, type, full, meta){
							var str = '';
							str += '<div class="btn-group">';
							str += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
							str += '<ul class="dropdown-menu">';
							str += '<li><a onClick="DeleteData(' + data + ')"><i class="fa fa-trash"></i> Delete</a></li>';
							str += '</ul>';
							str += '</div>';
							return str;
						}
					},
					
					{ data: "id_pengiriman_detail" },
					{ data: "kd_keluar" },
					{ data: "tgl_keluar" },
					{ data: "nm_toko" },
					
					
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
							detailTable.ajax.reload();
							alertify.error('pengiriman data deleted.');
						});
					},
					function(){ }
				);
			}

			function PilihData(id_keluar){

					var url = '<?=base_url()?>pengiriman/ax_set_details/';
					var data = {
						id_keluar: id_keluar,
						id_pengiriman: <?= $id_pengiriman ?>,
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						
						alertify.success("Data Berhasil di tambah");
							buTable.ajax.reload();
							detailTable.ajax.reload();
					});
			}

			function kembali(){
                window.location.href="<?=base_url();?>pengiriman";
            }

		</script>
	</body>
</html>
