<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("model_menu");
        $this->load->model("model_home");
        ///constructor yang dipanggil ketika memanggil ro.php untuk melakukan pemanggilan pada model : ro.php yang ada di folder models
    }
	
	public function index()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $data['nm_user'] = $session['nm_user'];
            $data['keterangan'] = $session['keterangan'];
            $data['id_user'] = $session['id_user'];
            $data['session_level'] = $session['id_level'];
			$data['JmlBarangMasuk'] = $this->model_home->get_count_masuk()->row()->JmlBarangMasuk;
			$data['JmlBarangKeluar'] = $this->model_home->get_count_keluar()->row()->JmlBarangKeluar;
            
            $this->load->view('home', $data);

            
        } else {
            redirect('welcome/relogin', 'refresh');
        }

    }
	
    public function dashboard()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');
            $data['nm_user'] = $session['nm_user'];
            $data['keterangan'] = $session['keterangan'];
            $data['id_user'] = $session['id_user'];
            $data['session_level'] = $session['id_level'];
            $data['datapaketchartweek'] = $this->model_home->datapaketchartweek();
            $data['datarevenuechartmonth'] = $this->model_home->datarevenuechartmonth();
			
            $this->load->view('home', $data);
                
            
        } else {
            redirect('welcome/relogin', 'refresh');
        }

    }


    public function Update()
    {
        if ($this->session->userdata('login')) {
            $session = $this->session->userdata('login');

            $a = $this->input->post('password_lama');
            $b = $this->input->post('password_baru');
            if (empty($a)or empty($b)) {
                echo "<script>alert('Data Masih Ada Yang Kosong');window.location.href='javascript:history.back(-1);'</script>";
            } else {
                $c = do_hash($this->input->post('password_lama'), 'md5');
                $d = $session['password'];
                if ($d != $c) {
                    echo "<script>alert('Password Lama Salah');window.location.href='javascript:history.back(-1);'</script>";
                } else {
                    $id_user = $session['id_user'];
                    $data = array(

        'password' => do_hash($this->input->post('password_baru'), 'md5'),

        );
                    $this->model_home->UpdateUser($id_user, $data);
                    redirect('welcome/logout');
                }
            }
        } else {
            redirect('welcome/relogin', 'refresh');
        }
    }

    public function get_data_dashboard()
    {
    
        $count = $this->model_home->countdata();
        $data = $this->model_home->getdata()->result_array();

        echo json_encode(array('ccheckin'=>$count['ccheckin'], 'cwloading'=>$count['cwloading'], 'cloading'=>$count['cloading'], 'cdelivery'=>$count['cdelivery'], 'data' => $data, 'recordsTotal' => $count['recordsTotal'], 'recordsFiltered' => $count['recordsFiltered'], 'draw' => 1, 'search' => ''));
    }
}
