<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class masuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("model_masuk");
        $this->load->model("model_menu");
        ///constructor yang dipanggil ketika memanggil ro.php untuk melakukan pemanggilan pada model : ro.php yang ada di folder models
    }

    public function index()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G01";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $data['id_user'] = $session['id_user'];
                $data['nm_user'] = $session['nm_user'];
                $data['session_level'] = $session['id_level'];
                $data['combobox_supplier'] = $this->model_masuk->combobox_supplier();
                $this->load->view('masuk/index', $data);
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function details($id_masuk)
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G01";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $data['id_user'] = $session['id_user'];
                $data['nm_user'] = $session['nm_user'];
                $data['session_level'] = $session['id_level'];
                $data['id_masuk'] = $id_masuk;
                $this->load->view('masuk/details', $data);
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function lists($id_masuk)
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G01";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $data['id_user'] = $session['id_user'];
                $data['nm_user'] = $session['nm_user'];
                $data['session_level'] = $session['id_level'];
                $data['id_masuk'] = $id_masuk;
                $this->load->view('masuk/list', $data);
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    

    public function ax_data_masuk()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G01";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

            $active = $this->input->post('active');
            $start = $this->input->post('start');
            $draw = $this->input->post('draw');
            $length = $this->input->post('length');
            $cari = $this->input->post('search', true);
            $data = $this->model_masuk->getAllmasuk($length, $start, $cari['value'], $active)->result_array();
            $count = $this->model_masuk->get_count_masuk($cari['value'], $active);

            echo json_encode(array('recordsTotal' => $count['recordsTotal'], 'recordsFiltered' => $count['recordsFiltered'], 'draw' => $draw, 'search' => $cari['value'], 'data' => $data));
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function ax_data_barang()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G01";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

            $start = $this->input->post('start');
            $draw = $this->input->post('draw');
            $length = $this->input->post('length');
            $cari = $this->input->post('search', true);
            $data = $this->model_masuk->getAllbarang($length, $start, $cari['value'])->result_array();
            $count = $this->model_masuk->get_count_barang($cari['value']);

            echo json_encode(array('recordsTotal' => $count['recordsTotal'], 'recordsFiltered' => $count['recordsFiltered'], 'draw' => $draw, 'search' => $cari['value'], 'data' => $data));
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }

    public function ax_data_masuk_detail()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G01";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

            $id_masuk = $this->input->post('id_masuk');
            $start = $this->input->post('start');
            $draw = $this->input->post('draw');
            $length = $this->input->post('length');
            $cari = $this->input->post('search', true);
            $data = $this->model_masuk->getAllmasuk_detail($length, $start, $cari['value'], $id_masuk)->result_array();
            $count = $this->model_masuk->get_count_masuk_detail($cari['value'], $id_masuk);

            echo json_encode(array('recordsTotal' => $count['recordsTotal'], 'recordsFiltered' => $count['recordsFiltered'], 'draw' => $draw, 'search' => $cari['value'], 'data' => $data));
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
    }
	
	public function ax_set_data()
	{
		if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G01";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

            $id_masuk = $this->input->post('id_masuk');
            $kd_masuk = $this->input->post('kd_masuk');
            $tgl_masuk = $this->input->post('tgl_masuk');
            $id_supplier = $this->input->post('id_supplier');
    		$session = $this->session->userdata('login');
    		$data = array(
                'id_masuk' => $id_masuk,
                'kd_masuk' => $kd_masuk,
                'tgl_masuk' => $tgl_masuk,
                'id_supplier' => $id_supplier,
    			'id_perusahaan' => $session['id_perusahaan'],
                'cuser' => $session['id_user']
    		);
    		
    		if(empty($id_masuk))
    			$data['id_masuk'] = $this->model_masuk->insert_masuk($data);
    		else
    			$data['id_masuk'] = $this->model_masuk->update_masuk($data);
    		
    		echo json_encode(array('status' => 'success', 'data' => $data));

        } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
	}


    public function ax_set_details()
	{
		if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G01";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

            $id_masuk = $this->input->post('id_masuk');
            $id_barang = $this->input->post('id_barang');
            $tgl_exp = $this->input->post('tgl_exp');
            $qty = $this->input->post('qty');
            $harga = $this->input->post('harga');
    		$session = $this->session->userdata('login');
    		$data = array(
                'id_masuk' => $id_masuk,
                'id_barang' => $id_barang,
                'tgl_exp' => $tgl_exp,
                'qty' => $qty,
                'harga' => $harga,
    			'active' => 1,
    			'id_perusahaan' => $session['id_perusahaan'],
                'cuser' => $session['id_user']
    		);
    		
    			$data['id_masuk_detail'] = $this->model_masuk->insert_masuk_detail($data);
    	
    		
    		echo json_encode(array('status' => 'success', 'data' => $data));

        } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
	}

    public function ax_app_data()
	{
		if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G01";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

            $id_masuk = $this->input->post('id_masuk');
    		
    		$data = array('id_masuk' => $id_masuk, 'active' => 2);
    		
    		if(!empty($id_masuk))
    			$data['id_masuk'] = $this->model_masuk->app_masuk($data);
    		
    		echo json_encode(array('status' => 'success', 'data' => $data));

        } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
	}
	
	public function ax_unset_data()
	{
		if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G01";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

            $id_masuk = $this->input->post('id_masuk');
    		
    		$data = array('id_masuk' => $id_masuk);
    		
    		if(!empty($id_masuk))
    			$data['id_masuk'] = $this->model_masuk->delete_masuk($data);
    		
    		echo json_encode(array('status' => 'success', 'data' => $data));

        } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
	}

    public function ax_unset_detail()
	{
		if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G01";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

            $id_masuk_detail = $this->input->post('id_masuk_detail');
    		
    		$data = array('id_masuk_detail' => $id_masuk_detail);
    		
    		if(!empty($id_masuk_detail))
    			$data['id_masuk_detail'] = $this->model_masuk->delete_masuk_detail($data);
    		
    		echo json_encode(array('status' => 'success', 'data' => $data));

        } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
	}


    
	
	public function ax_get_data_by_id()
	{
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G01";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

    		$id_masuk = $this->input->post('id_masuk');
    		
    		if(empty($id_masuk))
    			$data = array();
    		else
    			$data = $this->model_masuk->get_masuk_by_id($id_masuk);
    		
    		echo json_encode($data);

        } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
	}

    public function ax_get_barang_by_id()
	{
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G01";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

    		$id_barang = $this->input->post('id_barang');
    		
    		if(empty($id_barang))
    			$data = array();
    		else
    			$data = $this->model_masuk->get_barang_by_id($id_barang);
    		
    		echo json_encode($data);

        } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            if ($this->uri->segment(1) != null) {
                $url = $this->uri->segment(1);
                $url = $url.' '.$this->uri->segment(2);
                $url = $url.' '.$this->uri->segment(3);
                redirect('welcome/relogin/?url='.$url.'', 'refresh');
            } else {
                redirect('welcome/relogin', 'refresh');
            }
        }
	}

    public function cetakDataMasuk() {
        $id_masuk = $this->input->get('id_masuk');
        $logo = base_url();
        $id_masuk_detail = $this->input->get('id_masuk_detail');
        // print_r($id_masuk);return;
        $sql = $this->db->query("select a.id_masuk, a.kd_masuk, a.tgl_masuk, b.nm_supplier, b.alamat_supplier, (select count(c.id_masuk_detail) from tr_masuk_detail c where c.id_masuk = '$id_masuk') as jml from tr_masuk as a
                                inner join ref_supplier as b on a.id_supplier = b.id_supplier where id_masuk = '$id_masuk'  ");
        $cRet = '';

        $cRet .= "
            <table align=\"center\" border=\"0\" width=\"100%\">
                <tr>
                    <td  > <img src='".$logo."assets/img/logos.png' width=\"160\" > </td>
                    <td style=\"font-size:18px;\" width=\"10%\" rowspan=\"1\">  </td>
                    <td style=\"font-size:28px; color:#4d88ff; font-family:verdana;\"  width=\"55%\" rowspan=\"2\"><b> Laporan Barang Masuk </td>
                </tr>
                <tr>
                    <td style=\"font-size:18px; \" width=\"33%\"><b> PERUM DAMRI </td>
                </tr>
                <tr>
                    <td style=\"font-size:12px;\"  width=\"35%\" > Jl. Matraman Raya No.25 <br> Daerah Khusus Ibukota Jakarta 13140 <br> Phone (021) 1500825 </td>
                </tr>
                
            </table>
            <hr width=\"100%\" color=\"black\">";
        foreach($sql->result() as $row){
        $cRet .= "<table align=\"center\"  border=\"0\" style=\"font-size:14px;\" width=\"100%\"  >
                <tr>
                    <td style=\"font-size:16px;\" align=\"left\" width=\"15%\"><b>Supplier: </td>
                    <td width=\"35%\" > </td>
                    <td style =\"background-color:#babfba\" width=\"27%\" align=\"center\" ><b>Tanggal Masuk</td>
                    <td style =\"background-color:#babfba\" width=\"26%\" align=\"center\"><b>Jumlah Total Barang</td>
                </tr>
                <tr>
                    <td align=\"left\" width=\"15%\"><b>$row->nm_supplier</td>
                    <td width=\"35%\" > </td>
                    <td style =\"background-color:#ebf0eb\" width=\"27%\" align=\"center\"><b> $row->tgl_masuk </td>
                    <td style =\"background-color:#ebf0eb\" width=\"26%\" align=\"center\" ><b> $row->jml</td>
                    
                </tr>
                <tr >
                    <td align=\"left\" width=\"15%\">$row->alamat_supplier</td>
                    <td align=\"left\" width=\"35%\"> </td>
                    <td align=\"left\" width=\"27%\" ><b> Kode Masuk </td>
                    <td align=\"left\" width=\"26%\"> : $row->kd_masuk</td>
                </tr>
       
        </table><br>";
    }
        $sql1 = $this->db->query("select * from tr_masuk_detail as a where id_masuk = '$id_masuk' ");

        $cRet .= "
            <table style=\"border-collapse:collapse;\"  width=\"70%\" border=\"1\" align=\"center\">
                <thead style=\"background-color:#6699ff; font-family:verdana;\">
                    <tr>
                        <th style=\"background-color:grey; font-family:verdana;\">Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Exp</th>
                        <th>Qty</th>
                        <th>Harga</th>
                    </tr>
                </thead> ";
        

        foreach($sql1->result() as $row){
            $cRet.="<tbody>
                <tr>
                    <td>$row->kd_barang</td>
                    <td>$row->nm_barang</td>
                    <td>$row->tgl_exp</td>
                    <td>$row->qty</td>
                    <td>$row->harga</td>
                </tr>
            </tbody>";  
            
        }
    $cRet.="</table><br><br>";
    $cRet.= "
            <footer>
            <table align=\"center\"  border=\"0\"  width=\"100%\"  >
                <tr>
                <td  align=\"center\" style=\"font-size:18px;\" width=\"15%\"><b> Pengirim </td>
                <td style=\"font-size:18px;\" align=\"left\"  width=\"30%\"></td>
                <td  align=\"center\" style=\"font-size:18px;\" align=\"left\" width=\"35%\"><b> Penerima  </td>
                </tr>
                <tr >
                    <td align=\"center\" style=\"font-size:18px; padding-top: 150px;\" align=\"left\" width=\"26%\"><hr width=\"80%\" color=\"black\"> </td>
                    <td style=\"font-size:18px;\" width=\"27%\" > </td>
                    <td align=\"center\" style=\"font-size:18px; padding-top: 150px;\" width=\"26%\" ><hr width=\"70%\" color=\"black\"></td>
                </tr>
            
            </table>
            </footer>
            <br><br>";

    echo $cRet;
    
    }
}
