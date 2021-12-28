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

        </section>
		
		
		<section class="content">
		
			
			<!-- /.row -->
			  <div class="row">
				<div class="col-md-12">
				  <div class="box">
					<div class="box-header with-border">
					  <h3 class="box-title">INFORMASI</h3>
						<div class="nav-tabs-custom">
							<div class="tab-content no-padding">
							</div>
						</div>
					  <!-- /.nav-tabs-custom -->
					</div>
					<div class="box-body with-border">
					<b>Update 2 September 2021</b><br>
					1. Untuk data lama tetap bisa diakses di <b>dilsv1.damri.co.id</b><br>
					2. Skema transfer (transisi armada) di buat di menu tersendiri.<br>
					3. Revenue sudah terpisah untuk masing masing cabang, untuk melihatnya harus dilakukan hingga proses input pengambilan paket.<br>
					4. Penambahan nomor urut dan kode daerah pada cetakan resi.<br>
					5. Terdapat status "Sudah direview" dan "Perlu direview" di master tarif.<br>
					6. Penambahan menu cek muatan, untuk mengetahui posisi/status paket.<br>
					</div>
				  </div>
				  <!-- /.box -->
				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			  
			  
		</section>
		
		
		</div>
    </div>
	
			<?= $this->load->view('basic_js'); ?>
			
	</body>
</html>
