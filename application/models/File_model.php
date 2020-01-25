<?php
class File_model extends CI_Model
{
    public function getFiles($id)
    {
        return $this->db->get_where('file', ['id_user' => $id])->result_array();
    }

    public function getAFile($name)
    {
        return $this->db->get_where('file', ['name' => $name])->row_array();
    }

    public function fileUpload($data)
    {
        $insert_data['name'] = $data['filename'];
        $insert_data['extension'] = $data['extension'];
        $insert_data['size'] = $data['size'];
        $insert_data['date'] = $data['time_upload'];
        $insert_data['id_user'] = $data['id_user'];
        return $this->db->insert('file', $insert_data);
    }

    public function delete($name)
    {
        $this->db->delete('file', ['name' => $name]);
    }

    public function searchData($id)
    {
        $keyword = $this->input->post('keyword');
        return $this->db->where('id_user', $id)->like('name', $keyword)->get('file')->result_array();
    }
}
