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
					<h1>Barang opname Detail #<?= $id_opname?></h1>
				</section>
				<section class="invoice">
					<div class="row">
						<div class="col-lg-6">
							<div class="panel panel-default">
								<div class="panel-heading">
								<div class="row">
								<div class="form-group col-lg-4">
									<label>KD Barang</label>
									<input type="hidden" id="id_barang" name="id_barang" value='' />
									<input type="hidden" id="id_opname" name="id_opname" value='<?= $id_opname?>' />
									<input type="text" readonly id="id_stok" name="id_stok" class="form-control" placeholder="ID Stok">
									<input type="text" readonly id="kd_barang" name="kd_barang" class="form-control" placeholder="KD Barang">
								</div>
								<div class="form-group col-lg-4">
									<label>Qty</label>
									<input type="text" id="qtyd" readonly name="qtyd" class="form-control" placeholder="Qty Stock">
									<input type="text" id="qty" name="qty" class="form-control" placeholder="Qty">
								</div>
								<div class="form-group col-lg-4">
									<label>Harga</label>
									<input type="text" id="harga" readonly name="harga" class="form-control" placeholder="Harga">
								</div>
							
								<div class="col-lg-12 ">
								<div class="input-group">
								<input type="text" readonly name="nm_barang" class="form-control" placeholder="Nama Barang" id="nm_barang">
								<span class="input-group-btn">
        								<button class="btn btn-info" type="button"  id="btnSave">Tambah (F1)</button>
      									</span>
      							</div>
								  <br>
							</div>
								

													
													
								</div>
									
								</div>
								<div class="panel-body">
									<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="detailTable">
											<thead>
												<tr>
													
													<th>Options</th>
													<th>#</th>
													<th>KD Barang</th>
													<th>Barang</th>
													<th>Satuan</th>
													<th>Qty</th>
													<th>Harga</th>
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
								 List Barang opname
								

													
													
								
									
								</div>
								<div class="panel-body">
									<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="buTable">
											<thead>
												<tr>
													<th>Options</th>
													<th>#</th>
													<th>ID Stok</th>
													<th>KD Barang</th>
													<th>Barang</th>
													<th>Qty Opname</th>
													<th>Qty Asal</th>
													<th>Harga</th>
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
					url: "<?= base_url()?>opname/ax_data_opname_detail/",
					type: 'POST',
					data: function ( d ) {
			         return $.extend({}, d, { 
			         	
			         	"id_opname": <?= $id_opname ?>,

			         });
			     	}
				},
				columns: 
				[
					{
						data: "id_opname_detail", render: function(data, type, full, meta){
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
					
					{ data: "id_opname_detail" },
					{ data: "id_stok" },
					{ data: "kd_barang" },
					{ data: "nm_barang" },
					{ data: "qty" },
					{ data: "qty_asal" },
					{ data: "harga" },
					
					
				]
			});

			var detailTable = $('#detailTable').DataTable({
				"ordering" : false,
				"scrollX": true,
				"processing": true,
				"serverSide": true,
				ajax: 
				{
					url: "<?= base_url()?>opname/ax_data_barang/",
					type: 'POST'
				},
				columns: 
				[
					{
						data: "id_stok", render: function(data, type, full, meta){
							var str = '';
							str += '<div class="btn-group">';
							str += '<button type="button" class="btn btn-primary" onclick="PilihData(' + data + ')">Pilih</button>';
					
							str += '</div>';
							return str;
						}
					},
					
					{ data: "id_stok" },
					{ data: "kd_barang" },
					{ data: "nm_barang" },
					{ data: "nm_satuan" },
					{ data: "qty" },
					{ data: "harga" },
					
					
				]
			});
			
			$('#btnSave').on('click', function () {
				Savedata();
			});

			function Savedata(){
				if($('#id_stok').val() == '')
				{
					alertify.alert("Warning", "Pilih Stok Barang.");
				}else if($('#qty').val() == 0){
					alertify.alert("Warning", "Masukan Qty Barang.");
				}
				else if($('#qty').val() > $('#qtyd').val())
				{
					alertify.alert("Warning", "Qty melebih Stock.");
				}
				else
				{
					var url = '<?=base_url()?>opname/ax_set_details';
					var data = {
						id_opname: <?= $id_opname ?>,
						id_stok: $('#id_stok').val(),
						qty: $('#qty').val(),
						qtyd: $('#qtyd').val(),
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


						$('#nm_barang').val('');
						$('#kd_barang').val('');
						$('#id_barang').val('');
						$('#id_stok').val('');
						$('#harga').val('');
						$('#qtyd').val('');
						$('#qty').val('');

						}
					});
				}
			}
			
			
			function DeleteData(id_opname_detail)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>opname/ax_unset_detail';
						var data = {
							id_opname_detail: id_opname_detail
						};
								
						$.ajax({
							url: url,
							method: 'POST',
							data: data
						}).done(function(data, textStatus, jqXHR) {
							var data = JSON.parse(data);
							buTable.ajax.reload();
							detailTable.ajax.reload();
							alertify.error('opname data deleted.');
						});
					},
					function(){ }
				);
			}

			function PilihData(id_stok){

					var url = '<?=base_url()?>opname/ax_get_barang_by_id/';
					var data = {
						id_stok: id_stok
					};
							
					$.ajax({
						url: url,
						method: 'POST',
						data: data
					}).done(function(data, textStatus, jqXHR) {
						var data = JSON.parse(data);
						
						$('#nm_barang').val(data['nm_barang']);
						$('#kd_barang').val(data['kd_barang']);
						$('#id_barang').val(data['id_barang']);
						$('#id_stok').val(data['id_stok']);
						$('#harga').val(data['harga']);
						$('#qtyd').val(data['qty']);
					});
			}


			$( "#tgl_opname").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd"
			});
			$( "#tgl_opname" ).inputmask("yyyy-mm-dd",{"placeholder": "yyyy-mm-dd"});

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

			function kembali(){
                window.location.href="<?=base_url();?>opname";
            }

		</script>
	</body>
</html>
