<?php
    class Model_keluar extends CI_Model
    {
        public function getAllkeluar($show=null, $start=null, $cari=null,$active)
        {
            $this->db->select("a.id_keluar, a.kd_keluar, a.tgl_keluar, a.id_toko, b.nm_toko,  a.active, (select count(c.id_keluar_detail) from tr_keluar_detail c where c.id_keluar = a.id_keluar ) as jml");
            $this->db->from("tr_keluar a");
			$this->db->join("ref_toko b", "a.id_toko = b.id_toko", "left");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.kd_keluar  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active = '".$active."'");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_keluar($search = null, $active)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_keluar) as recordsFiltered ");
			$this->db->from("tr_keluar");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active = '".$active."'");
			$this->db->like("kd_keluar ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_keluar) as recordsTotal ");
			$this->db->from("tr_keluar");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active = '".$active."'");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}

		public function getAllkeluar_detail($show=null, $start=null, $cari=null, $id_keluar)
        {
            $this->db->select("a.id_keluar, a.id_keluar_detail, a.id_stok, a.kd_barang, a.nm_barang, a.qty, a.harga,  a.active, a.tgl_exp");
            $this->db->from("tr_keluar_detail a");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where('a.id_keluar', $id_keluar);
        	$this->db->where("(a.id_barang  LIKE '%".$cari."%' or a.kd_barang  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_keluar_detail($search = null, $id_keluar)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(a.id_keluar_detail) as recordsFiltered ");
			$this->db->from("tr_keluar_detail a");
			$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
			$this->db->where('a.id_keluar', $id_keluar);
			$this->db->where("(a.id_barang  LIKE '%".$search."%' or a.kd_barang  LIKE '%".$search."%' ) ");
			$this->db->where("a.active != '2' ");
			
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_keluar_detail) as recordsTotal ");
			$this->db->from("tr_keluar_detail");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where('id_keluar', $id_keluar);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}

		public function getAllbarang($show=null, $start=null, $cari=null)
        {
            $this->db->select("a.id_barang, a.nm_barang, a.kd_barang, c.nm_satuan, a.harga, a.qty,  a.id_stok, a.tgl_exp");
            $this->db->from("tr_stok a");
			$this->db->join("ref_barang b", "a.id_barang = b.id_barang", "left");
			$this->db->join("ref_satuan c", "b.id_satuan = c.id_satuan", "left");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.kd_barang  LIKE '%".$cari."%' or a.nm_barang  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            $this->db->where("a.qty != 0");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_barang($search = null)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_stok) as recordsFiltered ");
			$this->db->from("tr_stok");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$this->db->where("qty != 0");
			$this->db->where("(kd_barang  LIKE '%".$search."%' or nm_barang  LIKE '%".$search."%' ) ");
            $count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_stok) as recordsTotal ");
			$this->db->from("tr_stok");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$this->db->where("qty != 0");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}
		
		public function insert_keluar($data)
        {
            $this->db->insert('tr_keluar', $data);
			return $this->db->insert_id();
        }

		public function insert_keluar_detail($data)
        {
            $this->db->insert('tr_keluar_detail', $data);
			return $this->db->insert_id();
        }

		public function insert_allocation($data)
        {
            $this->db->insert('tr_allocation', $data);
			return $this->db->insert_id();
        }

        public function delete_keluar($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_keluar', $data['id_keluar']);
            $this->db->delete('tr_keluar');
			return $data['id_keluar'];
        }

		public function delete_keluar_detail($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_keluar_detail', $data['id_keluar_detail']);
            $this->db->delete('tr_keluar_detail');
			return $data['id_keluar_detail'];
        }

		public function app_keluar($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_keluar', $data['id_keluar']);
            $this->db->update('tr_keluar', $data);
			return $data['id_keluar'];
        }
		
        public function update_keluar($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_keluar', $data['id_keluar']);
			$this->db->where("active != '2' ");
            $this->db->update('tr_keluar', $data);
			return $data['id_keluar'];
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
				$this->db->select("a.id_keluar, a.tgl_keluar, a.id_toko, b.nm_toko,  a.active");
				$this->db->from("tr_keluar a");
				$this->db->join("ref_toko b", "a.id_toko = b.id_toko", "left");
				$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
				$this->db->where('a.id_keluar', $id_keluar);
				$this->db->where("a.active != '2' ");
				return $this->db->get()->row_array();
			}
		}

		public function get_barang_by_id($id_stok)
		{
			if(empty($id_stok))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->select("a.id_barang, a.kd_barang, a.nm_barang, a.id_stok,a.harga,a.qty, a.tgl_exp");
				$this->db->from("tr_stok a");
				$this->db->where('a.id_stok', $id_stok);
				$this->db->where("a.active != '2' ");
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


		

    }
