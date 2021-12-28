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
					<h1>Pengiriman</h1>
				</section>
				<section class="invoice">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<button class="btn btn-primary" onclick='ViewData(0)'>
										<i class='fa fa-plus'></i> Add Pengiriman
									</button>
									<div class="modal fade" id="addModal" tabindex="" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="Form-add-bu" id="addModalLabel">Form Add Pengiriman</h4>
												</div>
												<div class="modal-body">
													<input type="hidden" id="id_pengiriman" name="id_pengiriman" value='' />

													

													<div class="form-group">
														<label>Tanggal Pengiriman</label>
														<input type="text" id="tgl_pengiriman" name="tgl_pengiriman" class="form-control" placeholder="Tanggal Pengriman">
													</div>

													

													<div class="form-group ">
														<label>Armada</label>
														<select class="form-control select2 " style="width: 100%;" id="id_armada" name="id_armada">
																<option value="0">--Armada--</option>
																<?php
																foreach ($combobox_armada->result() as $rowmenu) {
																?>
																<option value="<?= $rowmenu->id_armada?>"  ><?= $rowmenu->kd_armada?></option>
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
													<th>KD Pengiriman</th>
													<th>KD Armada</th>
													<th>Jenis</th>
													<th>Tanggal Pengiriman</th>
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
				ajax: 
				{
					url: "<?= base_url()?>pengiriman/ax_data_pengiriman/",
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
						data: "id_pengiriman", render: function(data, type, full, meta){
							var str = '';
							str += '<div class="btn-group">';
							str += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
							str += '<ul class="dropdown-menu">';
							if(full['active'] == 1){
							str += '<li><a href="<?= base_url()?>pengiriman/details/'+data+'"><i class="fa fa-list"></i> Details</a></li>';
							str += '<li><a onclick="AppData(' + data + ','+full['jml']+')"><i class="fa fa-check"></i> Approve</a></li>';
							str += '<li><a onclick="ViewData(' + data + ')"><i class="fa fa-pencil"></i> Edit</a></li>';
							str += '<li><a onClick="DeleteData(' + data + ')"><i class="fa fa-trash"></i> Delete</a></li>';
							}else{
							str += '<li><a href="<?= base_url()?>pengiriman/lists/'+data+'"><i class="fa fa-list"></i> Details</a></li>';	
							}
							str += '</ul>';
							str += '</div>';
							return str;
						}
					},
					
					{ data: "id_pengiriman" },
					{ data: "kd_pengiriman" },
					{ data: "kd_armada" },
					{ data: "nm_armada_jenis" },
					{ data: "tgl_pengiriman" },
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
				if($('#id_pengiriman').val() == '')
				{
					alertify.alert("Warning", "Please fill Name.");
				}
				else
				{
					var url = '<?=base_url()?>pengiriman/ax_set_data';
					var data = {
						id_pengiriman: $('#id_pengiriman').val(),
						tgl_pengiriman: $('#tgl_pengiriman').val(),
						id_armada: $('#id_armada').val(),
						active: 1,
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						if(data['status'] == "success")
						{
							alertify.success("Pengiriman data saved.");
							$('#addModal').modal('hide');
							buTable.ajax.reload();
						}
					});
				}
			});
			
			function ViewData(id_pengiriman)
			{
				if(id_pengiriman == 0)
				{
					$('#addModalLabel').html('Add Pengiriman');
					$('#id_pengiriman').val('0');
					$('#tgl_pengiriman').val('');
				
					$('#select2-id_armada-container').html('---Armada--');
					$('#id_armada').val('0');
					$('#addModal').modal('show');
				}
				else
				{
					var url = '<?=base_url()?>pengiriman/ax_get_data_by_id';
					var data = {
						id_pengiriman: id_pengiriman
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						$('#addModalLabel').html('Edit pengiriman');
						$('#id_pengiriman').val(data['id_pengiriman']);
						$('#tgl_pengiriman').val(data['tgl_pengiriman']);
						
						$('#select2-id_armada-container').html(data['kd_armada']);
						$('#id_armada').val(data['id_armada']);
						$('#addModal').modal('show');
					});
				}
			}
			
			function DeleteData(id_pengiriman)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>pengiriman/ax_unset_data';
						var data = {
							id_pengiriman: id_pengiriman
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

			function AppData(id_pengiriman, jml)
			{
				if(jml == 0)
				{
					alertify.alert("Warning", "Please fill ID Keluar.");
				}
				else
				{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to Approve this data?', 
					function(){
						var url = '<?=base_url()?>pengiriman/ax_app_data';
						var data = {
							id_pengiriman: id_pengiriman
						};
								
						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							buTable.ajax.reload();
							alertify.success('pengiriman data Approved.');
						});
					},
					function(){ }
				);
			}
			}

			$( "#tgl_pengiriman").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd"
			});
			$( "#tgl_pengiriman" ).inputmask("yyyy-mm-dd",{"placeholder": "yyyy-mm-dd"});
			$("#filter").on("change", function(){ 
				buTable.ajax.reload();
			 });
		</script>
	</body>
</html>
