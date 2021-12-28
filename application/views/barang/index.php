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
					<h1>Barang</h1>
				</section>
				<section class="invoice">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<button class="btn btn-primary" onclick='ViewData(0)'>
										<i class='fa fa-plus'></i> Add Barang
									</button>
									<div class="modal fade" id="addModal" tabindex="" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="Form-add-bu" id="addModalLabel">Form Add Barang</h4>
												</div>
												<div class="modal-body">
													<input type="hidden" id="id_barang" name="id_barang" value='' />
													
													<div class="form-group">
														<label>Kode Barang</label>
														<input type="text" id="kd_barang" name="kd_barang" class="form-control" placeholder="Kode Barang">
													</div>
													<div class="form-group">
														<label>Nama barang</label>
														<input type="text" id="nm_barang" name="nm_barang" class="form-control" placeholder="Nama Barang">
													</div>
													

													<div class="form-group ">
														<label>Satuan</label>
														<select class="form-control select2 " style="width: 100%;" id="id_satuan" name="id_satuan">
																<option value="0">--Satuan--</option>
																<?php
																foreach ($combobox_satuan->result() as $rowmenu) {
																?>
																<option value="<?= $rowmenu->id_satuan?>"  ><?= $rowmenu->nm_satuan?></option>
																<?php
																}
																?>
														</select>
													</div>

													<div class="form-group ">
														<label>Kategori</label>
														<select class="form-control select2 " style="width: 100%;" id="id_kategori" name="id_kategori">
																<option value="0">--Kategori--</option>
																<?php
																foreach ($combobox_kategori->result() as $rowmenu) {
																?>
																<option value="<?= $rowmenu->id_kategori?>"  ><?= $rowmenu->nm_kategori?></option>
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
													<th>Kode Barang</th>
													<th>Nama Barang</th>
													<th>Satuan</th>
													<th>Kategori</th>
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
					url: "<?= base_url()?>barang/ax_data_barang/",
					type: 'POST'
				},
				columns: 
				[
					{
						data: "id_barang", render: function(data, type, full, meta){
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
					
					{ data: "id_barang" },
					{ data: "kd_barang" },
					{ data: "nm_barang" },
					{ data: "nm_satuan" },
					{ data: "nm_kategori" },
					
					{ data: "active", render: function(data, type, full, meta){
							if(data == 1)
								return "Active";
							else return "Not Active";
						}
					}
				]
			});
			
			$('#btnSave').on('click', function () {
				if($('#nm_barang').val() == '')
				{
					alertify.alert("Warning", "Please fill bu Name.");
				}
				else
				{
					var url = '<?=base_url()?>barang/ax_set_data';
					var data = {
						id_barang: $('#id_barang').val(),
						kd_barang: $('#kd_barang').val(),
						nm_barang: $('#nm_barang').val(),
						id_satuan: $('#id_satuan').val(),
						id_kategori: $('#id_kategori').val(),
						
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
							alertify.success("barang data saved.");
							$('#addModal').modal('hide');
							buTable.ajax.reload();
						}
					});
				}
			});
			
			function ViewData(id_barang)
			{
				if(id_barang == 0)
				{
					$('#addModalLabel').html('Add Barang');
					$('#id_barang').val('0');
					$('#select2-id_satuan-container').html('--Satuan--');
					$('#select2-id_kategori-container').html('--Kategori--');
					$('#kd_barang').val('');
					$('#nm_barang').val('');
					$('#id_satuan').val('');
					$('#id_kategori').val('');
					$('#active').val('1');
					$('#addModal').modal('show');
				}
				else
				{
					var url = '<?=base_url()?>barang/ax_get_data_by_id';
					var data = {
						id_barang: id_barang
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						$('#addModalLabel').html('Edit Barang');
						$('#id_barang').val(data['id_barang']);
						$('#select2-id_satuan-container').html(data['nm_satuan']);
						$('#select2-id_kategori-container').html(data['nm_kategori']);
						$('#kd_barang').val(data['kd_barang']);
						$('#nm_barang').val(data['nm_barang']);
						$('#id_satuan').val(data['id_satuan']);
						$('#id_kategori').val(data['id_kategori']);
						$('#active').val(data['active']);
						$('#addModal').modal('show');
					});
				}
			}
			
			function DeleteData(id_barang)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>barang/ax_unset_data';
						var data = {
							id_barang: id_barang
						};
								
						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							buTable.ajax.reload();
							alertify.error('barang data deleted.');
						});
					},
					function(){ }
				);
			}
		</script>
	</body>
</html>
