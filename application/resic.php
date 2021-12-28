<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class resi extends CI_Controller {
	 function __construct(){
        parent::__construct();
        $this->load->model("model_resi");
        $this->load->model("model_menu");
        $this->load->helper('url');
        $this->load->library('input');
       
        ///constructor yang dipanggil ketika memanggil ro.php untuk melakukan pemanggilan pada model : ro.php yang ada di folder models
    }

	public function index()
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
		$menu_id_menu_details = 26;  //custom by database
		$access = $this->model_menu->selectaccess($session['id_level'], $menu_id_menu_details);
        if(!empty($access['id_menu_details'])){
        $data['nm_user'] = $session['nm_user'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        $data['combobox_rute'] = $this->m<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class resi extends CI_Controller {
	 function __construct(){
        parent::__construct();
        $this->load->model("model_resi");
        $this->load->model("model_menu");
        $this->load->helper('url');
        $this->load->library('input');
       
        ///constructor yang dipanggil ketika memanggil ro.php untuk melakukan pemanggilan pada model : ro.php yang ada di folder models
    }

	public function index()
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
		$menu_id_menu_details = 26;  //custom by database
		$access = $this->model_menu->selectaccess($session['id_level'], $menu_id_menu_details);
        if(!empty($access['id_menu_details'])){
        $data['nm_user'] = $session['nm_user'];
        $data['id_user'] = $session['id_user'];
        $data['session_level'] = $session['id_level'];
        $data['combobox_rute'] = $this->model_resi->combobox_rute($session['id_cabang']);
        
        $data['combobox_keberangkatan'] = $this->model_resi->combobox_keberangkatan();
		$data['listresi'] = $this->model_resi->getAllresi($session['id_cabang']);
		$this->load->view('resi/index', $data);
		}else{
		echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";	
		}
		}else{
		redirect('welcome/relogin','refresh');	
		}
		
	}

    public function search()
    {
        // tangkap variabel keyword dari URL
        $keyword = $this->uri->segment(3);

        // cari di database
        //$data = $this->db->from('autocomplete')->like('nama',$keyword)->get();    
        $data = $this->model_resi->cari_user($keyword);
        // format keluaran di dalam array
        foreach($data->result() as $row)
        {
            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' =>$row->no_tlp_costumer,
                'nm_costumer'   =>$row->nm_costumer,
                'no_ktp_costumer'   =>$row->no_ktp_costumer,
                'alamat_costumer'   =>$row->alamat_costumer
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
    }

    

	public function get_rute_tarif_a($id_rute) {
        $tmp     = '';
        $data     = $this->model_resi->combobox_rute_select($id_rute);
         if(!empty($id_rute)){
        if(!empty($data)){
               
            foreach($data->result() as $row) {    
                $tmp .= "<option value='".$row->tarif_a."'>".$row->tarif_a."</option>";
            }
        } else {
              $tmp .= "<option value='0'>0</option>";
        }}else{
            $tmp .= "<option value='0'>0</option>";
        }
        die($tmp);
        }

    public function get_rute_tarif_b($id_rute) {
        $tmp     = '';
        $data     = $this->model_resi->combobox_rute_select($id_rute);
        if(!empty($id_rute)){
        if(!empty($data)){
               
            foreach($data->result() as $row) {    
                $tmp .= "<option value='".$row->tarif_b."'>".$row->tarif_b."</option>";
            }
        } else {
              $tmp .= "<option value='0'>0</option>";
        }}else{
            $tmp .= "<option value='0'>0</option>";
        }
        die($tmp);
        }

    public function get_rute_layanan($id_rute) {
        $tmp     = '';
        $data     = $this->model_resi->combobox_rute_select($id_rute);
        if(!empty($id_rute)){
        if(!empty($data)){
               
            foreach($data->result() as $row) {    
                if($row->layanan == 1){
                    $lan = "PREMIUM";
                }
                elseif ($row->layanan == 2) {
                    $lan = "STANDART";
                }
                elseif ($row->layanan == 3) {
                   $lan = "D2D";
                }else{
                    $lan = "";
                }

                $tmp .= "<option value='".$row->layanan."'>".$lan."</option>";
            }
        } else {
              $tmp .= "<option value='0'></option>";
        }}else{
            $tmp .= "<option value='0'></option>";
        }
        die($tmp);
        }

    public function get_kurir($id_rute) {
        $tmp     = '';
        $cbng     = $this->model_resi->selectrute($id_rute);
        $id_cabang = $cbng['id_cabang_tujuan'];
        $data     = $this->model_resi->combobox_daerah($id_cabang);
         if(!empty($id_rute)){
        if(!empty($data)){
               $tmp .= "<option value='0'> -- Tidak Menggunakan layanan -- </option>";
            foreach($data->result() as $row) {    
                $tmp .= "<option value='".$row->id_daerah."'>".$row->nm_daerah."</option>";
            }
        } else {
              $tmp .= "<option value='0'> -- Tidak Menggunakan layanan -- </option>";
        }}else{
            $tmp .= "<option value='0'> -- Tidak Menggunakan layanan -- </option>";
        }
        die($tmp);
        }

    public function get_kurir_price($id_daerah) {
        $tmp     = '';
        $data     = $this->model_resi->combobox_daerah_harga($id_daerah);
        if(!empty($id_daerah)){
        if(!empty($data)){
		if($id_daerah == "null"){
               $tmp .= "<option value='0'> 0 </option>";}else{
            foreach($data->result() as $row) {    
                $tmp .= "<option value='".$row->price_zona."'>".$row->price_zona."</option>";
            }}
        } else {
              $tmp .= "<option value='0'> 0 </option>";
        }}else{
            $tmp .= "<option value='0'> 0 </option>";
        }
        die($tmp);
        }
    

	
	Public function Insert() 
	{
		if($this->session->userdata('login'))
        {
        $session = $this->session->userdata('login');
		$menu_id_menu_details = 26;  //custom by database
		$access = $this->model_menu->selectaccess($session['id_level'], $menu_id_menu_details);
        if(!empty($access['id_menu_details'])){
        $a = $this->input->post ('id_rute');
        $b = $this->input->post ('tarif_a');
        $c = $this->input->post ('tarif_b');
        
        $f = $this->input->post ('berat');
        $g = $this->input->post ('jumlah');
        $h = $this->input->post ('panjang');
        $i = $this->input->post ('lebar');
        $j = $this->input->post ('tinggi');
        $k = $this->input->post ('dimensi');
        $l = $this->input->post ('tarif');
        $m = $this->input->post ('no_ktp_pengirim');
       
        $o = $this->input->post ('nm_pengirim');
        $p = $this->input->post ('nm_penerima');
        $q = $this->input->post ('no_tlp_pengirim');
        $r = $this->input->post ('no_tlp_penerima');
        $s = $this->input->post ('alamat_pengirim');
        $t = $this->input->post ('alamat_penerima');
        $u = $this->input->post ('agree');
        $v = $this->input->post ('estimasi');
        $w = $this->input->post ('kd_resi_manual');

        if (empty($u)){
        	echo "<script>alert('Anda Masih Belum setuju');window.location.href='javascript:history.back(-1);'</script>";
		}else{
        if (empty($a)){
            echo "<script>alert('Data ID Rute Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($b) && empty($c)){
            echo "<script>alert('Data Tarif Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($f)){
            echo "<script>alert('Data Berat Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($g)){
            echo "<script>alert('Data Jumlah Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($h) && empty($i) && empty($j) ){
            echo "<script>alert('Data Panjang / Lebar / Tinggi Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($m)){
            echo "<script>alert('Data NO KTP Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($o)){
            echo "<script>alert('Data Nama Pengirim Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($p)){
            echo "<script>alert('Data Nama Penerima Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($q)){
            echo "<script>alert('Data No. Tlp Pengirim Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($r)){
            echo "<script>alert('Data No. Tlp Penerima Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($s)){
            echo "<script>alert('Data Alamat Pengirim Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($t)){
            echo "<script>alert('Data Alamat Penerima Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($v)){
            echo "<script>alert('Data Estimasi Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
		//insert semua data yang ada pada table
		$rute = $this->model_resi->selectrute($this->input->post ('id_rute'));
		$data = array(
		'id_daerah' => $this->input->post ('id_daerah'),
   		'id_cabang_asal' => $rute['id_cabang_asal'],
   		'id_cabang_tujuan' => $rute['id_cabang_tujuan'],
   		'jenis' => $this->input->post ('jenis'),
   		'no_ktp_pengirim' => $this->input->post ('no_ktp_pengirim'),
   		'note' => $this->input->post ('note'),
        'layanan' => $this->input->post ('layanan'),
   		'nm_pengirim' => $this->input->post ('nm_pengirim'),
   		'nm_penerima' => $this->input->post ('nm_penerima'),
   		'no_tlp_pengirim' => $this->input->post ('no_tlp_pengirim'),
   		'no_tlp_penerima' => $this->input->post ('no_tlp_penerima'),
   		'alamat_pengirim' => $this->input->post ('alamat_pengirim'),
   		'alamat_penerima' => $this->input->post ('alamat_penerima'),
   		'berat' => $this->input->post ('berat'),
        'berat_dimensi' => $this->input->post ('berat_dimensi'),
   		'panjang' => $this->input->post ('panjang'),
   		'lebar' => $this->input->post ('lebar'),
   		'tinggi' => $this->input->post ('tinggi'),
   		'dimensi' => $this->input->post ('dimensi'),
   		'jumlah' => $this->input->post ('jumlah'),
        'active' => $this->input->post ('active'),
   		'asuransi' => $this->input->post ('asuransi'),
        'courier' => $this->input->post ('courier'),
        'tarif' => $this->input->post ('tarif'),
        'estimasi' => $this->input->post ('estimasi'),
        'kd_resi_manual' => $this->input->post ('kd_resi_manual'),
   		'cuser' => $session['id_user']
		);	
		$this->model_resi->Insertresi($data);

		redirect('resi');
    }}}}}}}}}}}}
		}}
		}else{
		echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";	
		}
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	Public function Delete($id_resi) 
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
		$menu_id_menu_details = 26;  //custom by database
		$access = $this->model_menu->selectaccess($session['id_level'], $menu_id_menu_details);
        if(!empty($access['id_menu_details'])){
		//delete data yang ada pada table
		$this->model_resi->Deletetresi($id_resi);
		redirect('resi');
		}else{
		echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";	
		}
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	

	Public function Update($id_resi) 
	{
		if($this->session->userdata('login'))
        {
        $session = $this->session->userdata('login');
		$menu_id_menu_details = 26;  //custom by database
		$access = $this->model_menu->selectaccess($session['id_level'], $menu_id_menu_details);
        if(!empty($access['id_menu_details'])){
        $a = $id_resi;
        if (empty($a)){
			echo "<script>alert('ID Resi Kosong');window.location.href='javascript:history.back(-1);'</script>";
		}else{
		
		$data = array(
		
   		'status' => 1,
				
		);	
		$this->model_resi->Updateresi($id_resi, $data);
		redirect('resi');
		}
		}else{
		echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";	
		}
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

    public function pdf_resi($id_resi)
    {
        
        
        $data['resi'] = $this->model_resi->getAlldetail($id_resi);
      
         $this->load->view('resi/resi', $data);
    }

    public function cetak_baru($id_resi){
        ob_start();
        $data['resi'] = $this->model_resi->getAlldetail($id_resi);
        $this->load->view('resi/resi2', $data);
        $html = ob_get_contents();
        ob_end_clean();
         
        require_once('./assets/html2pdf/html2pdf.class.php');
        
        $pdf = new HTML2PDF('L','A5','en', false, 'ISO-8859-15',array(3, 3, 3, 3));
        $pdf->setDefaultFont("arial");
        $pdf->pdf->SetDisplayMode('fullpage');
        $pdf->WriteHTML($html);
        $pdf->Output('resi'.$id_resi.'.pdf');
    }
    public function ctk($id_resi){
    ob_start();
    $data['resi'] = $this->model_resi->getAlldetail($id_resi);
    $this->load->view('resi/resi2', $data);
    $content = ob_get_clean();

    // convert to PDF
    require_once('./assets/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('L','A5','en', false, 'ISO-8859-15',array(2, 2, 2, 2));
        //$html2pdf->setDefaultFont("arial");
        $html2pdf->pdf->SetDisplayMode('fullpage');
//      $html2pdf->pdf->SetProtection(array('print'), 'spipu');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('exemple07.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
    }

    public function cetak3($id_resi){
        ob_start();
        $data['resi'] = $this->model_resi->getAlldetail($id_resi);
        $this->load->view('resi/resi2', $data);
        $html = ob_get_contents();
        ob_end_clean();
         
        require_once('./assets/html2pdf/html2pdf.class.php');
        
        $pdf = new HTML2PDF('L','A5','en', false, 'ISO-8859-15',array(3, 3, 3, 3));
        $pdf->setDefaultFont("arial");
        $pdf->WriteHTML($html);
        $pdf->Output('resi'.$id_resi.'.pdf', 'D');
    }

   
}odel_resi->combobox_rute($session['id_cabang']);
        
        $data['combobox_keberangkatan'] = $this->model_resi->combobox_keberangkatan();
		$data['listresi'] = $this->model_resi->getAllresi($session['id_cabang']);
		$this->load->view('resi/index', $data);
		}else{
		echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";	
		}
		}else{
		redirect('welcome/relogin','refresh');	
		}
		
	}

    public function search()
    {
        // tangkap variabel keyword dari URL
        $keyword = $this->uri->segment(3);

        // cari di database
        //$data = $this->db->from('autocomplete')->like('nama',$keyword)->get();    
        $data = $this->model_resi->cari_user($keyword);
        // format keluaran di dalam array
        foreach($data->result() as $row)
        {
            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' =>$row->no_tlp_costumer,
                'nm_costumer'   =>$row->nm_costumer,
                'no_ktp_costumer'   =>$row->no_ktp_costumer,
                'alamat_costumer'   =>$row->alamat_costumer
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
    }

    

	public function get_rute_tarif_a($id_rute) {
        $tmp     = '';
        $data     = $this->model_resi->combobox_rute_select($id_rute);
         if(!empty($id_rute)){
        if(!empty($data)){
               
            foreach($data->result() as $row) {    
                $tmp .= "<option value='".$row->tarif_a."'>".$row->tarif_a."</option>";
            }
        } else {
              $tmp .= "<option value='0'>0</option>";
        }}else{
            $tmp .= "<option value='0'>0</option>";
        }
        die($tmp);
        }

    public function get_rute_tarif_b($id_rute) {
        $tmp     = '';
        $data     = $this->model_resi->combobox_rute_select($id_rute);
        if(!empty($id_rute)){
        if(!empty($data)){
               
            foreach($data->result() as $row) {    
                $tmp .= "<option value='".$row->tarif_b."'>".$row->tarif_b."</option>";
            }
        } else {
              $tmp .= "<option value='0'>0</option>";
        }}else{
            $tmp .= "<option value='0'>0</option>";
        }
        die($tmp);
        }

    public function get_rute_layanan($id_rute) {
        $tmp     = '';
        $data     = $this->model_resi->combobox_rute_select($id_rute);
        if(!empty($id_rute)){
        if(!empty($data)){
               
            foreach($data->result() as $row) {    
                if($row->layanan == 1){
                    $lan = "PREMIUM";
                }
                elseif ($row->layanan == 2) {
                    $lan = "STANDART";
                }
                elseif ($row->layanan == 3) {
                   $lan = "D2D";
                }else{
                    $lan = "";
                }

                $tmp .= "<option value='".$row->layanan."'>".$lan."</option>";
            }
        } else {
              $tmp .= "<option value='0'></option>";
        }}else{
            $tmp .= "<option value='0'></option>";
        }
        die($tmp);
        }

    public function get_kurir($id_rute) {
        $tmp     = '';
        $cbng     = $this->model_resi->selectrute($id_rute);
        $id_cabang = $cbng['id_cabang_tujuan'];
        $data     = $this->model_resi->combobox_daerah($id_cabang);
         if(!empty($id_rute)){
        if(!empty($data)){
               $tmp .= "<option value='0'> -- Tidak Menggunakan layanan -- </option>";
            foreach($data->result() as $row) {    
                $tmp .= "<option value='".$row->id_daerah."'>".$row->nm_daerah."</option>";
            }
        } else {
              $tmp .= "<option value='0'> -- Tidak Menggunakan layanan -- </option>";
        }}else{
            $tmp .= "<option value='0'> -- Tidak Menggunakan layanan -- </option>";
        }
        die($tmp);
        }

    public function get_kurir_price($id_daerah) {
        $tmp     = '';
        $data     = $this->model_resi->combobox_daerah_harga($id_daerah);
        if(!empty($id_daerah)){
        if(!empty($data)){
		if($id_daerah == "null"){
               $tmp .= "<option value='0'> 0 </option>";}else{
            foreach($data->result() as $row) {    
                $tmp .= "<option value='".$row->price_zona."'>".$row->price_zona."</option>";
            }}
        } else {
              $tmp .= "<option value='0'> 0 </option>";
        }}else{
            $tmp .= "<option value='0'> 0 </option>";
        }
        die($tmp);
        }
    

	
	Public function Insert() 
	{
		if($this->session->userdata('login'))
        {
        $session = $this->session->userdata('login');
		$menu_id_menu_details = 26;  //custom by database
		$access = $this->model_menu->selectaccess($session['id_level'], $menu_id_menu_details);
        if(!empty($access['id_menu_details'])){
        $a = $this->input->post ('id_rute');
        $b = $this->input->post ('tarif_a');
        $c = $this->input->post ('tarif_b');
        
        $f = $this->input->post ('berat');
        $g = $this->input->post ('jumlah');
        $h = $this->input->post ('panjang');
        $i = $this->input->post ('lebar');
        $j = $this->input->post ('tinggi');
        $k = $this->input->post ('dimensi');
        $l = $this->input->post ('tarif');
        $m = $this->input->post ('no_ktp_pengirim');
       
        $o = $this->input->post ('nm_pengirim');
        $p = $this->input->post ('nm_penerima');
        $q = $this->input->post ('no_tlp_pengirim');
        $r = $this->input->post ('no_tlp_penerima');
        $s = $this->input->post ('alamat_pengirim');
        $t = $this->input->post ('alamat_penerima');
        $u = $this->input->post ('agree');
        $v = $this->input->post ('estimasi');
        $w = $this->input->post ('kd_resi_manual');

        if (empty($u)){
        	echo "<script>alert('Anda Masih Belum setuju');window.location.href='javascript:history.back(-1);'</script>";
		}else{
        if (empty($a)){
            echo "<script>alert('Data ID Rute Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($b) && empty($c)){
            echo "<script>alert('Data Tarif Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($f)){
            echo "<script>alert('Data Berat Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($g)){
            echo "<script>alert('Data Jumlah Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($h) && empty($i) && empty($j) ){
            echo "<script>alert('Data Panjang / Lebar / Tinggi Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($m)){
            echo "<script>alert('Data NO KTP Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($o)){
            echo "<script>alert('Data Nama Pengirim Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($p)){
            echo "<script>alert('Data Nama Penerima Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($q)){
            echo "<script>alert('Data No. Tlp Pengirim Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($r)){
            echo "<script>alert('Data No. Tlp Penerima Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($s)){
            echo "<script>alert('Data Alamat Pengirim Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($t)){
            echo "<script>alert('Data Alamat Penerima Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
        if (empty($v)){
            echo "<script>alert('Data Estimasi Kosong');window.location.href='javascript:history.back(-1);'</script>";
        }else{
		//insert semua data yang ada pada table
		$rute = $this->model_resi->selectrute($this->input->post ('id_rute'));
		$data = array(
		'id_daerah' => $this->input->post ('id_daerah'),
   		'id_cabang_asal' => $rute['id_cabang_asal'],
   		'id_cabang_tujuan' => $rute['id_cabang_tujuan'],
   		'jenis' => $this->input->post ('jenis'),
   		'no_ktp_pengirim' => $this->input->post ('no_ktp_pengirim'),
   		'note' => $this->input->post ('note'),
        'layanan' => $this->input->post ('layanan'),
   		'nm_pengirim' => $this->input->post ('nm_pengirim'),
   		'nm_penerima' => $this->input->post ('nm_penerima'),
   		'no_tlp_pengirim' => $this->input->post ('no_tlp_pengirim'),
   		'no_tlp_penerima' => $this->input->post ('no_tlp_penerima'),
   		'alamat_pengirim' => $this->input->post ('alamat_pengirim'),
   		'alamat_penerima' => $this->input->post ('alamat_penerima'),
   		'berat' => $this->input->post ('berat'),
        'berat_dimensi' => $this->input->post ('berat_dimensi'),
   		'panjang' => $this->input->post ('panjang'),
   		'lebar' => $this->input->post ('lebar'),
   		'tinggi' => $this->input->post ('tinggi'),
   		'dimensi' => $this->input->post ('dimensi'),
   		'jumlah' => $this->input->post ('jumlah'),
        'active' => $this->input->post ('active'),
   		'asuransi' => $this->input->post ('asuransi'),
        'courier' => $this->input->post ('courier'),
        'tarif' => $this->input->post ('tarif'),
        'estimasi' => $this->input->post ('estimasi'),
        'kd_resi_manual' => $this->input->post ('kd_resi_manual'),
   		'cuser' => $session['id_user']
		);	
		$this->model_resi->Insertresi($data);

		redirect('resi');
    }}}}}}}}}}}}
		}}
		}else{
		echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";	
		}
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

	Public function Delete($id_resi) 
	{
		if($this->session->userdata('login'))
        {
		$session = $this->session->userdata('login');
		$menu_id_menu_details = 26;  //custom by database
		$access = $this->model_menu->selectaccess($session['id_level'], $menu_id_menu_details);
        if(!empty($access['id_menu_details'])){
		//delete data yang ada pada table
		$this->model_resi->Deletetresi($id_resi);
		redirect('resi');
		}else{
		echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";	
		}
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}
	
	

	Public function Update($id_resi) 
	{
		if($this->session->userdata('login'))
        {
        $session = $this->session->userdata('login');
		$menu_id_menu_details = 26;  //custom by database
		$access = $this->model_menu->selectaccess($session['id_level'], $menu_id_menu_details);
        if(!empty($access['id_menu_details'])){
        $a = $id_resi;
        if (empty($a)){
			echo "<script>alert('ID Resi Kosong');window.location.href='javascript:history.back(-1);'</script>";
		}else{
		
		$data = array(
		
   		'status' => 1,
				
		);	
		$this->model_resi->Updateresi($id_resi, $data);
		redirect('resi');
		}
		}else{
		echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";	
		}
		}else{
		redirect('welcome/relogin','refresh');	
		}
	}

    public function pdf_resi($id_resi)
    {
        
        
        $data['resi'] = $this->model_resi->getAlldetail($id_resi);
      
         $this->load->view('resi/resi', $data);
    }

    public function cetak_baru($id_resi){
        ob_start();
        $data['resi'] = $this->model_resi->getAlldetail($id_resi);
        $this->load->view('resi/resi2', $data);
        $html = ob_get_contents();
        ob_end_clean();
         
        require_once('./assets/html2pdf/html2pdf.class.php');
        
        $pdf = new HTML2PDF('L','A5','en', false, 'ISO-8859-15',array(3, 3, 3, 3));
        $pdf->setDefaultFont("arial");
        $pdf->pdf->SetDisplayMode('fullpage');
        $pdf->WriteHTML($html);
        $pdf->Output('resi'.$id_resi.'.pdf');
    }
    public function ctk($id_resi){
    ob_start();
    $data['resi'] = $this->model_resi->getAlldetail($id_resi);
    $this->load->view('resi/resi2', $data);
    $content = ob_get_clean();

    // convert to PDF
    require_once('./assets/html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('L','A5','en', false, 'ISO-8859-15',array(2, 2, 2, 2));
        //$html2pdf->setDefaultFont("arial");
        $html2pdf->pdf->SetDisplayMode('fullpage');
//      $html2pdf->pdf->SetProtection(array('print'), 'spipu');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('exemple07.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
    }

    public function cetak3($id_resi){
        ob_start();
        $data['resi'] = $this->model_resi->getAlldetail($id_resi);
        $this->load->view('resi/resi2', $data);
        $html = ob_get_contents();
        ob_end_clean();
         
        require_once('./assets/html2pdf/html2pdf.class.php');
        
        $pdf = new HTML2PDF('L','A5','en', false, 'ISO-8859-15',array(3, 3, 3, 3));
        $pdf->setDefaultFont("arial");
        $pdf->WriteHTML($html);
        $pdf->Output('resi'.$id_resi.'.pdf', 'D');
    }

   
}
