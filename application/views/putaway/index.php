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
					<h1>Putaway</h1>
				</section>
				<section class="invoice">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<button class="btn btn-primary" onclick='ViewData(0)'>
										<i class='fa fa-plus'></i> Buat Dokumen Putaway
									</button>
									<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="Form-add-bu" id="addModalLabel">Form Add Putaway</h4>
												</div>
												<div class="modal-body">
													<input type="hidden" id="id_putaway" name="id_putaway" value='' />

													<div class="form-group">
														<label>Keterangan</label>
														<input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan">
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
													<th>Keterangan</th>
													<th>CDate</th>
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
					url: "<?= base_url()?>putaway/ax_data_putaway/",
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
						data: "id_putaway", render: function(data, type, full, meta){
							var str = '';
							str += '<div class="btn-group">';
							str += '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>';
							str += '<ul class="dropdown-menu">';
							if(full['active'] == 1){
							str += '<li><a href="<?= base_url()?>putaway/details/'+data+'"><i class="fa fa-list"></i> Details</a></li>';
							str += '<li><a onclick="AppData(' + data + ','+full['jml']+')"><i class="fa fa-check"></i> Approve</a></li>';
							str += '<li><a onclick="ViewData(' + data + ')"><i class="fa fa-pencil"></i> Edit</a></li>';
							str += '<li><a onClick="DeleteData(' + data + ')"><i class="fa fa-trash"></i> Delete</a></li>';
							}else{
							str += '<li><a href="<?= base_url()?>putaway/lists/'+data+'"><i class="fa fa-list"></i> Details</a></li>';
							}
							
							
							str += '</ul>';
							str += '</div>';
							return str;
						}
					},
					
					{ data: "id_putaway" },
					{ data: "keterangan" },
					{ data: "cdate" },
					
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
				if($('#keterangan').val() == '')
				{
					alertify.alert("Warning", "Please fill Keterangan.");
				}
				else
				{
					var url = '<?=base_url()?>putaway/ax_set_data';
					var data = {
						id_putaway: $('#id_putaway').val(),
						keterangan: $('#keterangan').val(),
						tgl_putaway: $('#tgl_putaway').val(),
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						if(data['status'] == "success")
						{
							alertify.success("Putaway data saved.");
							$('#addModal').modal('hide');
							buTable.ajax.reload();
						}
					});
				}
			});
			
			function ViewData(id_putaway)
			{
				if(id_putaway == 0)
				{
					$('#addModalLabel').html('Add Putaway');
					$('#id_putaway').val('0');
					$('#keterangan').val('');
					$('#addModal').modal('show');
				}
				else
				{
					var url = '<?=base_url()?>putaway/ax_get_data_by_id';
					var data = {
						id_putaway: id_putaway
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						$('#addModalLabel').html('Edit Putaway');
						$('#id_putaway').val(data['id_putaway']);
						$('#keterangan').val(data['keterangan']);
						$('#addModal').modal('show');
					});
				}
			}

			function AppData(id_putaway, jml)
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
						var url = '<?=base_url()?>putaway/ax_app_data';
						var data = {
							id_putaway: id_putaway
						};
								
						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							buTable.ajax.reload();
							alertify.success('Putaway data Approved.');
						});
					},
					function(){ }
				);
			}
			}
			
			function DeleteData(id_putaway)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>putaway/ax_unset_data';
						var data = {
							id_putaway: id_putaway
						};
								
						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							buTable.ajax.reload();
							alertify.error('Putaway data deleted.');
						});
					},
					function(){ }
				);
			}


			$( "#tgl_putaway").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd"
			});
			$( "#tgl_putaway" ).inputmask("yyyy-mm-dd",{"placeholder": "yyyy-mm-dd"});
			$("#filter").on("change", function(){ 
				buTable.ajax.reload();
			 });
		</script>
	</body>
</html>
