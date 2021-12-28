<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class zone extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("model_zone");
        $this->load->model("model_menu");
        ///constructor yang dipanggil ketika memanggilro.php untuk melakukan pemanggilan pada model : ro.php yang ada di folder models
    }

    public function index()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "M21";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $data['id_user'] = $session['id_user'];
                $data['nm_user'] = $session['nm_user'];
                $data['session_level'] = $session['id_level'];
                $this->load->view('zone/index', $data);
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

    public function Insert()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "M21";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $a = $this->input->post('nm_zone');
                if (empty($a)) {
                    echo "<script>alert('Data Masih Ada Yang Kosong');window.location.href='javascript:history.back(-1);'</script>";
                } else {
                    $data = array(

                        'id_perusahaan' => $session['id_perusahaan'],
                        'nm_zone' => $this->input->post('nm_zone'),
                        'cuser' => $session['id_user'],
                        'active' => $this->input->post('active'),
                        'cdate' => date("Y-m-d h:i:s")
                    );
                    $this->model_zone->Insertzone($data);
                    redirect('zone');
                }
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            redirect('welcome/relogin', 'refresh');
        }
    }

    public function Delete($id_zone)
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "M21";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                //delete data yang ada pada table
                $this->model_zone->Deletezone($id_zone);
                redirect('zone');
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            redirect('welcome/relogin', 'refresh');
        }
    }

    public function Update()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $menu_kd_menu_details = "M21";  //custom by database
            $access = $this->model_menu->selectaccess($session['id_level'], $menu_kd_menu_details);
            if (!empty($access['id_menu_details'])) {
                $a = $this->input->post('nm_zone');
                if (empty($a)) {
                    echo "<script>alert('Data Masih Ada Yang Kosong');window.location.href='javascript:history.back(-1);'</script>";
                } else {
                    $id_zone = $this->input->post('id_zone');
                    $data = array(

                        'nm_zone' => $this->input->post('nm_zone'),
                        'cuser' => $session['id_user'],
                        'active' => $this->input->post('active')
                    );
                    $this->model_zone->Updatezone($id_zone, $data);
                    redirect('zone');
                }
            } else {
                echo "<script>alert('Anda tidak mendapatkan access menu ini');window.location.href='javascript:history.back(-1);'</script>";
            }
        } else {
            redirect('welcome/relogin', 'refresh');
        }
    }

    public function ax_data_zone()
    {
        $start = $this->input->post('start');
        $draw = $this->input->post('draw');
        $length = $this->input->post('length');
        $cari = $this->input->post('search', true);
        $data = $this->model_zone->getAllzone($length, $start, $cari['value'])->result_array();
        $count = $this->model_zone->get_count_zone($cari['value']);

        echo json_encode(array('recordsTotal' => $count['recordsTotal'], 'recordsFiltered' => $count['recordsFiltered'], 'draw' => $draw, 'search' => $cari['value'], 'data' => $data));
    }
	
	public function ax_set_data()
	{
		$id_zone = $this->input->post('id_zone');
		$nm_zone = $this->input->post('nm_zone');
		$active = $this->input->post('active');
		
		$session = $this->session->userdata('login');
		$data = array(
			'id_zone' => $id_zone,
			'nm_zone' => $nm_zone,
			'active' => $active,
			'id_perusahaan' => $session['id_perusahaan'],
			'cuser' => $session['id_user']
		);
		
		if(empty($id_zone))
			$data['id_zone'] = $this->model_zone->insert_zone($data);
		else
			$data['id_zone'] = $this->model_zone->update_zone($data);
		
		echo json_encode(array('status' => 'success', 'data' => $data));
	}
	
	public function ax_unset_data()
	{
		$id_zone = $this->input->post('id_zone');
		
		$data = array('id_zone' => $id_zone);
		
		if(!empty($id_zone))
			$data['id_zone'] = $this->model_zone->delete_zone($data);
		
		echo json_encode(array('status' => 'success', 'data' => $data));
	}
	
	public function ax_get_data_by_id()
	{
		$id_zone = $this->input->post('id_zone');
		
		if(empty($id_zone))
			$data = array();
		else
			$data = $this->model_zone->get_zone_by_id($id_zone);
		
		echo json_encode($data);
	}
}
