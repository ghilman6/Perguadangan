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
						

						<div class="col-lg-12">
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
					
					
					{ data: "id_masuk_detail" },
					{ data: "kd_barang" },
					{ data: "nm_barang" },
					{ data: "qty" },
					{ data: "harga" },
					{ data: "tgl_exp" },
					
					
				]
			});


			function kembali(){
                window.location.href="<?=base_url();?>masuk";
            }

		</script>
	</body>
</html>
