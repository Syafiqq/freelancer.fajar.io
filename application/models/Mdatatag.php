<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 12 December 2016, 7:38 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdatatag extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function clear($data)
    {
        $query = 'DELETE FROM `data_tag` WHERE `data` = ?';
        $this->db->query($query, array((int)$data));
    }

    /**
     * @param int $data
     * @param array $tag
     */
    public function add($data, $tag)
    {
        $query = 'INSERT INTO `data_tag`(`data`, `tag`) VALUES (?, ?)';
        $this->db->trans_start();
        foreach ($tag as $tv)
        {
            $this->db->query($query, array((int)$data, (int)$tv));
        }
        $this->db->trans_complete();
    }

    /*    public function getLatestTimestamp()
        {
            $query = 'SELECT `timestamp` FROM `data_tag` ORDER BY `timestamp` DESC LIMIT 1';
            $result = $this->db->query($query);
            return $result->result_array();
        }

        public function getDataWithinBound($from, $to)
        {
            $query = 'SELECT `data`, `tag`, `timestamp` FROM `data_tag` WHERE `timestamp` > ? AND `timestamp` <= ?';
            $result = $this->db->query($query, array($from, $to));
            return $result->result_array();
        }*/

    public function getAll()
    {
        $query = 'SELECT `data`, `tag` FROM `data_tag`';
        $result = $this->db->query($query);
        return $result->result_array();
    }
}