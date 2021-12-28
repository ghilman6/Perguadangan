<?php
    class Model_stok extends CI_Model
    {
        public function getAllstok($show=null, $start=null, $cari=null)
        {
            $this->db->select("a.id_stok, a.kd_barang, a.nm_barang, a.harga, a.qty, a.tgl_exp ,a.id_masuk, kd_lokasi, a.active");
            $this->db->from("tr_stok a");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.nm_barang  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            $this->db->where("a.qty != 0");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_stok($search = null)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_stok) as recordsFiltered ");
			$this->db->from("tr_stok");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
            $this->db->where("qty != 0");
			$this->db->like("nm_barang ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_stok) as recordsTotal ");
			$this->db->from("tr_stok");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}	

    }
