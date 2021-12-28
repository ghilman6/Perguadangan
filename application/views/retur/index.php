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
					<h1>Retur</h1>
				</section>
				<section class="invoice">
					<div class="row">
						<div class="col-lg-6">
							<div class="panel panel-default">
								<div class="panel-heading">
								List Pengiriman Detail
								</div>
								<div class="panel-body">
								<div class="form-group">
														<label>Tanggal Pengiriman</label>
														<input type="text" id="tgl_pengiriman" name="tgl_pengiriman" class="form-control" placeholder="Tanggal Pengiriman">
													</div>
									<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="detailTable">
											<thead>
												<tr>
													
													<th>Options</th>
													<th>#</th>
													<th>KD Pengiriman</th>
													<th>KD Keluar</th>
													<th>Tanggal keluar</th>
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
								
								 List Retur
								</div>
								<div class="panel-body">
								<div class="form-group">
														<select class="form-control" id="filter" name="filter">
															<option value="1" >Draft</option>
															<option value="2" >Approved</option>
														</select>
													</div>
									<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="buTable">
											<thead>
												<tr>
													<th>Options</th>
													<th>#</th>
													<th>KD Retur</th>
													<th>KD Keluar</th>
													<th>Tanggal Pengiriman</th>
													<th>Toko</th>
													<th>Jml</th>
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
				dom: 'Bfrtip',
				buttons: 	[
					'copy', 'csv', 'excel', 'pdf', 'print'
				],
				ajax: 
				{
					url: "<?= base_url()?>retur/ax_data_retur/",
					type: 'POST',
					data: function ( d ) {
			         return $.extend({}, d, { 
			         	
						"active": $("#filter").val()

			         });
			     	}
				},
				columns: 
				[
					{
						data: "id_retur", render: function(data, type, full, meta){
							var str = '';
							str += '<div class="btn-group">';
							str += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
							str += '<ul class="dropdown-menu">';
							str += '<li><a href="<?= base_url()?>retur/details/'+data+'/'+full['id_keluar']+'"><i class="fa fa-list"></i> Details</a></li>';
							str += '<li><a onclick="AppData(' + data + ','+full['jml']+')"><i class="fa fa-check"></i> Approve</a></li>';
							str += '<li><a onClick="DeleteData(' + data + ')"><i class="fa fa-trash"></i> Delete</a></li>';
							str += '</ul>';
							str += '</div>';
							return str;
						}
					},
					
					{ data: "id_retur" },
					{ data: "kd_retur" },
					{ data: "kd_keluar" },
					{ data: "tgl_pengiriman" },
					{ data: "nm_toko" },
					{ data: "jml", render: function(data, type, full, meta){
						var str = '';
							str += '<small class="label label-success">'+data+'</small>';
							return str;
						}
					},
					
					
				]
			});

			var detailTable = $('#detailTable').DataTable({
				"ordering" : false,
				"scrollX": true,
				"processing": true,
				"serverSide": true,
				ajax: 
				{
					url: "<?= base_url()?>retur/ax_data_pengirimandetail/",
					type: 'POST',
					data: function ( d ) {
			         return $.extend({}, d, { 
			         	
						"tgl_pengiriman": $("#tgl_pengiriman").val()//filter data table pengiriman details

			         });
			     	} 
				},
				columns: 
				[
					{
						data: "id_pengiriman_detail", render: function(data, type, full, meta){
							var str = '';
							str += '<div class="btn-group">';
							str += '<button type="button" class="btn btn-primary" onclick="PilihData(' + data + ')">Pilih</button>';
					
							str += '</div>';
							return str;
						}
					},
					
					{ data: "id_pengiriman_detail" },
					{ data: "kd_pengiriman" },
					{ data: "kd_keluar" },
					{ data: "tgl_pengiriman" },
					{ data: "nm_toko" },
					
					
				]
			});
			
			
			function DeleteData(id_retur)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>retur/ax_unset_data';
						var data = {
							id_retur: id_retur
						};
								
						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							buTable.ajax.reload();
							detailTable.ajax.reload();
							alertify.error('retur data deleted.');
						});
					},
					function(){ }
				);
			}

			function PilihData(id_pengiriman_detail){

					var url = '<?=base_url()?>retur/ax_set_data/';
					var data = {
						id_pengiriman_detail: id_pengiriman_detail
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
							detailTable.ajax.reload();

						}
					
					});
			}

			function AppData(id_retur, jml)
			{
				if(jml == 0)
				{
					alertify.alert("Warning", "Please fill Retur.");
				}
				else
				{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to Approve this data?', 
					function(){
						var url = '<?=base_url()?>retur/ax_app_data';
						var data = {
							id_retur: id_retur
						};
								
						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							buTable.ajax.reload();
							alertify.success('Keluar data Approved.');
						});
					},
					function(){ }
				);
				}
			}
			
			$(document).ready(function() {
	
	
			$("#harga, #qty").keydown(function (e) {
							
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
								
				(e.keyCode == 65 && e.ctrlKey === true) ||
								
				(e.keyCode == 67 && e.ctrlKey === true) ||
								
				(e.keyCode == 88 && e.ctrlKey === true) ||
								
				(e.keyCode >= 35 && e.keyCode <= 39)) {
								
				return;
				}
							
				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
				}
			});
		});

			$(document).on('keydown', 'body', function(e){
			var charCode = ( e.which ) ? e.which : event.keyCode;

			if(charCode == 112) //F1
			{
				Savedata();
				return false;
			}

			
			});

			$( "#tgl_pengiriman").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd"
			});
			$( "#tgl_pengiriman" ).inputmask("yyyy-mm-dd",{"placeholder": "yyyy-mm-dd"});

			$("#filter").on("change", function(){ 
				buTable.ajax.reload();
			});

			$("#tgl_pengiriman").on("change", function(){ 
				detailTable.ajax.reload();
			});

		</script>
	</body>
</html>
