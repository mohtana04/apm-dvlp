<?php
/**
 * Created by PhpStorm.
 * User: mohtana_04
 * Date: 16/11/2021
 * Time: 14:32
 */

class m_apmbpjs extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }


    // model postrwi
    function cekprb($no)
    {

        $this->db->select('*');
        $this->db->from('bpjs_prb');
        $this->db->where('nocm =', $no);
        $this->db->or_where('nokartu =', $no);
        $this->db->where('lock', '1');
        $query = $this->db->get();
        return $query;

    }

    function cekappointment($no)
    {
        $this->db->select('*');
        $this->db->from('vw_app_today2');
        $this->db->where('no_mr =', $no);
        $this->db->or_where('nokartu =', $no);
        $query = $this->db->get();
        return $query;
    }

    function sendbpjslog($data)
    {
        $this->db->insert('bpjs_log', $data);
    }

    function tgllahirpasien($nocm)
    {
        $this->db->select('tgl_lahir');
        $this->db->from('masterpasien');
        $this->db->where('no_mr =', $nocm);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $tgl_lahir = $row->tgl_lahir;
            return $tgl_lahir;
        }
    }

    function jadwaldoktertdkpraktek($where)
    {
        $this->db->select('*');
        $this->db->from('jadwaldrtidakpraktek');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;

    }

    function cekdokterselesaipraktek($where)
    {
        $this->db->select('*');
        $this->db->from('appointment');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }

    function koneksi()
    {
        $this->db->select('*');
        $this->db->from('koneksi2');
        $query = $this->db->get();
        return $query;
    }


    function refhistory($where)
    {
        $this->db->select('*');
        $this->db->from('bpjs_refhistori');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }

    function insertrefhistory($data)
    {
        $this->db->insert('bpjs_refhistori', $data);
        return $this->db->affected_rows() > 0;
    }


    function cekseprwi($where)
    {
        $this->db->select('*');
        $this->db->from('bpjs_refhistori');
        $this->db->where($where);
        $this->db->order_by('tglsep', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query;
    }

    function caripolispesialistik($dokterid)
    {
        $this->db->select('*');
        $this->db->from('bpjs_refdokter');
        $this->db->where('dokterid =', $dokterid);
        $query = $this->db->get();

        return $query;
    }

    function refrujukanpasien ($where){
        $this->db->select('*');
        $this->db->from('bpjs_refrujukanpasien');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }

    function insertrefrujukanpasien ($where){
        $this->db->insert('bpjs_refrujukanpasien', $where);
        return $this->db->affected_rows() > 0;
    }

    function pasienmobilejkn($where){
        $this->db->select('*');
        $this->db->from('pasienmobilejkn');
        $this->db->where($where);
        $query = $this->db->get();
        return $query;
    }
}