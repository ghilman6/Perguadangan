<?php
    class Model_barang extends CI_Model
    {
        public function getAllbarang($show=null, $start=null, $cari=null)
        {
            $this->db->select("a.id_barang, a.kd_barang, a.nm_barang, a.id_satuan, a.id_kategori, b.nm_satuan, c.nm_kategori, a.active");
            $this->db->from("ref_barang a");
			$this->db->join("ref_satuan b", "a.id_satuan = b.id_satuan", "left");
			$this->db->join("ref_kategori c", "a.id_kategori = c.id_kategori", "left");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.nm_barang  LIKE '%".$cari."%' ) ");
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
			
			$this->db->select(" COUNT(id_barang) as recordsFiltered ");
			$this->db->from("ref_barang");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$this->db->like("nm_barang ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_barang) as recordsTotal ");
			$this->db->from("ref_barang");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}
		
		public function insert_barang($data)
        {
            $this->db->insert('ref_barang', $data);
			return $this->db->insert_id();
        }

        public function delete_barang($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_barang', $data['id_barang']);
            $this->db->update('ref_barang', array('active' => '2'));
			return $data['id_barang'];
        }
		
        public function update_barang($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_barang', $data['id_barang']);
			$this->db->where("active != '2' ");
            $this->db->update('ref_barang', $data);
			return $data['id_barang'];
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
				$this->db->select("a.id_barang, a.kd_barang, a.nm_barang, a.id_satuan, a.id_kategori, b.nm_satuan, c.nm_kategori, a.active");
				$this->db->from("ref_barang a");
				$this->db->join("ref_satuan b", "a.id_satuan = b.id_satuan", "left");
				$this->db->join("ref_kategori c", "a.id_kategori = c.id_kategori", "left");
				$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
				$this->db->where('a.id_barang', $id_barang);
				$this->db->where("a.active != '2' ");
				return $this->db->get()->row_array();
			}
		}

		public function combobox_satuan()
        {
            $this->db->from("ref_satuan");
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('active', 1);
            return $this->db->get();
        }

		public function combobox_kategori()
        {
            $this->db->from("ref_kategori");
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('active', 1);
            return $this->db->get();
        }

		

    }
