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
					<h1>Barang opname</h1>
				</section>
				<section class="invoice">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<button class="btn btn-primary" onclick='ViewData(0)'>
										<i class='fa fa-plus'></i> Buat Dokumen opname
									</button>
									<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="Form-add-bu" id="addModalLabel">Form Add opname</h4>
												</div>
												<div class="modal-body">
													<input type="hidden" id="id_opname" name="id_opname" value='' />

													

													<div class="form-group">
														<label>Tanggal opname</label>
														<input type="text" id="tgl_opname" name="tgl_opname" class="form-control" placeholder="Tanggal opname">
													</div>

													<div class="form-group ">
														<label>Toko</label>
														<select class="form-control select2 " style="width: 100%;" id="id_toko" name="id_toko">
																<option value="0">--Toko--</option>
																<?php
																foreach ($combobox_toko->result() as $rowmenu) {
																?>
																<option value="<?= $rowmenu->id_toko?>"  ><?= $rowmenu->nm_toko?></option>
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
													<th>KD opname</th>
													<th>Tanggal opname</th>
													<th>Toko</th>
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
					url: "<?= base_url()?>opname/ax_data_opname/",
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
						data: "id_opname", render: function(data, type, full, meta){
							var str = '';
							str += '<div class="btn-group">';
							str += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
							str += '<ul class="dropdown-menu">';
							if(full['active'] == 1){
							str += '<li><a href="<?= base_url()?>opname/details/'+data+'"><i class="fa fa-list"></i> Details</a></li>';
							str += '<li><a onClick="AppData(' + data + ', '+ full['jml']+')"><i class="fa fa-check"></i> Approve</a></li>';
							str += '<li><a onclick="ViewData(' + data + ')"><i class="fa fa-pencil"></i> Edit</a></li>';
							str += '<li><a onClick="DeleteData(' + data + ')"><i class="fa fa-trash"></i> Delete</a></li>';
							}else{
							str += '<li><a href="<?= base_url()?>opname/lists/'+data+'"><i class="fa fa-list"></i> Details</a></li>';
								
							}
							str += '</ul>';
							str += '</div>';
							return str;
						}
					},
					
					{ data: "id_opname" },
					{ data: "kd_opname" },
					{ data: "tgl_opname" },
					{ data: "nm_toko" },
					
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
				if($('#kd_opname').val() == '')
				{
					alertify.alert("Warning", "Please fill Name.");
				}
				else
				{
					var url = '<?=base_url()?>opname/ax_set_data';
					var data = {
						id_opname: $('#id_opname').val(),
						id_toko: $('#id_toko').val(),
					
						tgl_opname: $('#tgl_opname').val(),
						
						active: 1
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						if(data['status'] == "success")
						{
							alertify.success("opname data saved.");
							$('#addModal').modal('hide');
							buTable.ajax.reload();
						}
					});
				}
			});
			
			function ViewData(id_opname)
			{
				if(id_opname == 0)
				{
					$('#addModalLabel').html('Add opname');
					$('#id_opname').val('0');
				
					$('#tgl_opname').val('');
					$('#select2-id_toko-container').html('---Toko--');
					$('#id_toko').val('0');
					$('#addModal').modal('show');
				}
				else
				{
					var url = '<?=base_url()?>opname/ax_get_data_by_id';
					var data = {
						id_opname: id_opname
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						$('#addModalLabel').html('Edit opname');
						$('#id_opname').val(data['id_opname']);
					
						$('#tgl_opname').val(data['tgl_opname']);
						$('#select2-id_toko-container').html(data['nm_toko']);
						$('#id_toko').val(data['id_toko']);
						$('#addModal').modal('show');
					});
				}
			}
			
			function DeleteData(id_opname)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>opname/ax_unset_data';
						var data = {
							id_opname: id_opname
						};
								
						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							buTable.ajax.reload();
							alertify.error('opname data deleted.');
						});
					},
					function(){ }
				);
			}

			function AppData(id_opname, jml)
			{
				if(jml == 0)
				{
					alertify.alert("Warning", "Please fill Item.");
				}
				else
				{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to Approve this data?', 
					function(){
						var url = '<?=base_url()?>opname/ax_app_data';
						var data = {
							id_opname: id_opname
						};
								
						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							buTable.ajax.reload();
							alertify.success('opname data Approved.');
						});
					},
					function(){ }
				);
				}
			}


			$( "#tgl_opname").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd"
			});
			$( "#tgl_opname" ).inputmask("yyyy-mm-dd",{"placeholder": "yyyy-mm-dd"});
			$("#filter").on("change", function(){ 
				buTable.ajax.reload();
			 });

		</script>
	</body>
</html>
