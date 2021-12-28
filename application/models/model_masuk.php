<?php
    class Model_masuk extends CI_Model
    {
        public function getAllmasuk($show=null, $start=null, $cari=null, $active)
        {
            $this->db->select("a.id_masuk, a.kd_masuk, a.tgl_masuk, a.id_supplier, b.nm_supplier, a.active, (select count(c.id_masuk_detail) from tr_masuk_detail c where c.id_masuk = a.id_masuk) as jml");
            $this->db->from("tr_masuk a");
			$this->db->join("ref_supplier b", "a.id_supplier = b.id_supplier", "left");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.kd_masuk  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active = '".$active."' ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_masuk($search = null, $active)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_masuk) as recordsFiltered ");
			$this->db->from("tr_masuk");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active = '".$active."' ");
			$this->db->like("kd_masuk ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_masuk) as recordsTotal ");
			$this->db->from("tr_masuk");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active = '".$active."' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}

		public function getAllmasuk_detail($show=null, $start=null, $cari=null, $id_masuk)
        {
            $this->db->select("a.id_masuk, a.id_masuk_detail, a.tgl_exp, a.kd_barang, a.nm_barang, a.qty, a.harga,  a.active");
            $this->db->from("tr_masuk_detail a");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where('a.id_masuk', $id_masuk);
            $this->db->where("(a.kd_barang  LIKE '%".$cari."%' or a.nm_barang  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_masuk_detail($search = null, $id_masuk)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select("COUNT(a.id_masuk_detail) as recordsFiltered ");
			$this->db->from("tr_masuk_detail a");
			$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
			$this->db->where('a.id_masuk', $id_masuk);
			$this->db->where("(a.kd_barang  LIKE '%".$search."%' or a.nm_barang  LIKE '%".$search."%' ) ");
			$this->db->where("a.active != '2' ");
			
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_masuk_detail) as recordsTotal ");
			$this->db->from("tr_masuk_detail");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where('id_masuk', $id_masuk);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}

		public function getAllbarang($show=null, $start=null, $cari=null)
        {
            $this->db->select("a.id_barang, a.nm_barang, a.kd_barang, b.nm_satuan");
            $this->db->from("ref_barang a");
			$this->db->join("ref_satuan b", "a.id_satuan = b.id_satuan", "left");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.kd_barang  LIKE '%".$cari."%' or a.nm_barang  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
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
			
			$this->db->select(" COUNT(id_masuk) as recordsFiltered ");
			$this->db->from("tr_masuk");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$this->db->like("kd_masuk ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_masuk) as recordsTotal ");
			$this->db->from("tr_masuk");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}
		
		public function insert_masuk($data)
        {
            $this->db->insert('tr_masuk', $data);
			return $this->db->insert_id();
        }

		public function insert_masuk_detail($data)
        {
            $this->db->insert('tr_masuk_detail', $data);
			return $this->db->insert_id();
        }

		public function app_masuk($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_masuk', $data['id_masuk']);
            $this->db->update('tr_masuk', $data);
			return $data['id_masuk'];
        }

        public function delete_masuk($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_masuk', $data['id_masuk']);
            $this->db->delete('tr_masuk');
			return $data['id_masuk'];
        }

		public function delete_masuk_detail($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_masuk_detail', $data['id_masuk_detail']);
            $this->db->delete('tr_masuk_detail');
			return $data['id_masuk_detail'];
        }
		
        public function update_masuk($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_masuk', $data['id_masuk']);
			$this->db->where("active != '2' ");
            $this->db->update('tr_masuk', $data);
			return $data['id_masuk'];
        }
		
		public function get_masuk_by_id($id_masuk)
		{
			if(empty($id_masuk))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->select("a.id_masuk, a.kd_masuk, a.tgl_masuk, a.id_supplier, b.nm_supplier,  a.active");
				$this->db->from("tr_masuk a");
				$this->db->join("ref_supplier b", "a.id_supplier = b.id_supplier", "left");
				$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
				$this->db->where('a.id_masuk', $id_masuk);
				$this->db->where("a.active != '2' ");
				return $this->db->get()->row_array();
			}
		}


		public function get_barang_by_id($id_barang)
		{
			if(empty($id_barang))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->select("a.id_barang, a.kd_barang, a.nm_barang");
				$this->db->from("ref_barang a");
				$this->db->where('a.id_barang', $id_barang);
				$this->db->where("a.active != '2' ");
				return $this->db->get()->row_array();
			}
		}

		public function combobox_supplier()
        {
            $this->db->from("ref_supplier");
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('active', 1);
            return $this->db->get();
        }


		

    }
