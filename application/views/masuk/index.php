<!DOCTYPE html>
<html>
	<head>
		<?= $this->load->view('head'); ?>
	</head>
	<body class="sidebar-mini wysihtml5-supported <?= $this->config->item('color')?>">
		<div class="wrapper">
			<?= $this->load->view('nav'); ?>
			<?= $this->load->view('menu_groups'); ?>
			<div class="content-wrapper">
				<section class="content-header">
					<h1>Barang Masuk</h1>
				</section>
				<section class="invoice">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<button class="btn btn-primary" onclick='ViewData(0)'>
										<i class='fa fa-plus'></i> Buat Dokumen Masuk
									</button>
									<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="Form-add-bu" id="addModalLabel">Form Add masuk</h4>
												</div>
												<div class="modal-body">
													<input type="hidden" id="id_masuk" name="id_masuk" value='' />

													<div class="form-group">
														<label>KD Masuk</label>
														<input type="text" id="kd_masuk" name="kd_masuk" class="form-control" placeholder="Name">
													</div>

													<div class="form-group">
														<label>Tanggal Masuk</label>
														<input type="text" id="tgl_masuk" name="tgl_masuk" class="form-control" placeholder="Tanggal Masuk">
													</div>

													<div class="form-group ">
														<label>Supplier</label>
														<select class="form-control select2 " style="width: 100%;" id="id_supplier" name="id_supplier">
																<option value="0">--Supplier--</option>
																<?php
																foreach ($combobox_supplier->result() as $rowmenu) {
																?>
																<option value="<?= $rowmenu->id_supplier?>"  ><?= $rowmenu->nm_supplier?></option>
																<?php
																}
																?>
														</select>
													</div>
													

													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<button type="button" class="btn btn-primary" id='btnSave'>Save</button>
												</div>
											</div>
										</div>
									</div>
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
													<th>KD Masuk</th>
													<th>Tanggal Masuk</th>
													<th>Supplier</th>
													<th>Jumlah</th>
													<th>Status</th>
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
					url: "<?= base_url()?>masuk/ax_data_masuk/",
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
						data: "id_masuk", render: function(data, type, full, meta){
							var str = '';
							str += '<div class="btn-group">';
							str += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
							str += '<ul class="dropdown-menu">';
							if(full['active'] == 1){
							str += '<li><a href="<?= base_url()?>masuk/details/'+data+'"><i class="fa fa-list"></i> Details</a></li>';
							str += '<li><a onclick="AppData(' + data + ','+full['jml']+')"><i class="fa fa-check"></i> Approve</a></li>';
							str += '<li><a onclick="ViewData(' + data + ')"><i class="fa fa-pencil"></i> Edit</a></li>';
							str += '<li><a onClick="DeleteData(' + data + ')"><i class="fa fa-trash"></i> Delete</a></li>';
							str += '<li><a onClick="CetakData(' + data + ')"><i class="fa fa-print"></i> Cetak</a></li>';
							}else{
							str += '<li><a href="<?= base_url()?>masuk/lists/'+data+'"><i class="fa fa-list"></i> Details</a></li>';
							str += '<li><a onClick="CetakData(' + data + ')"><i class="fa fa-print"></i> Cetak</a></li>';
							}
							
							
							str += '</ul>';
							str += '</div>';
							return str;
						}
					},
					
					{ data: "id_masuk" },
					{ data: "kd_masuk" },
					{ data: "tgl_masuk" },
					{ data: "nm_supplier" },
					{ data: "jml", render: function(data, type, full, meta){
						var str = '';
							str += '<small class="label label-success">'+data+'</small>';
							return str;
						}
					},
					{ data: "active", render: function(data, type, full, meta){
							if(data == 1)
							{
								return "Draft";
							}
							else if (data == 2) 
							{
								return "Approved";
							}
						}
					}
				]
			});
			
			$('#btnSave').on('click', function () {
				if($('#kd_masuk').val() == '')
				{
					alertify.alert("Warning", "Please fill bu Name.");
				}
				else
				{
					var url = '<?=base_url()?>masuk/ax_set_data';
					var data = {
						id_masuk: $('#id_masuk').val(),
						id_supplier: $('#id_supplier').val(),
						kd_masuk: $('#kd_masuk').val(),
						tgl_masuk: $('#tgl_masuk').val(),
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						if(data['status'] == "success")
						{
							alertify.success("masuk data saved.");
							$('#addModal').modal('hide');
							buTable.ajax.reload();
						}
					});
				}
			});
			
			function ViewData(id_masuk)
			{
				if(id_masuk == 0)
				{
					$('#addModalLabel').html('Add masuk');
					$('#id_masuk').val('0');
					$('#kd_masuk').val('');
					$('#tgl_masuk').val('');
					$('#select2-id_supplier-container').html('---Supplier--');
					$('#id_supplier').val('0');
					$('#addModal').modal('show');
				}
				else
				{
					var url = '<?=base_url()?>masuk/ax_get_data_by_id';
					var data = {
						id_masuk: id_masuk
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						$('#addModalLabel').html('Edit masuk');
						$('#id_masuk').val(data['id_masuk']);
						$('#kd_masuk').val(data['kd_masuk']);
						$('#tgl_masuk').val(data['tgl_masuk']);
						$('#select2-id_supplier-container').html(data['nm_supplier']);
						$('#id_supplier').val(data['id_supplier']);
						$('#addModal').modal('show');
					});
				}
			}

			function AppData(id_masuk, jml)
			{
				if(jml == 0)
				{
					alertify.alert("Warning", "Please fill Item.");
				}
				else
				{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>masuk/ax_app_data';
						var data = {
							id_masuk: id_masuk
						};
								
						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							buTable.ajax.reload();
							alertify.success('masuk data Approved.');
						});
					},
					function(){ }
				);
			}
			}
			
			function DeleteData(id_masuk)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>masuk/ax_unset_data';
						var data = {
							id_masuk: id_masuk
						};
								
						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							buTable.ajax.reload();
							alertify.error('masuk data deleted.');
						});
					},
					function(){ }
				);
			}

			function CetakData(id_masuk)
			{
				url = "<?=base_url()?>masuk/cetakDataMasuk/";
				window.open(url + "?id_masuk=" + id_masuk, '_blank' );
				window.focus();
			};
			


			$( "#tgl_masuk").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd"
			});
			$( "#tgl_masuk" ).inputmask("yyyy-mm-dd",{"placeholder": "yyyy-mm-dd"});
			$("#filter").on("change", function(){ 
				buTable.ajax.reload();
			 });
		</script>
	</body>
</html>
