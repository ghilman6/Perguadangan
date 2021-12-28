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
					<h1>Barang Masuk Detail #<?= $id_masuk?></h1>
				</section>
				<section class="invoice">
					<div class="row">
						<div class="col-lg-6">
							<div class="panel panel-default">
								<div class="panel-heading">
								<div class="row">
								<div class="form-group col-lg-3">
									<label>KD Barang</label>
									<input type="hidden" id="id_barang" name="id_barang" value='' />
									<input type="hidden" id="id_masuk" name="id_masuk" value='<?= $id_masuk?>' />
									<input type="text" readonly id="kd_barang" name="kd_barang" class="form-control" placeholder="KD Barang">
								</div>
								<div class="form-group col-lg-3">
									<label>Qty</label>
									<input type="text" id="qty" name="qty" class="form-control" placeholder="Qty">
								</div>
								<div class="form-group col-lg-3">
									<label>Harga</label>
									<input type="text" id="harga" name="harga" class="form-control" placeholder="Harga">
								</div>
								<div class="form-group col-lg-3">
									<label>Tanggal Exp</label>
									<input type="text" id="tgl_exp" name="tgl_exp" class="form-control" value="<?= date("Y-m-d")?>" placeholder="Tanggal Exp">
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
								 List Barang Masuk
								

													
													
								
									
								</div>
								<div class="panel-body">
									<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="buTable">
											<thead>
												<tr>
													<th>Options</th>
													<th>#</th>
													<th>KD Barang</th>
													<th>Barang</th>
													<th>Qty</th>
													<th>Harga</th>
													<th>Tanggal Exp</th>
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
					url: "<?= base_url()?>masuk/ax_data_masuk_detail/",
					type: 'POST',
					data: function ( d ) {
			         return $.extend({}, d, { 
			         	
			         	"id_masuk": <?= $id_masuk ?>,

			         });
			     	}
				},
				columns: 
				[
					{
						data: "id_masuk_detail", render: function(data, type, full, meta){
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
					
					{ data: "id_masuk_detail" },
					{ data: "kd_barang" },
					{ data: "nm_barang" },
					{ data: "qty" },
					{ data: "harga" },
					{ data: "tgl_exp" },
					
					
				]
			});

			var detailTable = $('#detailTable').DataTable({
				"ordering" : false,
				"scrollX": true,
				"processing": true,
				"serverSide": true,
				ajax: 
				{
					url: "<?= base_url()?>masuk/ax_data_barang/",
					type: 'POST'
				},
				columns: 
				[
					{
						data: "id_barang", render: function(data, type, full, meta){
							var str = '';
							str += '<div class="btn-group">';
							str += '<button type="button" class="btn btn-primary" onclick="PilihData(' + data + ')">Pilih</button>';
					
							str += '</div>';
							return str;
						}
					},
					
					{ data: "id_barang" },
					{ data: "kd_barang" },
					{ data: "nm_barang" },
					{ data: "nm_satuan" },
					
					
				]
			});
			
			$('#btnSave').on('click', function () {
				Savedata();
			});

			function Savedata(){
				if($('#kd_barang').val() == '')
				{
					alertify.alert("Warning", "Pilih Kode Barang.");
				}
				else
				{
					var url = '<?=base_url()?>masuk/ax_set_details';
					var data = {
						id_masuk: <?= $id_masuk ?>,
						id_barang: $('#id_barang').val(),
						tgl_exp: $('#tgl_exp').val(),
						qty: $('#qty').val(),
						harga: $('#harga').val(),
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
			
			
			function DeleteData(id_masuk_detail)
			{
				alertify.confirm(
					'Confirmation', 
					'Are you sure you want to delete this data?', 
					function(){
						var url = '<?=base_url()?>masuk/ax_unset_detail';
						var data = {
							id_masuk_detail: id_masuk_detail
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

			function PilihData(id_barang){

					var url = '<?=base_url()?>masuk/ax_get_barang_by_id/';
					var data = {
						id_barang: id_barang
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
					});
			}


			$( "#tgl_exp").datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: "yy-mm-dd"
			});
			$( "#tgl_exp" ).inputmask("yyyy-mm-dd",{"placeholder": "yyyy-mm-dd"});

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
                window.location.href="<?=base_url();?>masuk";
            }

		</script>
	</body>
</html>
