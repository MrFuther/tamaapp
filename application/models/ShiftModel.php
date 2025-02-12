<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShiftModel extends CI_Model {

    private $table = "shift_kerja";

    public function get_all_shifts() {
        return $this->db->get($this->table)->result();
    }

    public function insert_shift($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_shift_by_id($id) {
        return $this->db->get_where($this->table, ['id_shift' => $id])->row();
    }

    public function update_shift($id, $data) {
        $this->db->where('id_shift', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete_shift($id) {
        return $this->db->delete($this->table, ['id_shift' => $id]);
    }
}
?>
