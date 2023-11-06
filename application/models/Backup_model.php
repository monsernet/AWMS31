<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Backup_model extends CI_Model {

	//database table name
	private $backup = 'backup';
	
	// Save backup details
	function save_backup_details($file_name, $file_path, $backup_type) {
		$this->db->trans_start();
		$data = array(
			'backup_name' => $file_name,
			'backup_location' => $file_path,
			'backup_type' => $backup_type,
			'created_date' => date('Y-m-d H:i:s')
		);
		
		$this->db->insert($this->backup, $data);
		$id = $this->db->insert_id();
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return NULL;
		} else {
			$this->db->trans_commit();
			return $id;
		}
		return NULL;
	}
	
	// Delete backup row from database
	function delete_db_file($file_id) {
		$this->db->trans_start();
		$this->db->where('backup_id', $file_id);
		$query = $this->db->get($this->backup);
		$temp = $query->row();
		$this->db->where('backup_id', $file_id);
		$this->db->delete($this->backup);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return NULL;
		} else {
			$this->db->trans_commit();
			return $temp;
		}
	}
	
	// Check if database raw exist
	function check_db_file($file_id) {
		$this->db->where('backup_id', $file_id);
		$this->db->limit(1);
		$query = $this->db->get($this->backup);
		
		if ($query->num_rows() == 1) {
			return $query->row();
		}
		return NULL;
	}

	// Check if file raw exist
	function check_site_file($file_id) {
		$this->db->where('backup_id', $file_id);
		$this->db->limit(1);
		$query = $this->db->get($this->backup);
		
		if ($query->num_rows() == 1) {
			return $query->row();
		} else {
			return NULL;
		}
	}

	// Delete file raw from database
	function delete_site_file($file_id) {
		$this->db->trans_start();
		$this->db->where('backup_id', $file_id);
		$query = $this->db->get($this->backup);
		$temp = $query->row();
		$this->db->where('backup_id', $file_id);
		$this->db->delete($this->backup);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return NULL;
		} else {
			$this->db->trans_commit();
			return $temp;
		}
	}

}
