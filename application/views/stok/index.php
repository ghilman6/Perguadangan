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
					<h1>Stok</h1>
				</section>
				<section class="invoice">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-body">
									<div class="dataTable_wrapper">
										<table class="table table-striped table-bordered table-hover" id="buTable">
											<thead>
												<tr>
												
													<th>#</th>
													<th>KD Barang</th>
													<th>Nama Barang</th>
													<th>Harga</th>
													<th>Qty</th>
													<th>Tanggal Exp</th>
													<th>ID Masuk</th>
													<th>KD Lokasi</th>
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
					url: "<?= base_url()?>stok/ax_data_stok/",
					type: 'POST'
				},
				columns: 
				[
					{ data: "id_stok" },

					{ data: "kd_barang" },				
					{ data: "nm_barang" },
					{ data: "qty" },
					{ data: "harga" },
					{ data: "tgl_exp" },
					
					{ data: "id_masuk" },
					// { data: "kd_masuk" },
					{ data: "kd_lokasi" },

					{ data: "active", render: function(data, type, full, meta){
							if(data == 1)
								return "Active";
							else return "Not Active";
						}
					}
				]
			});
			
			
		</script>
	</body>
</html>
