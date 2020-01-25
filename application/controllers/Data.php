<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Data_model', 'd');
        $this->load->library('form_validation');
        check_login();
    }
    public function index()
    {
        redirect('data/mahasiswa');
    }
    public function mahasiswa()
    {
        $user_email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $user_email])->row_array();
        $id_user = $data['user']['id'];
        $data['mahasiswa'] = $this->d->getAllById('mahasiswa', $id_user);
        $data['jurusan'] = $this->d->getAll('mahasiswa_jurusan');
        $data['title'] = 'Mahasiswa';
        if ($this->input->post('keyword')) {
            $data['mahasiswa'] = $this->d->searchData('mahasiswa', $id_user);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data/mahasiswa', $data);
            $this->load->view('templates/footer', $data);
        } elseif ($this->input->post('getall')) {
            redirect('data/mahasiswa');
        } else {
            $this->form_validation->set_rules('nama', 'Name', 'trim|required');
            $this->form_validation->set_rules('nim', 'NIM', 'numeric|trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('kelamin', 'Jenis Kelamin', 'trim|required');
            $this->form_validation->set_rules('jurusan', 'Jurusan', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('data/mahasiswa', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $this->d->insertMahasiswa('mahasiswa');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data has been inserted
                </div>');
                redirect('data/mahasiswa');
            }
        }
    }

    public function deletemahasiswa($id)
    {
        $user_email = $this->session->userdata('email');
        $data['mahasiswa'] = $this->d->getById('mahasiswa', $id);
        $data['user'] = $this->db->get_where('user', ['email' => $user_email])->row_array();
        $this->d->delete('mahasiswa', $id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        A data successfuly deleted
        </div>');
        if ($data['user']['role_id'] == 1) {
            redirect('admin/mahasiswadetail/' . $data['mahasiswa']['id_user']);
        } else {
            redirect('data/mahasiswa');
        }
    }

    public function detailmahasiswa($id)
    {
        $user_email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $user_email])->row_array();
        $data['title'] = 'Detail Mahasiswa';
        $data['mahasiswa'] = $this->d->getById('mahasiswa', $id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data/detail', $data);
        $this->load->view('templates/footer');
    }

    public function editmahasiswa($id)
    {
        $user_email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $user_email])->row_array();
        $data['title'] = 'Edit Mahasiswa';
        $data['mahasiswa'] = $this->d->getById('mahasiswa', $id);
        $data['jurusan'] = $this->d->getAll('mahasiswa_jurusan');
        $data['kelamin'] = $this->d->getAll('mahasiswa_kelamin');
        $this->form_validation->set_rules('nama', 'Name', 'trim|required');
        $this->form_validation->set_rules('nim', 'NIM', 'numeric|trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('data/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->d->editmahasiswa('mahasiswa', $id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                A data successfuly edited
            </div>');
            if ($data['user']['role_id'] == 1) {
                redirect('admin/mahasiswadetail/' . $data['mahasiswa']['id_user']);
            } else {
                redirect('data/mahasiswa');
            }
        }
    }
}
