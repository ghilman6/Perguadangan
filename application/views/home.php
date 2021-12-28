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
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $JmlBarangMasuk?></h3>
                  <p>Barang Masuk</p>
                </div>
                <div class="icon">
                  <i class="fa fa-truck"></i>
                </div>
                <a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $JmlBarangKeluar?><sup style="font-size: 20px"></sup></h3>
                  <p>Barang Keluar</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>44</h3>
                  <p>Pengiriman Barang</p>
                </div>
                <div class="icon">
                  <i class="fa fa-truck"></i>
                </div>
                <a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>10</h3>
                  <p>Barang Retur</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div><!-- /.row -->


        </section>
		
		
		
		  </div>
    </div>
	
			<?= $this->load->view('basic_js'); ?>
			
			<script type='text/javascript'>
				$(document).ready(function() {
					
					var datachartweek = JSON.parse(`<?php echo $datapaketchartweek; ?>`);
					console.log(datachartweek);
					var area = new Morris.Area({
						element: 'revenue-chart-week',
						resize: true,
						
						data: datachartweek,
						xkey: 'waktu',
						ykeys: [ 'totalpaket'],
						labels: ['Jumlah Paket'],
						lineColors: ['#29697f', '#3c8dbc'],
						hideHover: 'auto'
					});
					
					var datachartmonth = JSON.parse(`<?php echo $datarevenuechartmonth; ?>`);
					console.log(datachartmonth);
					var area = new Morris.Area({
						element: 'revenue-chart-month',
						resize: true,
						data: datachartmonth,
						xkey: 'wakturevenue',
						ykeys: [ 'totalrevenue'],
						labels: ['Jumlah pendapatan'],
						lineColors: ['#29697f', '#3c8dbc'],
						hideHover: 'auto'
					});
					
				});
			</script>
	</body>
</html>
