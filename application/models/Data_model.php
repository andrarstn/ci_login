<?php
class Data_model extends CI_Model
{
    public function getAll($table)
    {
        return $this->db->get($table)->result_array();
    }
    public function getAllById($table, $id)
    {
        return $this->db->get_where($table, ['id_user' => $id])->result_array();
    }
    public function getById($table, $id)
    {
        return $this->db->get_where($table, ['id' => $id])->row_array();
    }
    public function insertMahasiswa($table)
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nim" => $this->input->post('nim', true),
            "email" => $this->input->post('email', true),
            "kelamin" => $this->input->post('kelamin', true),
            "jurusan" => $this->input->post('jurusan', true),
            "id_user" => $this->input->post('id_user', true)
        ];
        return $this->db->insert($table, $data);
    }

    public function searchData($table, $id)
    {
        $keyword = $this->input->post('keyword');

        return $this->db->where('id_user', $id)->like('nama', $keyword)->or_like('jurusan', $keyword)->where('id_user', $id)->get($table)->result_array();
    }

    public function editmahasiswa($table, $id)
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nim" => $this->input->post('nim', true),
            "email" => $this->input->post('email', true),
            "kelamin" => $this->input->post('kelamin', true),
            "jurusan" => $this->input->post('jurusan', true)
        ];
        return $this->db->where('id', $id)->update($table, $data);
    }
    public function delete($table, $id)
    {
        $this->db->delete($table, ['id' => $id]);
    }
}
