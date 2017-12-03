<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of T_spk
 *
 * @author Selamet Subu - Dell 5459
 */
class T_spk extends MY_Controller {

    var $tmp_path = 'templates/layout_horizontal_sidebar_menu/index';
    var $main_path = 'pages/spk/';

    public function __construct() {
        parent::__construct();
        $this->load->model('T_spk_m');
        $this->load->model('T_keluhan_m');
        $this->load->model('Ms_kendaraan_m');
        $this->load->library('form_validation');

        $this->is_logged_in();
        if (empty($this->auth_role))
            redirect('login');
    }

    public function index() {
        $x = $this->input->get('x');
        $y = $this->input->get('y');
        $dx = $this->Sys_sitemap->get_data_by_id($x);
        $dy = $this->Sys_sitemap->get_data_by_id($y);

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x
        );

        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'keluhan_main.php';
        $data['title'] = $dx[0]->displayname; // Capitalize the first letter
        $data['htitle'] = $dx[0]->displayname;
        $this->load->view($this->tmp_path, $data);
    }
    
    public function daftar($id_keluhan=null) {
        $x = $this->input->get('x');
        $y = $this->input->get('y');
        $dx = $this->Sys_sitemap->get_data_by_id($x);

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x
        );
        
        $dkeluhan = $this->T_keluhan_m->get_data_by_id($id_keluhan);
        $id_kendaraan = $dkeluhan[0]->id_kendaraan;
        $data['dkendaraan'] = $this->Ms_kendaraan_m->get_data_by_id($id_kendaraan);
        $data['dspk'] = $this->T_spk_m->get_data(array('id_keluhan' =>  $id_keluhan));
        $data['dkeluhan'] = $dkeluhan;
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'main.php';
        $data['title'] = $dx[0]->displayname; // Capitalize the first letter
        $data['htitle'] = $dx[0]->displayname;
        $this->load->view($this->tmp_path, $data);
    }
    
    public function export_pdf($id_keluhan=null) {
        $this->load->library('Pdf');
        $dkeluhan = $this->T_keluhan_m->get_data_by_id($id_keluhan);
        $id_kendaraan = $dkeluhan[0]->id_kendaraan;
        $data['dkendaraan'] = $this->Ms_kendaraan_m->get_data_by_id($id_kendaraan);
        $data['dspk'] = $this->T_spk_m->get_data(array('id_keluhan' =>  $id_keluhan));
        $data['dkeluhan'] = $dkeluhan;
        $data['page'] = $this->main_path . 'preview_spk.php';
        $this->load->view($data['page'], $data);
    }

    public function simpan_json() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();

        // check user  login
        if (!$this->verify_role('admin')) {
            redirect("login");
        }

        // set validation rules
        $config = array(
            array(
                'field' => 'no_spk',
                'label' => 'No SPK',
                'rules' => 'required|min_length[2]|max_length[250]'
            ),
            array(
                'field' => 'kepada',
                'label' => 'Kepada',
                'rules' => 'required|min_length[2]|max_length[250]'
            ),
            array(
                'field' => 'alamat',
                'label' => 'Alamat',
                'rules' => 'required|min_length[2]|max_length[250]'
            ),
            array(
                'field' => 'perawatan',
                'label' => 'Perawatan',
                'rules' => 'required|min_length[2]|max_length[4000]'
            ),
            array(
                'field' => 'm_nama',
                'label' => 'Nama',
                'rules' => 'required|min_length[2]|max_length[4000]'
            ),
            array(
                'field' => 'm_jabatan',
                'label' => 'Jabatan',
                'rules' => 'required|min_length[2]|max_length[4000]'
            ),
            array(
                'field' => 'm_nip',
                'label' => 'NIP',
                'rules' => 'required|min_length[2]|max_length[4000]'
            )
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // end validation rules

        if ($this->form_validation->run() !== false) {
            // Post data
            $id = $this->input->post('id_spk');
            $id_keluhan = $this->input->post('id_keluhan');
            $no_spk = $this->input->post('no_spk');
            $kepada = $this->input->post('kepada');
            $tanggal = $this->input->post('tanggal');
            $alamat = $this->input->post('alamat');
            $perawatan = $this->input->post('perawatan');
            $tembusan = $this->input->post('tembusan');
            $m_nama = $this->input->post('m_nama');
            $m_jabatan = $this->input->post('m_jabatan');
            $m_nip = $this->input->post('m_nip');
            $m_hp = $this->input->post('m_hp');
            $userinput = $this->auth_user_id;

            // set POST data in Array
            $data = array(
                'id_keluhan' => $id_keluhan,
                'no_spk' => $no_spk,
                'kepada' => $kepada,
                'tanggal' => date_sql($tanggal),
                'alamat' => $alamat,
                'perawatan' => $perawatan,
                'm_nama' => $m_nama,
                'm_jabatan' => $m_jabatan,
                'm_nip' => $m_nip,
                'm_hp' => $m_hp,
                'tembusan' => $tembusan
            );

            if (!empty($id)) {
                $data['userupdate'] = $userinput;
                $data['dateupdate'] = date('Y-m-d');
                $result = $this->T_spk_m->update_by_id($data, $id);
            } else {
                $data['userinput'] = $userinput;
                $result = $this->T_spk_m->insert($data);
            }

            if ($result) {
                $r = array('status' => '1', 'message' => 'Data tersimpan');
            } else {
                $r = array('status' => '0', 'message' => 'Data gagal tersimpan');
            }
        } else {
            $r = array('status' => '0');
            foreach ($_POST as $key => $value) {
                $r['message'][$key] = form_error($key);
            }
        }

        echo json_encode($r);
    }

    public function hapus_json() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();

        if (!$this->verify_role('admin')) {
            redirect("login");
        }
        $id = $this->input->get('id');
        $result = $this->T_spk_m->delete_by_id($id);
        if ($result) {
            $r = array('status' => '1', 'message' => 'Data terhapus');
        } else {
            $r = array('status' => '0', 'message' => 'Data gagal terhapus');
        }

        echo json_encode($r);
    }
    
    public function keluhan_ajax_list() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();

        $this->load->model('T_keluhan_m');
        
        $where = null;
        $xstatus_keluhan = $this->input->post('xstatus_keluhan');
        if( !empty($xstatus_keluhan) )
            $where['status_keluhan'] = $xstatus_keluhan;
        
        $column_order = array(
            'id_keluhan', 'dateinput_char', 'no_keluhan', 'pengguna', 'pemohon', 'status_keluhan', 'id_keluhan'
        );
        $column_search = $column_order;
        $order = array('dateinput' => 'desc'); // default order 

        $list = $this->T_keluhan_m->get_datatables($column_order, $order, $column_search, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
            for ($i = 0; $i < count($column_search); $i++) {
                $row[] = $r[$column_search[$i]];
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->T_keluhan_m->count_all($where),
            "recordsFiltered" => $this->T_keluhan_m->count_filtered($column_order, $order, $column_search, $where),
            "data" => $data,
        );
        echo json_encode($output);
    }
    
    public function admin_ajax_list() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();

        if (!$this->verify_role('admin')) {
            redirect("login");
        }

        $this->load->model('T_spk_m');

        $column_order = array(
            'id_spk', 'no_spk', 'no_keluhan', 'pengguna', 'pemohon', 'id_spk'
        );
        $column_search = $column_order;
        $order = array('dateinput' => 'desc'); // default order 

        $list = $this->T_spk_m->get_datatables($column_order, $order, $column_search);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $r) {
            $no++;
            $row = array();
            for ($i = 0; $i < count($column_search); $i++) {
                $row[] = $r[$column_search[$i]];
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->T_spk_m->count_all(),
            "recordsFiltered" => $this->T_spk_m->count_filtered($column_order, $order, $column_search),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function get_data_by_id_json() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();


        $id = $this->input->get("id");
        $data = $this->T_spk_m->get_data_by_id($id);
        echo json_encode($data);
    }

}
