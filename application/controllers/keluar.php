<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class keluar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("model_keluar");
        $this->load->model("model_menu");
        ///constructor yang dipanggil ketika memanggil ro.php untuk melakukan pemanggilan pada model : ro.php yang ada di folder models
    }

    public function index()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G02";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $data['id_user'] = $session['id_user'];
                $data['nm_user'] = $session['nm_user'];
                $data['session_level'] = $session['id_level'];
                $data['combobox_toko'] = $this->model_keluar->combobox_toko();
                $this->load->view('keluar/index', $data);
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

    public function details($id_keluar)
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G02";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $data['id_user'] = $session['id_user'];
                $data['nm_user'] = $session['nm_user'];
                $data['session_level'] = $session['id_level'];
                $data['combobox_toko'] = $this->model_keluar->combobox_toko();
                $data['id_keluar'] = $id_keluar;
                $this->load->view('keluar/details', $data);
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

    public function lists($id_keluar)
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G02";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $data['id_user'] = $session['id_user'];
                $data['nm_user'] = $session['nm_user'];
                $data['session_level'] = $session['id_level'];
                $data['combobox_toko'] = $this->model_keluar->combobox_toko();
                $data['id_keluar'] = $id_keluar;
                $this->load->view('keluar/list', $data);
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

    public function ax_data_keluar()
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
            $data = $this->model_keluar->getAllkeluar($length, $start, $cari['value'], $active)->result_array();
            $count = $this->model_keluar->get_count_keluar($cari['value'], $active);

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
            $menu_kd_menu_details = "G02";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

            $start = $this->input->post('start');
            $draw = $this->input->post('draw');
            $length = $this->input->post('length');
            $cari = $this->input->post('search', true);
            $data = $this->model_keluar->getAllbarang($length, $start, $cari['value'])->result_array();
            $count = $this->model_keluar->get_count_barang($cari['value']);

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

    public function ax_data_keluar_detail()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G02";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

            $id_keluar = $this->input->post('id_keluar');
            $start = $this->input->post('start');
            $draw = $this->input->post('draw');
            $length = $this->input->post('length');
            $cari = $this->input->post('search', true);
            $data = $this->model_keluar->getAllkeluar_detail($length, $start, $cari['value'], $id_keluar)->result_array();
            $count = $this->model_keluar->get_count_keluar_detail($cari['value'], $id_keluar);

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

            $id_keluar = $this->input->post('id_keluar');
            $tgl_keluar = $this->input->post('tgl_keluar');
            $id_toko = $this->input->post('id_toko');
    		$active = $this->input->post('active');
    		$session = $this->session->userdata('login');
    		$data = array(
                'id_keluar' => $id_keluar,
                'tgl_keluar' => $tgl_keluar,
                'id_toko' => $id_toko,
    			'active' => $active,
    			'id_perusahaan' => $session['id_perusahaan'],
                'cuser' => $session['id_user']
    		);
    		
    		if(empty($id_keluar))
    			$data['id_keluar'] = $this->model_keluar->insert_keluar($data);
    		else
    			$data['id_keluar'] = $this->model_keluar->update_keluar($data);
    		
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
            $menu_kd_menu_details = "G02";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

            $id_keluar = $this->input->post('id_keluar');
            $id_stok = $this->input->post('id_stok');
            $qty = $this->input->post('qty');
    		$session = $this->session->userdata('login');
    		$data = array(
                'id_keluar' => $id_keluar,
                'id_stok' => $id_stok,
                'qty' => $qty,
                'active' => 1,
    			'id_perusahaan' => $session['id_perusahaan'],
                'cuser' => $session['id_user']
    		);
    		
    			$data['id_keluar_detail'] = $this->model_keluar->insert_keluar_detail($data);
    	
    		
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

    public function ax_set_allocation()
	{
		if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "G02";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

            $id_keluar = $this->input->post('id_keluar');
            $id_barang = $this->input->post('id_barang');
            $qty = $this->input->post('qty');
            $allocation = $this->input->post('allocation');
    		$session = $this->session->userdata('login');
    		$data = array(
                'id_keluar' => $id_keluar,
                'id_barang' => $id_barang,
                'qty' => $qty,
                'allocation' => $allocation,
                'active' => 1,
    			'id_perusahaan' => $session['id_perusahaan'],
                'cuser' => $session['id_user']
    		);
    		
    			$data['id_keluar_detail'] = $this->model_keluar->insert_allocation($data);
    	
    		
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

            $id_keluar = $this->input->post('id_keluar');
    		
    		$data = array('id_keluar' => $id_keluar);
    		
    		if(!empty($id_keluar))
    			$data['id_keluar'] = $this->model_keluar->delete_keluar($data);
    		
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

            $id_keluar = $this->input->post('id_keluar');
    		
    		$data = array('id_keluar' => $id_keluar, 'active' => 2);
    		
    		if(!empty($id_keluar))
    			$data['id_keluar'] = $this->model_keluar->app_keluar($data);
    		
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
            $menu_kd_menu_details = "G02";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

            $id_keluar_detail = $this->input->post('id_keluar_detail');
    		
    		$data = array('id_keluar_detail' => $id_keluar_detail);
    		
    		if(!empty($id_keluar_detail))
    			$data['id_keluar_detail'] = $this->model_keluar->delete_keluar_detail($data);
    		
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

    		$id_keluar = $this->input->post('id_keluar');
    		
    		if(empty($id_keluar))
    			$data = array();
    		else
    			$data = $this->model_keluar->get_keluar_by_id($id_keluar);
    		
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
            $menu_kd_menu_details = "G02";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {

    		$id_stok = $this->input->post('id_stok');
    		
    		if(empty($id_stok))
    			$data = array();
    		else
    			$data = $this->model_keluar->get_barang_by_id($id_stok);
    		
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
    public function cetakDataKeluar() {
        $id_keluar = $this->input->get('id_keluar');
        $logo = base_url();
        $id_keluar_detail = $this->input->get('id_keluar_detail');
        // print_r($id_masuk);return;
        $sql = $this->db->query("select a.id_keluar, a.kd_keluar, a.tgl_keluar, b.nm_toko, b.alamat_toko ,(select count(c.id_keluar_detail) from tr_keluar_detail c where c.id_keluar = '$id_keluar') as jml from tr_keluar as a
                                inner join ref_toko as b on a.id_toko = b.id_toko where id_keluar = '$id_keluar'  ");
        $cRet = '';

        $cRet .= "
            <table align=\"center\" border=\"0\" width=\"100%\">
                <tr>
                    <td  > <img src='".$logo."assets/img/logos.png' width=\"160\" > </td>
                    <td style=\"font-size:18px;\" width=\"10%\" rowspan=\"1\">  </td>
                    <td style=\"font-size:28px; color:#4d88ff; font-family:verdana;\"  width=\"55%\" rowspan=\"2\"><b> Laporan Barang Keluar </td>
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
                    <td style=\"font-size:16px;\" align=\"left\" width=\"15%\"><b>Toko: </td>
                    <td width=\"35%\" > </td>
                    <td style =\"background-color:#babfba\" width=\"27%\" align=\"center\" ><b>Tanggal Keluar</td>
                    <td style =\"background-color:#babfba\" width=\"26%\" align=\"center\"><b>Jumlah Total Barang</td>
                </tr>
                <tr>
                    <td align=\"left\" width=\"15%\"><b>$row->nm_toko</td>
                    <td width=\"35%\" > </td>
                    <td style =\"background-color:#ebf0eb\" width=\"27%\" align=\"center\"><b> $row->tgl_keluar </td>
                    <td style =\"background-color:#ebf0eb\" width=\"26%\" align=\"center\" ><b> $row->jml</td>
                    
                </tr>
                <tr >
                    <td align=\"left\" width=\"15%\">$row->alamat_toko</td>
                    <td align=\"left\" width=\"35%\"> </td>
                    <td align=\"left\" width=\"27%\" ><b> Kode Keluar </td>
                    <td align=\"left\" width=\"26%\"> : $row->kd_keluar</td>
                </tr>
       
        </table><br>";
        }
        $sql1 = $this->db->query("select * from tr_keluar_detail as a where id_keluar = '$id_keluar' ");

        $cRet .= "
            <table style=\"border-collapse:collapse;\"  width=\"70%\" border=\"1\" align=\"center\">
                <thead style=\"background-color:#6699ff; font-family:verdana;\">
                    <tr>
                        <th style=\"background-color:grey; font-family:verdana;\">Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Tanggal Exp</th>
                        <th>Satuan</th>
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
                    <td>$row->nm_satuan</td>
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
