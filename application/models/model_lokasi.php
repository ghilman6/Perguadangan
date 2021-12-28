<?php
    class Model_lokasi extends CI_Model
    {
        public function getAlllokasi($show=null, $start=null, $cari=null)
        {
            $this->db->select("a.id_lokasi, a.kd_lokasi, a.active");
            $this->db->from("ref_lokasi a");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.kd_lokasi  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_lokasi($search = null)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_lokasi) as recordsFiltered ");
			$this->db->from("ref_lokasi");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$this->db->like("kd_lokasi ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_lokasi) as recordsTotal ");
			$this->db->from("ref_lokasi");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}
		
		public function insert_lokasi($data)
        {
            $this->db->insert('ref_lokasi', $data);
			return $this->db->insert_id();
        }

        public function delete_lokasi($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_lokasi', $data['id_lokasi']);
            $this->db->update('ref_lokasi', array('active' => '2'));
			return $data['id_lokasi'];
        }
		
        public function update_lokasi($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_lokasi', $data['id_lokasi']);
			$this->db->where("active != '2' ");
            $this->db->update('ref_lokasi', $data);
			return $data['id_lokasi'];
        }
		
		public function get_lokasi_by_id($id_lokasi)
		{
			if(empty($id_lokasi))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->from("ref_lokasi a");
				$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
				$this->db->where('a.id_lokasi', $id_lokasi);
				$this->db->where("a.active != '2' ");
				return $this->db->get()->row_array();
			}
		}

		

    }
