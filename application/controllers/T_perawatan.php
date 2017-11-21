<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of T_perawatan
 *
 * @author Selamet Subu - Dell 5459
 */
class T_perawatan extends MY_Controller {

    var $tmp_path = 'templates/index_horizontal_menu/index';
    var $main_path = 'pages/perawatan/';

    public function __construct() {
        parent::__construct();
        $this->load->model('T_perawatan_m');
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

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x
        );

        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'kendaraan_main.php';
        $data['title'] = $dx[0]->displayname; // Capitalize the first letter
        $data['htitle'] = $dx[0]->displayname;
        $this->load->view($this->tmp_path, $data);
    }
    
    public function daftar_perawatan($id_kendaraan=null) {
        $x = $this->input->get('x');
        $y = $this->input->get('y');
        $dx = $this->Sys_sitemap->get_data_by_id($x);

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x
        );
        
        $data['dkendaraan'] = $this->Ms_kendaraan_m->get_data_by_id($id_kendaraan);
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'main.php';
        $data['title'] = $dx[0]->displayname; // Capitalize the first letter
        $data['htitle'] = $dx[0]->displayname;
        $this->load->view($this->tmp_path, $data);
    }
    
    public function form_perawatan($id_kendaraan =null, $id_perawatan=null) {
        $this->load->model('Ms_jenis_perawatan_m');
        $this->load->model('T_jenis_perawatan_dtl_m');
        
        $x = $this->input->get('x');
        $dx = $this->Sys_sitemap->get_data_by_id($x);

        // set breadcrumb, tidak usah pake Home karena itu sudah default
        $breadcrumb = array(
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x
        );
        
        $detail = $this->T_perawatan_m->get_data_by_id($id_perawatan);
        foreach( $detail as $row ){
            $id_jenis_perawatan_hdr = $row->id_jenis_perawatan_hdr;
            $row->jenis_perawatan = $this->T_jenis_perawatan_dtl_m->get_data(array('id_jenis_perawatan_hdr' => $id_jenis_perawatan_hdr), null);
        }

        $data['detail'] = $detail;        
        $data['djenisp'] = $this->Ms_jenis_perawatan_m->get_data(array('id_group'=>'1'), 'id_jenis_perawatan');
        $data['djenisp_lain'] = $this->Ms_jenis_perawatan_m->get_data(array('id_group'=>'2'), 'id_jenis_perawatan');
        $data['dkendaraan'] = $this->Ms_kendaraan_m->get_data_by_id($id_kendaraan);
        $data['result'] = $this->T_perawatan_m->get_data_by_id($id_perawatan);
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'form_main.php';
        $data['title'] = $dx[0]->displayname; // Capitalize the first letter
        $data['htitle'] = $dx[0]->displayname;
        $this->load->view($this->tmp_path, $data);
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
        
        $id = $this->input->post('id_perawatan');
        
        // set validation rules
        $config = array(
            array(
                'field' => 'tanggal',
                'label' => 'Tanggal Perawatan',
                'rules' => 'required'
            ),
            array(
                'field' => 'masa_berlaku',
                'label' => 'Masa Berlaku',
                'rules' => 'required'
            ),
            array(
                'field' => 'biro',
                'label' => 'Biro',
                'rules' => 'required'
            ),
            array(
                'field' => 'kilometer',
                'label' => 'Kilometer',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        // end validation rules

        if ($this->form_validation->run() !== false) {
            // Post data
            $id_jenis_perawatan_hdr = $this->input->post('id_jenis_perawatan_hdr');
            
            $id_kendaraan = $this->input->post('id_kendaraan');
            $biro = $this->input->post('biro');
            $tanggal = $this->input->post('tanggal');
            $kilometer = $this->input->post('kilometer');
            $lain_lain = $this->input->post('lain_lain');
            $pengemudi = $this->input->post('pengemudi');
            $pemakai = $this->input->post('pemakai');
            $masa_berlaku = $this->input->post('masa_berlaku');
            
            // perawatan
            $id_jenis_perawatan = $this->input->post('id_jenis_perawatan');
            $jumlah = $this->input->post('jumlah');
            $harga = $this->input->post('harga');
            $catatan = $this->input->post('catatan');
            $userinput = $this->auth_user_id;
            
            
            // set POST data in Array
            $data = array(
                'id_jenis_perawatan_hdr' => $id_jenis_perawatan_hdr,
                'id_kendaraan' => $id_kendaraan,
                'biro' => $biro,
                'tanggal' => date_sql($tanggal),
                'kilometer' => $kilometer,
                'lain_lain' => $lain_lain,
                'pengemudi' => $pengemudi,
                'pemakai' => $pemakai,
                'masa_berlaku' => date_sql($masa_berlaku)
            );

            $datap = array(
                'id_jenis_perawatan' => $id_jenis_perawatan,
                'jumlah' => $jumlah,
                'harga' => $harga,
                'catatan' => $catatan
            );
            
            if (!empty($id)) {
                $data['userupdate'] = $userinput;
                $data['dateupdate'] = date('Y-m-d');
                $result = $this->T_perawatan_m->update_by_id($data, $id, $datap);
            } else {
                $data['userinput'] = $userinput;
                $result = $this->T_perawatan_m->insert($data, $datap);
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
        $result = $this->T_perawatan_m->delete_by_id($id);
        if ($result) {
            $r = array('status' => '1', 'message' => 'Data terhapus');
        } else {
            $r = array('status' => '0', 'message' => 'Data gagal terhapus');
        }

        echo json_encode($r);
    }

    public function admin_ajax_list($id_kendaraan=null) {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();

        if (!$this->verify_role('admin')) {
            redirect("login");
        }

        $this->load->model('T_perawatan_m');

        $column_order = array(
            'id_perawatan', 'tanggal_char', 'kilometer', 'biro', 'pemakai', 'masa_berlaku_char', 'masa_berlaku_status', 'id_perawatan'
        );
        
        $where = array(
            'id_kendaraan'=>$id_kendaraan
        );
        
        $column_search = $column_order;
        $order = array('dateinput' => 'desc'); // default order 

        $list = $this->T_perawatan_m->get_datatables($column_order, $order, $column_search, $where);
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
            "recordsTotal" => $this->T_perawatan_m->count_all($where),
            "recordsFiltered" => $this->T_perawatan_m->count_filtered($column_order, $order, $column_search, $where),
            "data" => $data,
        );
        echo json_encode($output);
    }
    
    public function kendaraan_ajax_list() {
        // only allow ajax request
        if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
                strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'
        )
            show_404();

        if (!$this->verify_role('admin')) {
            redirect("login");
        }

        $this->load->model('Ms_kendaraan_m');

        $column_order = array(
            'id_kendaraan', 'jenis', 'nama_kendaraan', 'platno', 'merk', 'no_stnk', 'id_kendaraan'
        );
        $column_search = $column_order;
        $order = array('dateinput' => 'desc'); // default order 

        $list = $this->Ms_kendaraan_m->get_datatables($column_order, $order, $column_search);
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
            "recordsTotal" => $this->Ms_kendaraan_m->count_all(),
            "recordsFiltered" => $this->Ms_kendaraan_m->count_filtered($column_order, $order, $column_search),
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
        $data = $this->T_perawatan_m->get_data_by_id($id);
        echo json_encode($data);
    }

}
