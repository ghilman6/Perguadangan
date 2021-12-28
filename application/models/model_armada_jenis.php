<?php
    class Model_armada_jenis extends CI_Model
    {
        public function getAllarmada_jenis($show=null, $start=null, $cari=null)
        {
            $this->db->select("a.id_armada_jenis, a.nm_armada_jenis, a.active");
            $this->db->from("ref_armada_jenis a");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.nm_armada_jenis  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_armada_jenis($search = null)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_armada_jenis) as recordsFiltered ");
			$this->db->from("ref_armada_jenis");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$this->db->like("nm_armada_jenis ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_armada_jenis) as recordsTotal ");
			$this->db->from("ref_armada_jenis");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}
		
		public function insert_armada_jenis($data)
        {
            $this->db->insert('ref_armada_jenis', $data);
			return $this->db->insert_id();
        }

        public function delete_armada_jenis($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_armada_jenis', $data['id_armada_jenis']);
            $this->db->update('ref_armada_jenis', array('active' => '2'));
			return $data['id_armada_jenis'];
        }
		
        public function update_armada_jenis($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_armada_jenis', $data['id_armada_jenis']);
			$this->db->where("active != '2' ");
            $this->db->update('ref_armada_jenis', $data);
			return $data['id_armada_jenis'];
        }
		
		public function get_armada_jenis_by_id($id_armada_jenis)
		{
			if(empty($id_armada_jenis))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->from("ref_armada_jenis a");
				$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
				$this->db->where('a.id_armada_jenis', $id_armada_jenis);
				$this->db->where("a.active != '2' ");
				return $this->db->get()->row_array();
			}
		}

		

    }
