<?php
class Admin_model extends CI_Model
{
    public function getUsers()
    {
        return $this->db->where_not_in('role_id', 1)->get('user')->result_array();
    }

    public function getDataMahasiswaById($table, $id)
    {
        return $this->db->get_where($table, ['id_user' => $id])->result_array();
    }

    public function getFiles($id)
    {
        return $this->db->get_where('file', ['id_user' => $id])->result_array();
    }

    public function deleteUser($id)
    {
        $this->db->delete('file', ['id_user' => $id]);
        $this->db->delete('mahasiswa', ['id_user' => $id]);
        $this->db->delete('user', ['id' => $id]);
    }
}
