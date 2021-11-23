<?php
/**
 * Created by PhpStorm.
 * User: mohtana_04
 * Date: 17/11/2021
 * Time: 15:30
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Rest_bpjs extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('form');
        $this->load->model('m_apmbpjs');
    }

    function cekhistori($nokartu){
        $cat = "monitoring/HistoriPelayanan/NoKartu/";
        $tgl2 = date('Y-m-d');
        $tgl1 = date('Y-m-d', strtotime('-90 days', strtotime($tgl2)));


        $koneksi = $this->m_apmbpjs->koneksi();
        if ($koneksi->num_rows() > 0) {
            foreach ($koneksi->result() as $row) {
                $dataid = $row->consid;
                $secretKey = $row->secretid;
                $localIP = $row->ipsep;
                $ws = $row->webservice;
                $namappk = $row->namappk;
                $user_key = $row->user_key;
            }
        }

        $url = "https://" . $localIP . "/" . $ws . "/" . $cat . $nokartu . "/tglMulai/" . $tgl1 . "/tglAkhir/" . $tgl2; //Lihat katalog, jangan sertakan port

        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $dataid . "&" . $tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $urlencodedSignature = urlencode($encodedSignature);


        $arrheader = array(
            'X-cons-id: ' . $dataid,
            'X-timestamp: ' . $tStamp,
            'X-signature: ' . $encodedSignature
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $arrheader);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        curl_close($curl);
        //print_r($result);
        $resultarr = json_decode($result, true);
        //print_r($resultarr);
        $hasilcekhistori = $resultarr['metaData']['code'];
        if ($hasilcekhistori == 200) {
            for ($i = 0; $i < count($resultarr['response']['histori']); $i++) {
                $no = 1;
                $tglsep = $resultarr['response']['histori'][$i]['tglSep'];
                $jnspelayanan = $resultarr['response']['histori'][$i]['jnsPelayanan'];
                $namars = $resultarr['response']['histori'][$i]['ppkPelayanan'];
                //$namappk = 'RS HERMINA BEKASI';
                if ($tglsep >= $tgl1 and $jnspelayanan == 2 and $namars == $namappk) {
                    $nosep = $resultarr['response']['histori'][$i]['noSep'];
                    $norujukan = $resultarr['response']['histori'][$i]['noRujukan'];
                    $nokartu = $resultarr['response']['histori'][$i]['noKartu'];
                    $tglsep = $resultarr['response']['histori'][$i]['tglSep'];
                    $poli = $resultarr['response']['histori'][$i]['poli'];
                    $diagnos = $resultarr['response']['histori'][$i]['diagnosa'];
                    $diagnosa = str_replace("'", "", $diagnos);


                    //cek history sep
                    $where = array(
                        'nosep' => $nosep
                    );

                    $cekduplikat = $this->m_apmbpjs->refhistory($where);

                    if ($cekduplikat->num_rows() < 1) {
                        $temp_data = array(
                            'nosep' => $nosep,
                            'norujukan' => $norujukan,
                            'nokartu' => $nokartu,
                            'poli' => $poli,
                            'diagnosa' => $diagnosa,
                            'tglsep' => $tglsep,

                        );
                        $simpanrujukan = $this->m_apmbpjs->insertrefhistory($temp_data);
                    }
                }
                $no++;
            }
        }
    }

    function cekhistorirwi($nokartu)
    {

        $cat = "monitoring/HistoriPelayanan/NoKartu/";
        $tgl2 = date('Y-m-d');
        $tgl1 = date('Y-m-d', strtotime('-90 days', strtotime($tgl2)));

        $koneksi = $this->m_apmbpjs->koneksi();
        if ($koneksi->num_rows() > 0) {
            foreach ($koneksi->result() as $row) {
                $dataid = $row->consid;
                $secretKey = $row->secretid;
                $localIP = $row->ipsep;
                $ws = $row->webservice;
                $namappk = $row->namappk;
                $user_key = $row->user_key;
            }
        }

        $url = "https://" . $localIP . "/" . $ws . "/" . $cat . $nokartu . "/tglMulai/" . $tgl1 . "/tglAkhir/" . $tgl2;

        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $dataid . "&" . $tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $urlencodedSignature = urlencode($encodedSignature);


        $arrheader = array(
            'X-cons-id: ' . $dataid,
            'X-timestamp: ' . $tStamp,
            'X-signature: ' . $encodedSignature
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $arrheader);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        curl_close($curl);
        //print_r($result);
        $resultarr = json_decode($result, true);
//        print_r($resultarr);
        $hasilcekhistori = $resultarr['metaData']['code'];

        if ($hasilcekhistori == 200) {
            for ($i = 0; $i < count($resultarr['response']['histori']); $i++) {
                $tglsep = $resultarr['response']['histori'][$i]['tglSep'];
                $jnspelayanan = $resultarr['response']['histori'][$i]['jnsPelayanan'];
                $namars = $resultarr['response']['histori'][$i]['ppkPelayanan'];
                if ($tglsep >= $tgl1 and $jnspelayanan == 1 and $namars == $namappk) {
                    $nosep = $resultarr['response']['histori'][$i]['noSep'];
                    $norujukan = $resultarr['response']['histori'][$i]['noRujukan'];
                    $nokartu = $resultarr['response']['histori'][$i]['noKartu'];
                    $tglsep = $resultarr['response']['histori'][$i]['tglSep'];
                    $poli = $resultarr['response']['histori'][$i]['poli'];
                    $diagnos = $resultarr['response']['histori'][$i]['diagnosa'];
                    $diagnosa = str_replace("'", "", $diagnos);

                    //cek history sep
                    $where = array(
                        'nosep' => $nosep
                    );

                    $cekduplikat = $this->m_apmbpjs->refhistory($where);

                    if ($cekduplikat->num_rows() < 1) {
                        $temp_data = array(
                            'nosep' => $nosep,
                            'norujukan' => $norujukan,
                            'nokartu' => $nokartu,
                            'poli' => $poli,
                            'diagnosa' => $diagnosa,
                            'tglsep' => $tglsep,

                        );
                        $simpanrujukan = $this->m_apmbpjs->insertrefhistory($temp_data);
                    }
                }
            }
        }
    }

    function cekpeserta($nokartu)
    {

        $today1 = date('Y-m-d');
        $cat = "Peserta/nokartu/" . $nokartu . "/tglSEP/";

        $koneksi = $this->m_apmbpjs->koneksi();
        if ($koneksi->num_rows() > 0) {
            foreach ($koneksi->result() as $row) {
                $dataid = $row->consid;
                $secretKey = $row->secretid;
                $localIP = $row->ipsep;
                $ws = $row->webservice;
                $namappk = $row->namappk;
                $user_key = $row->user_key;
            }
        }

        $url = "https://" . $localIP . "/" . $ws . "/" . $cat . $today1; //Lihat katalog, jangan sertakan port

        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $dataid . "&" . $tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $urlencodedSignature = urlencode($encodedSignature);

        $arrheader = array(
            'X-cons-id: ' . $dataid,
            'X-timestamp: ' . $tStamp,
            'X-signature: ' . $encodedSignature
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $arrheader);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        curl_close($curl);

        $resultarr = json_decode($result, true);
        return $result;

    }

    function cekrujukan($nokartu)
    {


        $tgl2 = date('Y-m-d');
        $tgl1 = date('Y-m-d', strtotime('-90 days', strtotime($tgl2)));
        $cat = "Rujukan/List/Peserta/";
        $cat2 = "Rujukan/RS/List/Peserta/";

        $koneksi = $this->m_apmbpjs->koneksi();
        if ($koneksi->num_rows() > 0) {
            foreach ($koneksi->result() as $row) {
                $dataid = $row->consid;
                $secretKey = $row->secretid;
                $localIP = $row->ipsep;
                $ws = $row->webservice;
                $namappk = $row->namappk;
                $user_key = $row->user_key;
            }
        }

        $url = "https://" . $localIP . "/" . $ws . "/" . $cat . $nokartu;
        $url2 = "https://" . $localIP . "/" . $ws . "/" . $cat2 . $nokartu;

        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $dataid . "&" . $tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $urlencodedSignature = urlencode($encodedSignature);


        $arrheader = array(
            'X-cons-id: ' . $dataid,
            'X-timestamp: ' . $tStamp,
            'X-signature: ' . $encodedSignature
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $arrheader);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        curl_close($curl);
        //print_r($result);
        $resultarr = json_decode($result, true);
        $hasilcekrujukanklinik = $resultarr['metaData']['code'];
        echo 'klinik '.$hasilcekrujukanklinik;

        echo '<br>';

        if ($hasilcekrujukanklinik == 200) {

            for ($i = 0; $i < count($resultarr['response']['rujukan']); $i++) {
                $no = 1;
                $tglrujukan = $resultarr['response']['rujukan'][$i]['tglKunjungan'];
                if ($tglrujukan >= $tgl1) {
                    $norujukan = $resultarr['response']['rujukan'][$i]['noKunjungan'];
                    $nokartu = $resultarr['response']['rujukan'][$i]['peserta']['noKartu'];
                    $kodepoli = $resultarr['response']['rujukan'][$i]['poliRujukan']['kode'];
                    $tglrujukan = $resultarr['response']['rujukan'][$i]['tglKunjungan'];
                    $asalrujukan = $resultarr['response']['rujukan'][$i]['provPerujuk']['kode'];
                    $faskes = '1';
                    $kddiagnosa = $resultarr['response']['rujukan'][$i]['diagnosa']['kode'];
                    $tmt = $resultarr['response']['rujukan'][$i]['peserta']['tglTMT'];
                    $tat = $resultarr['response']['rujukan'][$i]['peserta']['tglTAT'];
                    $klstanggungan = $resultarr['response']['rujukan'][$i]['peserta']['hakKelas']['keterangan'];
                    $tglcetakkartu = $resultarr['response']['rujukan'][$i]['peserta']['tglCetakKartu'];
                    $sex = $resultarr['response']['rujukan'][$i]['peserta']['sex'];
                    $peserta = $resultarr['response']['rujukan'][$i]['peserta']['jenisPeserta']['keterangan'];
                    $pisa = $resultarr['response']['rujukan'][$i]['peserta']['pisa'];
                    $namarujukan = $resultarr['response']['rujukan'][$i]['provPerujuk']['nama'];
                    $cob = $resultarr['response']['rujukan'][$i]['peserta']['cob']['nmAsuransi'];
                    //cekduplikat
                    $where = array(
                        'norujukan' => $norujukan

                    );
                    $cekduplikat = $this->m_apmbpjs->refrujukanpasien($where);
                    if ($cekduplikat->num_rows() < 1) {
                        $temp_data = array(
                            'norujukan' => $norujukan,
                            'nokartu' => $nokartu,
                            'kodepoli' => $kodepoli,
                            'tglrujukan' => $tglrujukan,
                            'asalrujukan' => $asalrujukan,
                            'faskes' => $faskes,
                            'kddiagnosa' => $kddiagnosa,
                            'tgltmt' => $tmt,
                            'tgltat' => $tat,
                            'tglcetakkartu' => $tglcetakkartu,
                            'klstanggungan' => $klstanggungan,
                            'sex' => $sex,
                            'peserta' => $peserta,
                            'pisat' => $pisa,
                            'namarujukan' => $namarujukan,
                            'cob' => $cob
                        );
                        $simpanrujukan = $this->m_apmbpjs->insertrefrujukanpasien($temp_data);
                    }
                }
                $no++; // Tambah 1 setiap kali looping
            }

        }


        $arrheader2 = array(
            'X-cons-id: ' . $dataid,
            'X-timestamp: ' . $tStamp,
            'X-signature: ' . $encodedSignature
        );
        $curl2 = curl_init();
        curl_setopt($curl2, CURLOPT_URL, $url2);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl2, CURLOPT_HTTPHEADER, $arrheader2);
        curl_setopt($curl2, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl2, CURLOPT_SSL_VERIFYPEER, 0);

        $result2 = curl_exec($curl2);
        curl_close($curl2);
        //print_r($result);
        $resultarr2 = json_decode($result2, true);
        $hasilcekrujukanrs = $resultarr2['metaData']['code'];
        echo 'rs '.$hasilcekrujukanrs;
        echo '<br>';

        if ($hasilcekrujukanrs == 200) {
            for ($i = 0; $i < count($resultarr2['response']['rujukan']); $i++) // Untuk penomoran tabel, di awal set dengan 1
            {
                $no = 1;
                $tglrujukan = $resultarr2['response']['rujukan'][$i]['tglKunjungan'];
                if ($tglrujukan >= $tgl1) {
                    $norujukan = $resultarr2['response']['rujukan'][$i]['noKunjungan'];
                    $nokartu = $resultarr2['response']['rujukan'][$i]['peserta']['noKartu'];
                    $kodepoli = $resultarr2['response']['rujukan'][$i]['poliRujukan']['kode'];
                    $tglrujukan = $resultarr2['response']['rujukan'][$i]['tglKunjungan'];
                    $asalrujukan = $resultarr2['response']['rujukan'][$i]['provPerujuk']['kode'];
                    $faskes = '2';
                    $kddiagnosa = $resultarr2['response']['rujukan'][$i]['diagnosa']['kode'];
                    $tmt = $resultarr2['response']['rujukan'][$i]['peserta']['tglTMT'];
                    $tat = $resultarr2['response']['rujukan'][$i]['peserta']['tglTAT'];
                    $klstanggungan = $resultarr2['response']['rujukan'][$i]['peserta']['hakKelas']['keterangan'];
                    $tglcetakkartu = $resultarr2['response']['rujukan'][$i]['peserta']['tglCetakKartu'];
                    $sex = $resultarr2['response']['rujukan'][$i]['peserta']['sex'];
                    $peserta = $resultarr2['response']['rujukan'][$i]['peserta']['jenisPeserta']['keterangan'];
                    $pisa = $resultarr2['response']['rujukan'][$i]['peserta']['pisa'];
                    $namarujukan = $resultarr2['response']['rujukan'][$i]['provPerujuk']['nama'];
                    $cob = $resultarr2['response']['rujukan'][$i]['peserta']['cob']['nmAsuransi'];



                    //cekduplikat
                    $cekduplikat = $this->m_apmbpjs->refrujukanpeserta($where);
                    if ($cekduplikat->num_rows() < 1) {
                        $temp_data = array(
                            'norujukan' => $norujukan,
                            'nokartu' => $nokartu,
                            'poli' => $kodepoli,
                            'tglrujukan' => $tglrujukan,
                            'asalrujukan' => $asalrujukan,
                            'faskes' => $faskes,
                            'kddiagnosa' => $kddiagnosa,
                            'tmt' => $tmt,
                            'tat' => $tat,
                            '$tglcetakkartu' => $tglcetakkartu,
                            '$klstanggungan' => $klstanggungan,
                            '$sex' => $sex,
                            '$peserta' => $peserta,
                            '$pisa' => $pisa,
                            '$namarujukan' => $namarujukan,
                            '$cob' => $cob
                        );
                        $simpanrujukan = $this->m_apmbpjs->insertrefrujukanpeserta($temp_data);
                    }
                }
                $no++;
            }
        }
    }

    function cekrujukandetail($norujukan, $jeniskunjungan)
    {


        $koneksi = $this->m_apmbpjs->koneksi();
        if ($koneksi->num_rows() > 0) {
            foreach ($koneksi->result() as $row) {
                $dataid = $row->consid;
                $secretKey = $row->secretid;
                $localIP = $row->ipsep;
                $ws = $row->webservice;
                $namappk = $row->namappk;
                $user_key = $row->user_key;
            }
        }


        if ($jeniskunjungan == 1) {
            $cat = "Rujukan/";
            $faskes = '1';
        } else {
            $cat = "Rujukan/RS/";
            $faskes = '2';
        }

        $url = "https://" . $localIP . "/" . $ws . "/" . $cat . $norujukan; //Lihat katalog, jangan sertakan port

        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $dataid . "&" . $tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $urlencodedSignature = urlencode($encodedSignature);

        $arrheader = array(
            'X-cons-id: ' . $dataid,
            'X-timestamp: ' . $tStamp,
            'X-signature: ' . $encodedSignature
        );
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $arrheader);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);

        $result = curl_exec($curl);
        curl_close($curl);


        $resultarr = json_decode($result, true);
        $norujukan = $resultarr['response']['rujukan']['noKunjungan'];
        $nokartu = $resultarr['response']['rujukan']['peserta']['noKartu'];
        $kodepoli = $resultarr['response']['rujukan']['poliRujukan']['kode'];
        $tglrujukan = $resultarr['response']['rujukan']['tglKunjungan'];
        $asalrujukan = $resultarr['response']['rujukan']['provPerujuk']['kode'];
        $kddiagnosa = $resultarr['response']['rujukan']['diagnosa']['kode'];
        $tmt = $resultarr['response']['rujukan']['peserta']['tglTMT'];
        $tat = $resultarr['response']['rujukan']['peserta']['tglTAT'];
        $klstanggungan = $resultarr['response']['rujukan']['peserta']['hakKelas']['keterangan'];
        $tglcetakkartu = $resultarr['response']['rujukan']['peserta']['tglCetakKartu'];
        $sex = $resultarr['response']['rujukan']['peserta']['sex'];
        $peserta = $resultarr['response']['rujukan']['peserta']['jenisPeserta']['keterangan'];
        $pisa = $resultarr['response']['rujukan']['peserta']['pisa'];
        $namarujukan = $resultarr['response']['rujukan']['provPerujuk']['nama'];
        $cob = $resultarr['response']['rujukan']['peserta']['cob']['nmAsuransi'];


        //cekduplikat
        $where = array(
            'norujukan' => $norujukan

        );
        $cekduplikat = $this->m_apmbpjs->refrujukanpasien($where);
        if ($cekduplikat->num_rows() < 1) {
            $temp_data = array(
                'norujukan' => $norujukan,
                'nokartu' => $nokartu,
                'kodepoli' => $kodepoli,
                'tglrujukan' => $tglrujukan,
                'asalrujukan' => $asalrujukan,
                'faskes' => $faskes,
                'kddiagnosa' => $kddiagnosa,
                'tgltmt' => $tmt,
                'tgltat' => $tat,
                'tglcetakkartu' => $tglcetakkartu,
                'klstanggungan' => $klstanggungan,
                'sex' => $sex,
                'peserta' => $peserta,
                'pisat' => $pisa,
                'namarujukan' => $namarujukan,
                'cob' => $cob
            );
            $simpanrujukan = $this->m_apmbpjs->insertrefrujukanpasien($temp_data);
        }


    }

    function cariRujukanbyno($noRujukan,$asal)
    {

        $koneksi = $this->m_apmbpjs->koneksi();
        if ($koneksi->num_rows() > 0) {
            foreach ($koneksi->result() as $row) {
                $dataid = $row->consid;
                $secretKey = $row->secretid;
                $localIP = $row->ipsep;
                $ws = $row->webservice;
                $namappk = $row->namappk;
                $user_key = $row->user_key;
            }
        }


        if ($asal == 1){
            $ket = '/Rujukan/{parameter}';
        }else {
            $ket = '/Rujukan/RS/{parameter}';
        }
        $ket_service	= str_replace('{parameter}',$noRujukan,$ket);
        $url = "https://".$localIP."/".$ws.$ket_service;
        //echo $url;
        date_default_timezone_set('UTC');
        $tStamp = strval(time()-strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $dataid."&".$tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $urlencodedSignature = urlencode($encodedSignature);

        $arrheader =  array(
            'X-cons-id: '.$dataid,
            'X-timestamp: '.$tStamp,
            'X-signature: '.$encodedSignature,
            'user_key:'.$user_key
        );
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $arrheader);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);

        $result = curl_exec($curl);
        curl_close($curl);
        //return $result;
        $resultarr = json_decode($result, true);
        $code = $resultarr['metaData']['code'];
        $message = $resultarr['metaData']['message'];

        $respon = $resultarr['response'];
        if ($code <> 200){
            $data2 = array(
                'message'		=>	$message
            );
            echo json_encode($data2);
        }else{
            $jsondata=stringDecrypt($respon,$dataid,$secretKey,$tStamp);

            //print_r ($jsondata);
            $data 		= json_decode($jsondata, true);
            $data2 = array(
                'nama'      	=>  $data['rujukan']['peserta']['nama'],
                'peserta'		=>	$data['rujukan']['peserta']['jenisPeserta']['keterangan'],
                'sex'   		=>  $data['rujukan']['peserta']['sex'],
                'pisa'    		=>  $data['rujukan']['peserta']['pisa'],
                'tgllahir' 		=>  $data['rujukan']['peserta']['tglLahir'],
                'klstanggungan' =>  $data['rujukan']['peserta']['hakKelas']['keterangan'],
                'tglcetakkartu' =>  $data['rujukan']['peserta']['tglCetakKartu'],
                'tmt' 			=>  $data['rujukan']['peserta']['tglTMT'],
                'tat'			=>  $data['rujukan']['peserta']['tglTAT'],
                'message'		=>	$message,
                'kdppk1'      	=>  $data['rujukan']['peserta']['provUmum']['kdProvider'],
                'namappk1'    	=>  $data['rujukan']['peserta']['provUmum']['nmProvider'],
                'noRujukan'     =>  $data['rujukan']['noKunjungan'],
                'kodeDiagnosa' 	=>	$data['rujukan']['diagnosa']['kode'],
                'namaDiagnosa'	=>	$data['rujukan']['diagnosa']['nama'],
                'kodeRujukan'	=>	$data['rujukan']['provPerujuk']['kode'],
                'namaRujukan'	=>	$data['rujukan']['provPerujuk']['nama'],
                'tglRujukan'	=>	$data['rujukan']['tglKunjungan'],
                'status'		=>	$data['rujukan']['peserta']['statusPeserta']['keterangan'],
                'dinsos'		=>	$data['rujukan']['peserta']['informasi']['dinsos'],
                'prb'			=>	$data['rujukan']['peserta']['informasi']['prolanisPRB'],
                'cob'			=>	$data['rujukan']['peserta']['cob']['nmAsuransi'],
                'kdPoli'		=>	$data['rujukan']['poliRujukan']['kode'],
                'nmPoli'		=>	$data['rujukan']['poliRujukan']['nama']
            );
            echo json_encode($data2);
        }

    }

    function getsepv1($today, $noKartu, $tglRujukan, $noRujukan, $ppkRujukan, $diagAwal, $kdPoli, $noMr, $faskes, $notelpon, $nosurat, $dpjp, $cob)
    {
        $koneksi = $this->m_apmbpjs->koneksi();
        if ($koneksi->num_rows() > 0) {
            foreach ($koneksi->result() as $row) {
                $dataid = $row->consid;
                $secretKey = $row->secretid;
                $localIP = $row->ipsep;
                $ws = $row->webservice;
                $namappk = $row->namappk;
                $kodeppk = $row->kodeppk;
                $user_key = $row->user_key;
            }
        }

        $url = "https://" . $localIP . "/" . $ws . "/SEP/1.1/insert"; //Lihat katalog, jangan sertakan port

        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $dataid . "&" . $tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $urlencodedSignature = urlencode($encodedSignature);

        $arrheader = array(
            'X-cons-id: ' . $dataid,
            'X-timestamp: ' . $tStamp,
            'X-signature: ' . $encodedSignature
        );


        $databpjs = '{
		"request" :
			{
			"t_sep":
				{
				"noKartu" : "' . $noKartu . '",
				"tglSep" : "' . $today . '",
				"ppkPelayanan" : "' . $kodeppk . '",
				"jnsPelayanan" : "2",
				"klsRawat" : "3",
				"noMR" :"' . $noMr . '",
				"rujukan":{
					"asalRujukan":"' . $faskes . '",
					"tglRujukan" : "' . $tglRujukan . '",
					"noRujukan" : "' . $noRujukan . '",
					"ppkRujukan" : "' . $ppkRujukan . '",
				},
				"catatan" : "APM2",
				"diagAwal" : "' . $diagAwal . '",
				"poli": {
						"tujuan": "' . $kdPoli . '",
						"eksekutif": "0"
					 },
				"cob": {
						"cob": "' . $cob . '"
					 },
					 "katarak": {
						"katarak": "0"
					 },
					 "jaminan": {
						"lakaLantas": "0",
						"penjamin": {
							"penjamin": "1",
							"tglKejadian": "2018-08-06",
							"keterangan": "kll",
							"suplesi": {
								"suplesi": "0",
								"noSepSuplesi": "0301R0010718V000001",
								"lokasiLaka": {
									"kdPropinsi": "03",
									"kdKabupaten": "0050",
									"kdKecamatan": "0574"
									}
							}
						}
					 },
					 "skdp": {
						"noSurat": "' . $nosurat . '",
						"kodeDPJP": "' . $dpjp . '"
					 },
				"noTelp": "' . $notelpon . '",
				"user": "rs"
				}
			}
		}';
        //print_r ($databpjs);
        //exit;
        $data = array(
            'Data' => $databpjs
        );


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $arrheader);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $databpjs);

        $result = curl_exec($curl);
        curl_close($curl);
        //echo $result;

        $resultarr = json_decode($result, true);
        return $resultarr;
    }

    function getsepv2($today, $noKartu, $kdkelasrwt, $tglRujukan, $noRujukan, $ppkRujukan, $diagAwal, $kdPoli, $noMr, $faskes, $notelpon, $nosurat, $dpjp, $cob)
    {

        $koneksi = $this->m_apmbpjs->koneksi();
        if ($koneksi->num_rows() > 0) {
            foreach ($koneksi->result() as $row) {
                $dataid = $row->consid;
                $secretKey = $row->secretid;
                $localIP = $row->ipsep;
                $ws = $row->webservice;
                $namappk = $row->namappk;
                $kodeppk = $row->kodeppk;
                $user_key = $row->user_key;
            }
        }

        $url = "https://" . $localIP . "/" . $ws . "/SEP/2.0/insert"; //Lihat katalog, jangan sertakan port


        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $dataid . "&" . $tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        $urlencodedSignature = urlencode($encodedSignature);

        $arrheader = array(
            'X-cons-id: ' . $dataid,
            'X-timestamp: ' . $tStamp,
            'X-signature: ' . $encodedSignature
        );

        $databpjs = '{
           "request":{
              "t_sep":{
                 "noKartu":"' . $noKartu . '",
                 "tglSep":"' . $today . '",
                 "ppkPelayanan":"' . $kodeppk . '",
                 "jnsPelayanan":"2",
                 "klsRawat":{
                    "klsRawatHak":"' . $kdkelasrwt . '",
                    "klsRawatNaik":"",
                    "pembiayaan":"",
                    "penanggungJawab":""
                 },
                 "noMR":"' . $noMr . '",
                 "rujukan":{
                    "asalRujukan":"' . $faskes . '",
                    "tglRujukan":"' . $tglRujukan . '",
                    "noRujukan":"' . $noRujukan . '",
                    "ppkRujukan":"' . $ppkRujukan . '"
                 },
                 "catatan":"APM",
                 "diagAwal":"' . $diagAwal . '",
                 "poli":{
                    "tujuan":"' . $kdPoli . '",
                    "eksekutif":"0"
                 },
                 "cob":{
                    "cob":"' . $cob . '"
                 },
                 "katarak":{
                    "katarak":"0"
                 },
                 "jaminan":{
                    "lakaLantas":"0",
                    "penjamin":{
                       "tglKejadian":"",
                       "keterangan":"",
                       "suplesi":{
                          "suplesi":"0",
                          "noSepSuplesi":"",
                          "lokasiLaka":{
                             "kdPropinsi":"",
                             "kdKabupaten":"",
                             "kdKecamatan":""
                          }
                       }
                    }
                 },
                 "tujuanKunj":"0",
                 "flagProcedure":"",
                 "kdPenunjang":"",
                 "assesmentPel":"",
                 "skdp":{
                    "noSurat":"' . $nosurat . '",
                    "kodeDPJP":"' . $dpjp . '"
                 },
                 "dpjpLayan":"' . $dpjp . '",
                 "noTelp":"' . $notelpon . '",
                 "user":"APM"
              }
           }
        }';

        $data = array(
            'Data' => $databpjs
        );


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $arrheader);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $databpjs);

        $result = curl_exec($curl);
        curl_close($curl);
        //echo $result;

        $resultarr = json_decode($result, true);
        return $resultarr;
    }
}