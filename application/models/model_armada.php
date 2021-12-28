<?php
    class Model_armada extends CI_Model
    {
        public function getAllarmada($show=null, $start=null, $cari=null)
        {
            $this->db->select("a.id_armada, a.kd_armada,a.volume,a.berat,a.id_armada_jenis, b.nm_armada_jenis, a.active");
            $this->db->from("ref_armada a");
            $this->db->join("ref_armada_jenis b", "a.id_armada_jenis = b.id_armada_jenis", "left");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.kd_armada  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_armada($search = null)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_armada) as recordsFiltered ");
			$this->db->from("ref_armada");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$this->db->like("kd_armada ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_armada) as recordsTotal ");
			$this->db->from("ref_armada");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}
		
		public function insert_armada($data)
        {
            $this->db->insert('ref_armada', $data);
			return $this->db->insert_id();
        }

        public function delete_armada($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_armada', $data['id_armada']);
            $this->db->update('ref_armada', array('active' => '2'));
			return $data['id_armada'];
        }
		
        public function update_armada($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_armada', $data['id_armada']);
			$this->db->where("active != '2' ");
            $this->db->update('ref_armada', $data);
			return $data['id_armada'];
        }
		
		public function get_armada_by_id($id_armada)
		{
			if(empty($id_armada))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->select("a.id_armada, a.kd_armada, a.volume, a.berat, a.id_armada_jenis, b.nm_armada_jenis, a.active, a.cuser, a.cdate");
                $this->db->from("ref_armada a");
                $this->db->join("ref_armada_jenis b", "a.id_armada_jenis = b.id_armada_jenis", "left");
				$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
				$this->db->where('a.id_armada', $id_armada);
				$this->db->where("a.active != '2' ");
				return $this->db->get()->row_array();
			}
		}

		public function combobox_armada_jenis()
        {
            $this->db->from("ref_armada_jenis");
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('active', 1);
            return $this->db->get();
        }

		

    }
