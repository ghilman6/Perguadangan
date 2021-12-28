<?php
    class Model_satuan extends CI_Model
    {
        public function getAllsatuan($show=null, $start=null, $cari=null)
        {
            $this->db->select("a.id_satuan, a.nm_satuan, a.active");
            $this->db->from("ref_satuan a");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.nm_satuan  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_satuan($search = null)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_satuan) as recordsFiltered ");
			$this->db->from("ref_satuan");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$this->db->like("nm_satuan ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_satuan) as recordsTotal ");
			$this->db->from("ref_satuan");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}
		
		public function insert_satuan($data)
        {
            $this->db->insert('ref_satuan', $data);
			return $this->db->insert_id();
        }

        public function delete_satuan($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_satuan', $data['id_satuan']);
            $this->db->update('ref_satuan', array('active' => '2'));
			return $data['id_satuan'];
        }
		
        public function update_satuan($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_satuan', $data['id_satuan']);
			$this->db->where("active != '2' ");
            $this->db->update('ref_satuan', $data);
			return $data['id_satuan'];
        }
		
		public function get_satuan_by_id($id_satuan)
		{
			if(empty($id_satuan))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->from("ref_satuan a");
				$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
				$this->db->where('a.id_satuan', $id_satuan);
				$this->db->where("a.active != '2' ");
				return $this->db->get()->row_array();
			}
		}

		

    }
