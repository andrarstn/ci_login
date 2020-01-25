<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model', 'a');
        check_login();
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $user_email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $user_email])->row_array();
        $data['users'] = $this->a->getUsers();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';

        $user_email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $user_email])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';

        $user_email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $user_email])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role_access', $data);
        $this->load->view('templates/footer');
    }
    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');
        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $access = $this->db->get_where('user_access_menu', $data);

        if ($access->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Access Changed
      </div>');
    }

    public function mahasiswadetail($id)
    {
        $user_email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $user_email])->row_array();
        $data['title'] = "User's Mahasiswa";
        $data['mahasiswa'] = $this->a->getDataMahasiswaById('mahasiswa', $id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/mahasiswadetail', $data);
        $this->load->view('templates/footer');
    }

    public function filedetail($id)
    {
        $user_email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $user_email])->row_array();
        $data['files'] = $this->a->getFiles($id);
        $data['title'] = "User's Files";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/filedetail', $data);
        $this->load->view('templates/footer');
    }

    public function delete($id)
    {
        $this->a->deleteUser($id);
        delete_files('./assets/users_files/' . $id, TRUE);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        User deleted
      </div>');
        redirect('admin');
    }
}
