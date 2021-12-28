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
					<h1>Barang retur Detail #<?= $id_retur?></h1>
				</section>
				<section class="invoice">
					<div class="row">
						
<<<<<<< HEAD

=======
>>>>>>> 4fbab92ea7409c03268afc22b3c8e6e1a61fc728
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
								<button type="button" class="btn btn-primary" onclick="kembali()"><i class='fa fa-arrow-left'></i> Kembali</button>
								 List Barang retur
<<<<<<< HEAD
=======
								

													
													
								
>>>>>>> 4fbab92ea7409c03268afc22b3c8e6e1a61fc728
									
								</div>
								<div class="panel-body">
									<div class="dataTable_wrapper">
									<table class="table table-striped table-bordered table-hover" id="buTable">
											<thead>
												<tr>
<<<<<<< HEAD
=======
													
>>>>>>> 4fbab92ea7409c03268afc22b3c8e6e1a61fc728
													<th>#</th>
													<th>KD Barang</th>
													<th>Barang</th>
													<th>Qty</th>
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
					url: "<?= base_url()?>retur/ax_data_retur_detail/",
					type: 'POST',
					data: function ( d ) {
			         return $.extend({}, d, { 
			         	
			         	"id_retur": <?= $id_retur ?>,

			         });
			     	}
				},
				columns: 
				[
					
					
					{ data: "id_retur_detail" },
					{ data: "kd_barang" },
					{ data: "nm_barang" },
					{ data: "qty" },
					{ data: "harga" },
					
					
				]
			});

<<<<<<< HEAD
=======
			
			
			
			
>>>>>>> 4fbab92ea7409c03268afc22b3c8e6e1a61fc728

			function kembali(){
                window.location.href="<?=base_url();?>retur";
            }

		</script>
	</body>
</html>
