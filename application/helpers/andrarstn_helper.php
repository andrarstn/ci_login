<?php
function check_login()
{
    $ar = get_instance();
    if (!$ar->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $ar->session->userdata('role_id'); //1
        $menu = $ar->uri->segment(1); //files

        $queryMenu = $ar->db->get_where('user_menu', ['menu' => $menu])->row_array(); //files
        $menu_id = $queryMenu['id']; //6

        $userAccess = $ar->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]); //1, 6
        if ($userAccess->num_rows() < 1) {
            redirect('auth/block');
        }
    }
}
function check_access($role_id, $menu_id)
{
    $ar = get_instance();

    $ar->db->where('role_id', $role_id);
    $ar->db->where('menu_id', $menu_id);
    $result = $ar->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return 'checked = "checked"';
    }
}
