<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {
    public $name;

    public function insert($task_name) {
        $this->name = $task_name;

        $this->db->trans_start();

        $this->db->insert('task', $this);
        $id = $this->db->insert_id();

        $this->db->trans_complete();
	    return (string)$id;
    }

    public function count_by_task_name($task_name) {
        $sql = "SELECT count(*) as row_count FROM task WHERE name = ?";
        return $this->db->query($sql, $task_name)->result()[0]->row_count;
    }

    public function get_all_tasks() {
        $sql = "SELECT id, name FROM task";
        return $this->db->query($sql)->result();
    }

    public function edit_name($id, $name) {
        $this->db->trans_start();
        $sql = "UPDATE task SET name = ? WHERE id = ?";
        $this->db->query($sql, array($name, $id));

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function delete_task($id) {
        $this->db->trans_start();
        $this->db->delete('task', array('id' => $id));
        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}