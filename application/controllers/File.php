<?php
defined('BASEPATH') or exit('No direct script access allowed');

class File extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('File_model', 'f');
        $this->load->library('form_validation');
        $this->load->helper('number');
        check_login();
    }

    public function index()
    {
        $user_email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $user_email])->row_array();
        $id = $data['user']['id'];
        $data['max_upload'] = 500000;
        $data['files'] = $this->f->getFiles($id);
        $data['title'] = 'File Manager';
        if ($this->input->post('keyword')) {
            $data['files'] = $this->f->searchData($id);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('file/index', $data);
            $this->load->view('templates/footer', $data);
        } elseif ($this->input->post('getall')) {
            redirect('file');
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('file/index', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function upload()
    {
        $user_email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $user_email])->row_array();
        $id = $data['user']['id'];
        $config['upload_path'] = './assets/users_files/' . $id;
        $config['allowed_types'] = 'jpeg|jpg|png|gif|svg|cdr|psd|xd|bmp|apk|7zip|7z|zip|rar|mp3|mp4|mkv|docx|doc|xlx|xlsx|ppt|pptx|pdf';
        $config['max_size'] = '200000';
        $total = $this->input->post('total');
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('myfile')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Your file not uploaded. Check the extension.
            </div>');
            redirect('file');
        } else {
            $upload_data = $this->upload->data();
            if (round($total + $upload_data['file_size']) >= 500000) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Your storage is not enough!
              </div>');
                redirect('file');
            } else {

                $data['filename'] = $upload_data['file_name'];
                $data['extension'] = $upload_data['file_ext'];
                $data['size'] = $upload_data['file_size'];
                $data['time_upload'] = time();
                $data['id_user'] = $id;
                $this->f->fileUpload($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Your file has been uploaded
                </div>');
                redirect('file');
            }
        }
    }

    public function download($name)
    {
        $this->load->helper('download');
        $user_email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $user_email])->row_array();
        $files = $this->f->getAFile($name);
        $id_user = $data['user']['id'];
        if (!force_download('./assets/users_files/' . $id_user . '/' . $files['name'], NULL)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                File not found. Contact the administrator
              </div>');
            redirect('file');
        }
    }

    public function delete($name)
    {
        $user_email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $user_email])->row_array();
        $id_user = $data['user']['id'];
        $files = $this->f->getAFile($name);
        $filename = $files['name'];
        unlink('./assets/users_files/' . $id_user . '/' . $filename);
        $this->f->delete($name);
        $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">
                Your file has been deleted
              </div>');
        if ($data['user']['role_id'] == 1) {
            unlink('./assets/users_files/' . $files['id_user'] . '/' . $filename);
            redirect('admin/filedetail/' . $files['id_user']);
        } else {
            redirect('file');
        }
    }
}
