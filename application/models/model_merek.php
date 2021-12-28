<?php
    class Model_merek extends CI_Model
    {
        public function getAllmerek($show=null, $start=null, $cari=null)
        {
            $this->db->select("a.id_merek, a.nm_merek, a.active");
            $this->db->from("ref_merek a");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.nm_merek  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_merek($search = null)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_merek) as recordsFiltered ");
			$this->db->from("ref_merek");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$this->db->like("nm_merek ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_merek) as recordsTotal ");
			$this->db->from("ref_merek");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}
		
		public function insert_merek($data)
        {
            $this->db->insert('ref_merek', $data);
			return $this->db->insert_id();
        }

        public function delete_merek($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_merek', $data['id_merek']);
            $this->db->update('ref_merek', array('active' => '2'));
			return $data['id_merek'];
        }
		
        public function update_merek($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_merek', $data['id_merek']);
			$this->db->where("active != '2' ");
            $this->db->update('ref_merek', $data);
			return $data['id_merek'];
        }
		
		public function get_merek_by_id($id_merek)
		{
			if(empty($id_merek))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->from("ref_merek a");
				$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
				$this->db->where('a.id_merek', $id_merek);
				$this->db->where("a.active != '2' ");
				return $this->db->get()->row_array();
			}
		}

		

    }
