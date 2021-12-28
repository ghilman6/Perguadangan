<?php
    class Model_pengiriman extends CI_Model
    {
        public function getAllpengiriman($show=null, $start=null, $cari=null, $active)
        {
            $this->db->select("a.id_pengiriman, a.kd_pengiriman, a.tgl_pengiriman, a.id_armada, c.kd_armada, d.nm_armada_jenis, a.active, (select count(e.id_pengiriman_detail) from tr_pengiriman_detail e where e.id_pengiriman = a.id_pengiriman) as jml");
            $this->db->from("tr_pengiriman a");
			$this->db->join("ref_armada c", "a.id_armada = c.id_armada", "left");
			$this->db->join("ref_armada_jenis d", "c.id_armada_jenis = d.id_armada_jenis", "left");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.kd_pengiriman  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active = '".$active."' ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_pengiriman($search = null, $active)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_pengiriman) as recordsFiltered ");
			$this->db->from("tr_pengiriman");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active = '".$active."' ");
			$this->db->like("tgl_pengiriman ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_pengiriman) as recordsTotal ");
			$this->db->from("tr_pengiriman");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active = '".$active."' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}

		public function getAllpengiriman_detail($show=null, $start=null, $cari=null, $id_pengiriman)
        {
            $this->db->select("a.id_pengiriman_detail, a.id_pengiriman, a.id_keluar, a.id_toko, c.nm_toko, a.status,  a.active, b.kd_keluar, b.tgl_keluar");
            $this->db->from("tr_pengiriman_detail a");
			$this->db->join("tr_keluar b", "a.id_keluar = b.id_keluar", "left");
			$this->db->join("ref_toko c", "a.id_toko = c.id_toko", "left");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where('a.id_pengiriman', $id_pengiriman);
        	$this->db->where("(a.id_pengiriman  LIKE '%".$cari."%' or a.id_pengiriman  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }

        public function get_count_pengiriman_detail($search = null, $id_pengiriman)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(a.id_pengiriman_detail) as recordsFiltered ");
			$this->db->from("tr_pengiriman_detail a");
			$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
			$this->db->where('a.id_pengiriman', $id_pengiriman);
			$this->db->where("(a.id_pengiriman  LIKE '%".$search."%' or a.id_pengiriman  LIKE '%".$search."%' ) ");
			$this->db->where("a.active != '2' ");
			
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_pengiriman_detail) as recordsTotal ");
			$this->db->from("tr_pengiriman_detail");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where('id_pengiriman', $id_pengiriman);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}

        public function getAllkeluar($show=null, $start=null, $cari=null)
        {
            $this->db->select("a.id_keluar, a.kd_keluar, a.tgl_keluar, a.id_toko, b.nm_toko");
            $this->db->from("tr_keluar a");
			$this->db->join("ref_toko b", "a.id_toko = b.id_toko", "left");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.kd_keluar  LIKE '%".$cari."%' or a.tgl_keluar  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active = 2 ");
            $this->db->where("a.pengiriman = 1 ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }

        public function get_count_keluar($search = null)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_pengiriman) as recordsFiltered ");
			$this->db->from("tr_pengiriman");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active = 2 ");
			$this->db->like("kd_pengiriman ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_pengiriman) as recordsTotal ");
			$this->db->from("tr_pengiriman");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active = 2 ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}

		public function insert_pengiriman($data)
        {
            $this->db->insert('tr_pengiriman', $data);
			return $this->db->insert_id();
        }

        public function insert_pengiriman_detail($data)
        {
            $this->db->insert('tr_pengiriman_detail', $data);
			return $this->db->insert_id();
        }

        public function app_pengiriman($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_pengiriman', $data['id_pengiriman']);
            $this->db->update('tr_pengiriman', array('active' => '2'));
			return $data['id_pengiriman'];
        }

		public function delete_pengiriman($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_pengiriman', $data['id_pengiriman']);
            $this->db->delete('tr_pengiriman');
			return $data['id_pengiriman'];
        }

        public function delete_pengiriman_detail($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_pengiriman_detail', $data['id_pengiriman_detail']);
            $this->db->delete('tr_pengiriman_detail');
			return $data['id_pengiriman_detail'];
        }
		
        public function update_pengiriman($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_pengiriman', $data['id_pengiriman']);
			$this->db->where("active != '2' ");
            $this->db->update('tr_pengiriman', $data);
			return $data['id_pengiriman'];
        }
		
		public function get_pengiriman_by_id($id_pengiriman)
		{
			if(empty($id_pengiriman))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->select("a.id_pengiriman, a.kd_pengiriman, a.tgl_pengiriman, a.id_armada, c.kd_armada, d.nm_armada_jenis, a.active");
				$this->db->from("tr_pengiriman a");
				$this->db->join("ref_armada c", "a.id_armada = c.id_armada", "left");
				$this->db->join("ref_armada_jenis d", "c.id_armada_jenis = d.id_armada_jenis", "left");
				$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
				$this->db->where('a.id_pengiriman', $id_pengiriman);
				$this->db->where("a.active != '2' ");
				return $this->db->get()->row_array();
			}
		}

        public function get_keluar_by_id($id_keluar)
		{
			if(empty($id_keluar))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->select("a.id_keluar, a.kd_keluar, a.tgl_keluar, a.id_toko");
				$this->db->from("tr_keluar a");
				$this->db->where('a.id_keluar', $id_keluar);
				return $this->db->get()->row_array();
			}
		}

		public function combobox_toko()
        {
            $this->db->from("ref_toko");
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('active', 1);
            return $this->db->get();
        }

		public function combobox_armada()
        {
            $this->db->from("ref_armada");
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('active', 1);
            return $this->db->get();
        }

		

    }
