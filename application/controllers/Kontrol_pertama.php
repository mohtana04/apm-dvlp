<?php
/**
 * Created by PhpStorm.
 * User: mohtana_04
 * Date: 19/11/2021
 * Time: 10:03
 */

defined('BASEPATH') OR exit('No direct script access allowed');
include_once(dirname(__FILE__) . "/Rest_bpjs.php");

class Kontrol_pertama extends Rest_bpjs
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('form');
        $this->load->model('m_apmbpjs');
    }

    public function index()
    {
        $this->load->view('view_kontrol_pertama');
    }


    public function a_identifikasi()
    {
        $output = '';
        $noMr = $this->input->post('noMr');

        //cek pasien prb atau tidak
        $data = $this->m_apmbpjs->cekprb($noMr);
        if ($data->num_rows() >= 1) {

            $temp_data = array(
                'pesan' => 'PASIEN DALAM MASA RUJUK BALIK',
                'code' => '300',
                'nocm' => $noMr,
                'dokterid' => ''
            );
            $this->m_apmbpjs->sendbpjslog($temp_data);
            $output .= '
     <script type="text/javascript">var baseurl ="' . base_url() . 'kontrol_pertama";alert("PASIEN SEDANG DALAM MASA PROGRAM RUJUK BALIK");location.href=baseurl;</script>';
            echo $output;
            exit;
        }

        //=========================================

        //        cek pasien sudah appointment
        $data2 = $this->m_apmbpjs->cekappointment($noMr);

        if ($data2->num_rows() > 0) {
            $dataappointment['pasien_appointment'] = $this->m_apmbpjs->cekappointment($noMr);
            $this->load->view('view_kontrol_pertama_aidentifikasi', $dataappointment);
        } else {
            $temp_data = array(
                'pesan' => 'PASIEN TIDAK TERDAFTAR',
                'code' => '301',
                'nocm' => $noMr,
                'dokterid' => ''
            );
            // echo $noMr;
            $this->m_apmbpjs->sendbpjslog($temp_data);
            $output .= '
     <script type="text/javascript">var baseurl ="' . base_url() . 'kontrol_pertama";alert("PASIEN BELUM TERDAFTAR, SILAHKAN HUBUNGI BAGIAN PENDAFTARAN");location.href=baseurl;</script>';
            echo $output;
            exit;
        }

        //====================================================
    }

    public function a_cetaksep()
    {
        $output = '';
        $today1 = date('Y-m-d H:i:s');

        $koneksi = $this->m_apmbpjs->koneksi();
        if ($koneksi->num_rows() > 0) {
            foreach ($koneksi->result() as $row) {
                $customerid = $row->kdcustomer;
                $polirehab = $row->kdpoli_rehab;
                $kodeppk = $row->kodeppk;
                $customer = $row->kdcustomer;
                $namarujukan = $row->namappk;
            }
        }

        $noMr = $this->input->post('noMr2');
        $nama1 = $this->input->post('namaPasien');
        $namapasien = str_replace("A1", "", $nama1);
        $urut = $this->input->post('urut');
        $dokterid = $this->input->post('dokterid');
        $namaDokter = $this->input->post('namaDokter');
        $kdPoliBps = $this->input->post('kdPoliBps');
        $kdpolirs = $this->input->post('kdPoli');
        $namaPoli = $this->input->post('namaPoli');
        $nokartu = $this->input->post('nokartu');
        $notelpon = $this->input->post('notelpon');
        $shift = $this->input->post('shift');
        $waktu = $this->input->post('waktu');


        //mendapatkan poli spesialistik dan kd dpjp bpjs

        $bpjsrefdokter = $this->m_apmbpjs->caripolispesialistik($dokterid);
        foreach ($bpjsrefdokter->result() as $row) {
            $politujuan = $row->spesialistik;
            $kodedpjp = $row->kd_dpjp;
        }


        //==============================================

        //mendapatkan umur pasien
        $tgllahir = $this->m_apmbpjs->tgllahirpasien($noMr);


        //===============================================


        //cek jadwaldokter praktek
        $where = array(
            'kode_dr' => $dokterid,
            'waktu' => $waktu,
            'tanggal' => date('Y-m-d'),
            'poliklinikid' => $kdpolirs
        );

        $cekjadwaltdkpraktek = $this->m_apmbpjs->jadwaldoktertdkpraktek($where);

        if ($cekjadwaltdkpraktek->num_rows() > 0) {
            $temp_data = array(
                'pesan' => 'DOKTER TIDAK PRAKTEK!!!, Silahkan Ke Petugas Pendaftaran',
                'code' => '302',
                'nocm' => $noMr,
                'dokterid' => ''
            );
            // echo $noMr;
            $this->m_apmbpjs->sendbpjslog($temp_data);
            $output .= '
     <script type="text/javascript">var baseurl ="' . base_url() . 'kontrol_pertama";alert("DOKTER TIDAK PRAKTEK!!!, Silahkan Ke Petugas Pendaftaran");location.href=baseurl;</script>';
            echo $output;
            exit;

        }

        //==========================================================


        //cek dokter sudah selesai praktek

        $where2 = array(
            'kode_dr' => $dokterid,
            'waktu_kunjungan' => $waktu,
            'tgl_kunjungan' => date('Y-m-d'),
            'poliklinikid' => $kdpolirs,
            'nm_pasien' => 'SELESAI'
        );

        $cekdrselsaipraktek = $this->m_apmbpjs->cekdokterselesaipraktek($where2);

        if ($cekdrselsaipraktek->num_rows() > 0) {
            $temp_data = array(
                'pesan' => 'DOKTER SUDAH SELESAI PRAKTEK',
                'code' => '303',
                'nocm' => $noMr,
                'dokterid' => ''
            );
            // echo $noMr;
            $this->m_apmbpjs->sendbpjslog($temp_data);
            $output .= '
     <script type="text/javascript">var baseurl ="' . base_url() . 'kontrol_pertama";alert("DOKTER SUDAH SELESAI PRAKTEK!!!, Silahkan Ke Petugas Pendaftaran");location.href=baseurl;</script>';
            echo $output;
            exit;


        }


        //==================================================================

        //ceknorujukan dari app mobile jkn

        $where = array(
            'nomorrm' => $noMr,
            'tanggalperiksa' => $today1
        );
        $q_cek_rujukanjkn = $this->m_apmbpjs->pasienmobilejkn($where); // belm di tes

        if ($q_cek_rujukanjkn->num_rows() > 0) {
            foreach ($q_cek_rujukanjkn->result() as $row) {
                $norujukan = $row->nomorreferensi;
                $jeniskunjungan = $row->jeniskunjungan;
                $this->cekrujukandetail($norujukan, $jeniskunjungan); //belum di tes
                $this->cekhistori($nokartu); // belum di tes
            }
        } else {
            $this->cekrujukan($nokartu); // done test bisa simpan v1 // v2 belum
            $this->cekhistori($nokartu); // done tes bisa simpan v1 // v2 blum
        }

        echo $politujuan;
        echo '<br>';

    }


}