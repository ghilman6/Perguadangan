<?php
    class Model_supplier extends CI_Model
    {
        public function getAllsupplier($show=null, $start=null, $cari=null)
        {
            $this->db->select("a.id_supplier, a.nm_supplier, a.alamat_supplier,  a.active");
            $this->db->from("ref_supplier a");
            $session = $this->session->userdata('login');
            $this->db->where('a.id_perusahaan', $session['id_perusahaan']);
            $this->db->where("(a.nm_supplier  LIKE '%".$cari."%' ) ");
            $this->db->where("a.active IN (0, 1) ");
            if ($show == null && $start == null) {
            } else {
                $this->db->limit($show, $start);
            }

            return $this->db->get();
        }
		
		public function get_count_supplier($search = null)
		{
			$count = array();
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(id_supplier) as recordsFiltered ");
			$this->db->from("ref_supplier");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$this->db->like("nm_supplier ", $search);
			$count['recordsFiltered'] = $this->db->get()->row_array()['recordsFiltered'];
			
			$this->db->select(" COUNT(id_supplier) as recordsTotal ");
			$this->db->from("ref_supplier");
			$this->db->where('id_perusahaan', $session['id_perusahaan']);
			$this->db->where("active != '2' ");
			$count['recordsTotal'] = $this->db->get()->row_array()['recordsTotal'];
			
			return $count;
		}
		
		public function insert_supplier($data)
        {
            $this->db->insert('ref_supplier', $data);
			return $this->db->insert_id();
        }

        public function delete_supplier($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_supplier', $data['id_supplier']);
            $this->db->update('ref_supplier', array('active' => '2'));
			return $data['id_supplier'];
        }
		
        public function update_supplier($data)
        {
            $session = $this->session->userdata('login');
            $this->db->where('id_perusahaan', $session['id_perusahaan']);
            $this->db->where('id_supplier', $data['id_supplier']);
			$this->db->where("active != '2' ");
            $this->db->update('ref_supplier', $data);
			return $data['id_supplier'];
        }
		
		public function get_supplier_by_id($id_supplier)
		{
			if(empty($id_supplier))
			{
				return array();
			}
			else
			{
				$session = $this->session->userdata('login');
				$this->db->from("ref_supplier a");
				$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
				$this->db->where('a.id_supplier', $id_supplier);
				$this->db->where("a.active != '2' ");
				return $this->db->get()->row_array();
			}
		}

		

    }
