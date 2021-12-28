<?php
    class Model_retur extends CI_Model
    {
        public function getAllretur($show=null, $start=null, $cari=null,$active)
        {
            $this->db->select("a.id_retur, a.kd_retur, a.tgl_retur, a.id_toko, b.nm_toko, d.tgl_pengiriman,  a.active, a.id_keluar, c.kd_keluar, (select count(e.id_retur_detail) from tr_retur_detail e where e.id_retur = a.id_retur) as jml");
            $this->db->from("tr_retur a");
			$this->db->join("ref_toko b", "a.id_toko = b.id_toko", "left");
			$this->db->join("tr_keluar c", "a.id_keluar = c.id_keluar", "left");
			$this->db->join("tr_pengiriman d", "a.id_pengiriman = d.id_pengiriman", "left");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.kd_retur  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active = '".$active."'");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_retur($search = null, $active)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_retur) as recordsFiltered ");
			$this->db->from("tr_retur");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active = '".$active."'");
			$this->db->like("kd_retur ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_retur) as recordsTotal ");
			$this->db->from("tr_retur");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active = '".$active."'");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}

		public function getAllretur_detail($show=null, $start=null, $cari=null, $id_retur)
        {
            $this->db->select("a.id_retur, a.id_retur_detail, a.id_stok, a.kd_barang, a.nm_barang, a.qty, a.harga, a.tgl_exp,  a.active");
            $this->db->from("tr_retur_detail a");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where('a.id_retur', $id_retur);
        	$this->db->where("(a.id_barang  LIKE '%".$cari."%' or a.kd_barang  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_retur_detail($search = null, $id_retur)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(a.id_retur_detail) as recordsFiltered ");
			$this->db->from("tr_retur_detail a");
			$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
			$this->db->where('a.id_retur', $id_retur);
			$this->db->where("(a.id_barang  LIKE '%".$search."%' or a.kd_barang  LIKE '%".$search."%' ) ");
			$this->db->where("a.active != '2' ");
			
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_retur_detail) as recordsTotal ");
			$this->db->from("tr_retur_detail");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where('id_retur', $id_retur);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}

		public function getAllpengirimandetail($show=null, $start=null, $cari=null, $tgl_pengiriman)// masukan varible tgl_pnegiriman
        {
            $this->db->select("b.kd_pengiriman, c.kd_keluar, a.id_pengiriman_detail, a.id_pengiriman, d.nm_toko, b.tgl_pengiriman");
            $this->db->from("tr_pengiriman_detail a");
			$this->db->join("tr_pengiriman b", "a.id_pengiriman = b.id_pengiriman", "left");
			$this->db->join("tr_keluar c", "a.id_keluar = c.id_keluar", "left");
			$this->db->join("ref_toko d", "a.id_toko = d.id_toko", "left");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where('b.tgl_pengiriman', $tgl_pengiriman);// short by tanggal pengiriman
            $this->db->where("(b.kd_pengiriman  LIKE '%".$cari."%' or c.kd_keluar  LIKE '%".$cari."%' ) ");
            
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_pengirimandetail($search = null, $tgl_pengiriman)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_pengiriman_detail) as recordsFiltered ");
			$this->db->from("tr_pengiriman_detail a");
			$this->db->join("tr_pengiriman b", "a.id_pengiriman = b.id_pengiriman", "left");
			$this->db->join("tr_keluar c", "a.id_keluar = c.id_keluar", "left");
			$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
			$this->db->where('b.tgl_pengiriman', $tgl_pengiriman);
			$this->db->where("(b.kd_pengiriman  LIKE '%".$cari."%' or c.kd_keluar  LIKE '%".$cari."%' ) ");
            $count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_pengiriman_detail) as recordsTotal ");
			$this->db->from("tr_pengiriman_detail");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
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
		
		public function insert_retur($data)
        {
            $this->db->insert('tr_retur', $data);
			return $this->db->insert_id();
        }

		public function insert_retur_detail($data)
        {
            $this->db->insert('tr_retur_detail', $data);
			return $this->db->insert_id();
        }

        public function delete_retur($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_retur', $data['id_retur']);
            $this->db->delete('tr_retur');
			return $data['id_retur'];
        }

		public function delete_retur_detail($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_retur_detail', $data['id_retur_detail']);
            $this->db->delete('tr_retur_detail');
			return $data['id_retur_detail'];
        }

		public function app_retur($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_retur', $data['id_retur']);
            $this->db->update('tr_retur', $data);
			return $data['id_retur'];
        }
		
        public function update_retur($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_retur', $data['id_retur']);
			$this->db->where("active != '2' ");
            $this->db->update('tr_retur', $data);
			return $data['id_retur'];
        }
		
		public function get_retur_by_id($id_retur)
		{
			if(empty($id_retur))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->select("a.id_retur, a.tgl_retur, a.id_toko, b.nm_toko,  a.active");
				$this->db->from("tr_retur a");
				$this->db->join("ref_toko b", "a.id_toko = b.id_toko", "left");
				$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
				$this->db->where('a.id_retur', $id_retur);
				$this->db->where("a.active != '2' ");
				return $this->db->get()->row_array();
			}
		}

		public function get_keluar_detail_by_id($id_keluar_detail)
		{
			if(empty($id_keluar_detail))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->select("a.id_keluar, a.id_keluar_detail, a.id_stok, a.kd_barang, a.nm_barang, a.qty, a.harga, a.active, a.tgl_exp");
          		$this->db->from("tr_keluar_detail a");
				$this->db->where('a.id_keluar_detail', $id_keluar_detail);
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
