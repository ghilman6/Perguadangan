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
					<h1>Armada</h1>
				</section>
				<section class="invoice">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<button class="btn btn-primary" onclick='ViewData(0)'>
										<i class='fa fa-plus'></i> Add Armada
									</button>
									<div class="modal fade" id="addModal" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="Form-add-bu" id="addModalLabel">Form Add Armada</h4>
												</div>
												<div class="modal-body">
													<input type="hidden" id="id_armada" name="id_armada" value='' />

													<div class="form-group">
														<label>Kode Armada</label>
														<input type="text" id="kd_armada" name="kd_armada" class="form-control" placeholder="Kode Armada">
													</div>

													<div class="form-group">
														<label>Volume</label>
														<input type="text" id="volume" name="volume" class="form-control" placeholder="Volume">
													</div>

													<div class="form-group">
														<label>Berat</label>
														<input type="text" id="berat" name="volume" class="form-control" placeholder="Berat">
													</div>

												
													
													<div class="form-group ">
														<label>Jenis Armada</label>
														<select class="form-control select2 " style="width: 100%;" id="id_armada_jenis" name="id_armada_jenis">
																<option value="0">--Jenis--</option>
																<?php
																foreach ($combobox_armada_jenis->result() as $rowmenu) {
																?>
																<option value="<?= $rowmenu->id_armada_jenis?>"  ><?= $rowmenu->nm_armada_jenis?></option>
																<?php
																}
																?>
														</select>
													</div>
													

													<div class="form-group">
														<label>Active</label>
														<select class="form-control" id="active" name="active">
															<option value="1" <?php echo set_select('myselect', '1', TRUE); ?> >Active</option>
															<option value="0" <?php echo set_select('myselect', '0'); ?> >Not Active</option>
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
									<div class="dataTable_wrapper">
										<table class="table table-striped table-bordered table-hover" id="buTable">
											<thead>
												<tr>
													<th>Options</th>
													<th>#</th>
													<th>KD Armada</th>
													<th>Volume</th>
													<th>Berat</th>
													<th>Jenis Armada</th>
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
					url: "<?= base_url()?>armada/ax_data_armada/",
					type: 'POST'
				},
				columns: 
				[
					{
						data: "id_armada", render: function(data, type, full, meta){
							var str = '';
							str += '<div class="btn-group">';
							str += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
							str += '<ul class="dropdown-menu">';
							str += '<li><a onclick="ViewData(' + data + ')"><i class="fa fa-pencil"></i> Edit</a></li>';
							str += '<li><a onClick="DeleteData(' + data + ')"><i class="fa fa-trash"></i> Delete</a></li>';
							str += '</ul>';
							str += '</div>';
							return str;
						}
					},
					
					{ data: "id_armada" },
					{ data: "kd_armada" },
					{ data: "volume" },
					{ data: "berat" },
					{ data: "nm_armada_jenis" },					
					
					{ data: "active", render: function(data, type, full, meta){
							if(data == 1)
								return "Active";
							else return "Not Active";
						}
					}
				]
			});
			
			$('#btnSave').on('click', function () {
				if($('#kd_armada').val() == '')
				{
					alertify.alert("Warning", "Please fill Kode.");
				}
				else
				{
					var url = '<?=base_url()?>armada/ax_set_data';
					var data = {
						id_armada: $('#id_armada').val(),
						kd_armada: $('#kd_armada').val(),
						volume: $('#volume').val(),
						berat: $('#berat').val(),
						id_armada_jenis: $('#id_armada_jenis').val(),
						
						active: $('#active').val()
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						if(data['status'] == "success")
						{
							alertify.success("Armada data saved.");
							$('#addModal').modal('hide');
							buTable.ajax.reload();
						}
					});
				}
			});
			
			function ViewData(id_armada)
			{
				if(id_armada == 0)
				{
					$('#addModalLabel').html('Add Armada');
					$('#select2-id_armada_jenis-container').html('--Jenis--');
					$('#id_armada').val('0');
					$('#kd_armada').val('');
					$('#volume').val('');
					$('#berat').val('');
					$('#id_armada_jenis').val('');
					$('#active').val('1');
					$('#addModal').modal('show');
				}
				else
				{
					var url = '<?=base_url()?>armada/ax_get_data_by_id';
					var data = {
						id_armada: id_armada
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						$('#addModalLabel').html('Edit Armada');
						$('#id_armada').val(data['id_armada']);
						$('#kd_armada').val(data['kd_armada']);
						$('#select2-id_armada_jenis-container').html(data['nm_armada_jenis']);
						$('#volume').val(data['volume']);
						$('#berat').val(data['berat']);
						$('#id_armada_jenis').val(data['id_armada_jenis']);
						$('#active').val(data['active']);
						$('#addModal').modal('show');
					});
				}
			}
			
			function DeleteData(id_armada)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>armada/ax_unset_data';
						var data = {
							id_armada: id_armada
						};
								
						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							buTable.ajax.reload();
							alertify.error('Armada data deleted.');
						});
					},
					function(){ }
				);
			}
		</script>
	</body>
</html>
