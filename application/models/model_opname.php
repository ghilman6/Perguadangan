<?php
    class Model_opname extends CI_Model
    {
        public function getAllopname($show=null, $start=null, $cari=null,$active)
        {
            $this->db->select("a.id_opname, a.kd_opname, a.tgl_opname, a.id_toko, b.nm_toko,  a.active, (select count(c.id_opname_detail) from tr_opname_detail c where c.id_opname = a.id_opname ) as jml");
            $this->db->from("tr_opname a");
			$this->db->join("ref_toko b", "a.id_toko = b.id_toko", "left");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.kd_opname  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active = '".$active."'");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_opname($search = null, $active)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_opname) as recordsFiltered ");
			$this->db->from("tr_opname");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active = '".$active."'");
			$this->db->like("kd_opname ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_opname) as recordsTotal ");
			$this->db->from("tr_opname");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active = '".$active."'");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}

		public function getAllopname_detail($show=null, $start=null, $cari=null, $id_opname)
        {
            $this->db->select("a.id_opname, a.id_opname_detail, a.id_stok, a.kd_barang, a.nm_barang, a.qty, a.qty_asal, a.harga,  a.active");
            $this->db->from("tr_opname_detail a");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where('a.id_opname', $id_opname);
        	$this->db->where("(a.id_barang  LIKE '%".$cari."%' or a.kd_barang  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_opname_detail($search = null, $id_opname)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(a.id_opname_detail) as recordsFiltered ");
			$this->db->from("tr_opname_detail a");
			$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
			$this->db->where('a.id_opname', $id_opname);
			$this->db->where("(a.id_barang  LIKE '%".$search."%' or a.kd_barang  LIKE '%".$search."%' ) ");
			$this->db->where("a.active != '2' ");
			
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_opname_detail) as recordsTotal ");
			$this->db->from("tr_opname_detail");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where('id_opname', $id_opname);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}

		public function getAllbarang($show=null, $start=null, $cari=null)
        {
            $this->db->select("a.id_barang, a.nm_barang, a.kd_barang, c.nm_satuan, a.harga, a.qty,  a.id_stok");
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
		
		public function insert_opname($data)
        {
            $this->db->insert('tr_opname', $data);
			return $this->db->insert_id();
        }

		public function insert_opname_detail($data)
        {
            $this->db->insert('tr_opname_detail', $data);
			return $this->db->insert_id();
        }

        public function delete_opname($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_opname', $data['id_opname']);
            $this->db->delete('tr_opname');
			return $data['id_opname'];
        }

		public function delete_opname_detail($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_opname_detail', $data['id_opname_detail']);
            $this->db->delete('tr_opname_detail');
			return $data['id_opname_detail'];
        }

		public function app_opname($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_opname', $data['id_opname']);
            $this->db->update('tr_opname', $data);
			return $data['id_opname'];
        }
		
        public function update_opname($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_opname', $data['id_opname']);
			$this->db->where("active != '2' ");
            $this->db->update('tr_opname', $data);
			return $data['id_opname'];
        }
		
		public function get_opname_by_id($id_opname)
		{
			if(empty($id_opname))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->select("a.id_opname, a.tgl_opname, a.id_toko, b.nm_toko,  a.active");
				$this->db->from("tr_opname a");
				$this->db->join("ref_toko b", "a.id_toko = b.id_toko", "left");
				$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
				$this->db->where('a.id_opname', $id_opname);
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
				$this->db->select("a.id_barang, a.kd_barang, a.nm_barang, a.id_stok,a.harga,a.qty");
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
