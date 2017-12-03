<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Laporan_alokasi
 *
 * @author Selamet Subu - Dell 5459
 */
class Laporan_alokasi extends MY_Controller {

    var $tmp_path = 'templates/layout_horizontal_sidebar_menu/index';
    var $main_path = 'pages/laporan_alokasi/';

    public function __construct() {
        parent::__construct();
        $this->load->model('Ms_kendaraan_m');
        $this->load->model('T_alokasi_anggaran_m');

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
            $dx[0]->displayname => base_url() . 'page/get_left_menu?x=' . $x,
            $dy[0]->displayname => base_url() . $dy[0]->url . '?x=' . $x . '&y=' . $y
        );
        
        $tahun_anggaran = $this->input->get('tahun_anggaran');
        
        $res = array();
        
        if( !empty($tahun_anggaran) ){
            $res = $this->Ms_kendaraan_m->get_data(null, null);
            foreach( $res as $row ){
                $row->alokasi = $this->T_alokasi_anggaran_m->get_alokasi_by_id_and_tahun($row->id_kendaraan, $tahun_anggaran);
            }
        }
        
        $data['tahun'] = $this->T_alokasi_anggaran_m->get_tahun_anggaran();
        $data['res'] = $res;
        $data['breadcrumb'] = $breadcrumb;
        $data['page'] = $this->main_path . 'main.php';
        $data['title'] = $dy[0]->displayname; // Capitalize the first letter
        $data['htitle'] = $dy[0]->displayname;
        $this->load->view($this->tmp_path, $data);
    }
}
