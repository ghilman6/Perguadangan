<?php
    class Model_putaway extends CI_Model
    {
        public function getAllputaway($show=null, $start=null, $cari=null, $active)
        {
            $this->db->select("a.id_putaway, a.keterangan, a.cdate,  a.active, (select count(c.id_putaway_detail) from tr_putaway_detail c where c.id_putaway = a.id_putaway) as jml");
            $this->db->from("tr_putaway a");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.keterangan  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active = '".$active."' ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_putaway($search = null, $active)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_putaway) as recordsFiltered ");
			$this->db->from("tr_putaway");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active = '".$active."' ");
			$this->db->like("keterangan ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_putaway) as recordsTotal ");
			$this->db->from("tr_putaway");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active = '".$active."' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}

		public function getAllputaway_detail($show=null, $start=null, $cari=null, $id_putaway)
        {
            $this->db->select("a.id_putaway, a.id_putaway_detail, a.id_stok, a.kd_lokasi, a.kd_lokasi_asal, a.kd_barang, a.nm_barang, a.qty,  a.active");
            $this->db->from("tr_putaway_detail a");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where('a.id_putaway', $id_putaway);
            $this->db->where("(a.kd_barang  LIKE '%".$cari."%' or a.nm_barang  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_putaway_detail($search = null, $id_putaway)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select("COUNT(a.id_putaway_detail) as recordsFiltered ");
			$this->db->from("tr_putaway_detail a");
			$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
			$this->db->where('a.id_putaway', $id_putaway);
			$this->db->where("(a.kd_barang  LIKE '%".$search."%' or a.nm_barang  LIKE '%".$search."%' ) ");
			$this->db->where("a.active != '2' ");
			
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_putaway_detail) as recordsTotal ");
			$this->db->from("tr_putaway_detail");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where('id_putaway', $id_putaway);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}

		public function getAllbarang($show=null, $start=null, $cari=null, $kd_lokasi)
        {
            $this->db->select("a.id_barang, a.id_stok, a.nm_barang, a.kd_barang, c.nm_satuan, a.qty, a.kd_lokasi");
            $this->db->from("tr_stok a");
			$this->db->join("ref_barang b", "a.id_barang = b.id_barang", "left");
			$this->db->join("ref_satuan c", "b.id_satuan = c.id_satuan", "left");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.kd_barang  LIKE '%".$cari."%' or a.nm_barang  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            $this->db->where("a.putaway = 1 ");
			if($kd_lokasi == 1 ){
            $this->db->where("a.kd_lokasi = 'STIN' ");
			}
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_barang($search = null, $kd_lokasi)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_stok) as recordsFiltered ");
			$this->db->from("tr_stok");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$this->db->where("(kd_barang  LIKE '%".$search."%' or nm_barang  LIKE '%".$search."%' ) ");
			if($kd_lokasi == 1 ){
				$this->db->where("kd_lokasi = 'STIN' ");
			}
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_stok) as recordsTotal ");
			$this->db->from("tr_stok");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			if($kd_lokasi == 1 ){
				$this->db->where("kd_lokasi = 'STIN' ");
			}
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}
		
		public function insert_putaway($data)
        {
            $this->db->insert('tr_putaway', $data);
			return $this->db->insert_id();
        }

		public function insert_putaway_detail($data)
        {
            $this->db->insert('tr_putaway_detail', $data);
			return $this->db->insert_id();
        }

		public function app_putaway($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_putaway', $data['id_putaway']);
            $this->db->update('tr_putaway', $data);
			return $data['id_putaway'];
        }

        public function delete_putaway($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_putaway', $data['id_putaway']);
            $this->db->delete('tr_putaway');
			return $data['id_putaway'];
        }

		public function delete_putaway_detail($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_putaway_detail', $data['id_putaway_detail']);
            $this->db->delete('tr_putaway_detail');
			return $data['id_putaway_detail'];
        }
		
        public function update_putaway($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_putaway', $data['id_putaway']);
			$this->db->where("active != '2' ");
            $this->db->update('tr_putaway', $data);
			return $data['id_putaway'];
        }
		
		public function get_putaway_by_id($id_putaway)
		{
			if(empty($id_putaway))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->select("a.id_putaway, a.keterangan, a.active");
				$this->db->from("tr_putaway a");
				$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
				$this->db->where('a.id_putaway', $id_putaway);
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
				$this->db->select("a.id_barang, a.kd_barang, a.nm_barang, a.id_stok, a.qty");
				$this->db->from("tr_stok a");
				$this->db->where('a.id_stok', $id_stok);
				return $this->db->get()->row_array();
			}
		}

		public function combobox_lokasi()
        {
            $this->db->from("ref_lokasi");
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('active', 1);
            return $this->db->get();
        }

		


		

    }
