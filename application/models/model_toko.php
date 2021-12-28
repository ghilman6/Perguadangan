<?php
    class Model_toko extends CI_Model
    {
        public function getAlltoko($show=null, $start=null, $cari=null)
        {
            $this->db->select("a.id_toko, a.alamat_toko, a.nm_toko, a.active");
            $this->db->from("ref_toko a");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.nm_toko  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_toko($search = null)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_toko) as recordsFiltered ");
			$this->db->from("ref_toko");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$this->db->like("nm_toko ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_toko) as recordsTotal ");
			$this->db->from("ref_toko");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}
		
		public function insert_toko($data)
        {
            $this->db->insert('ref_toko', $data);
			return $this->db->insert_id();
        }

        public function delete_toko($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_toko', $data['id_toko']);
            $this->db->update('ref_toko', array('active' => '2'));
			return $data['id_toko'];
        }
		
        public function update_toko($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_toko', $data['id_toko']);
			$this->db->where("active != '2' ");
            $this->db->update('ref_toko', $data);
			return $data['id_toko'];
        }
		
		public function get_toko_by_id($id_toko)
		{
			if(empty($id_toko))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->from("ref_toko a");
				$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
				$this->db->where('a.id_toko', $id_toko);
				$this->db->where("a.active != '2' ");
				return $this->db->get()->row_array();
			}
		}

		

    }
