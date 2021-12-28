<?php
    class Model_home extends CI_Model
    {
        public function UpdateUser($id_user, $data)
        {
            $this->db->where('id_user', $id_user);
            $this->db->update('ref_user', $data);
        }
		
		public function datapaketchartweek()
		{
			$session = $this->session->userdata('login');
			$get =  $this->db->query("SELECT date(datetime_in) waktu,count(id_logistics) totalpaket
										FROM tr_masuk_logistics
										WHERE origin = ".$this->db->escape($session['id_point'])." and
										datetime_in >= (CURDATE() - INTERVAL 7 DAY)
										GROUP BY
											date(datetime_in)
										ORDER BY date(datetime_in) DESC
										LIMIT 7
										");
	 
			$record = $get->result();
	 
			return json_encode( $record );
		}
		
		public function datarevenuechartmonth()
		{
			$session = $this->session->userdata('login');
			$get =  $this->db->query("SELECT date(cdate) wakturevenue,sum(nilai_revenue) totalrevenue
										FROM tr_rekonsiliasi
										WHERE id_bu = ".$this->db->escape($session['id_bu'])." and
										cdate >= (CURDATE() - INTERVAL 7 DAY)
										GROUP BY
											date(cdate)
										ORDER BY date(cdate) DESC
										LIMIT 7
										");
	 
			$record = $get->result();
	 
			return json_encode( $record );
		}

		public function get_count_masuk()
		{
	
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(a.id_masuk) as JmlBarangMasuk ");
			$this->db->from("tr_masuk a");
			$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
			$this->db->where('a.tgl_masuk', date('Y-m-d'));
			$this->db->where('a.active', '2' );

			return $this->db->get();
		}

		public function get_count_keluar()
		{
	
			$session = $this->session->userdata('login');
			
			$this->db->select(" COUNT(a.id_keluar) as JmlBarangKeluar");
			$this->db->from("tr_keluar a");
			$this->db->where('a.id_perusahaan', $session['id_perusahaan']);
			$this->db->where('a.tgl_keluar', date('Y-m-d'));
			$this->db->where('a.active', '2' );

			return $this->db->get();
		}
    }
