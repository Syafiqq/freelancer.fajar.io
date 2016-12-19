<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 19 December 2016, 4:25 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Mversion extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function insert()
    {
        $query = 'INSERT INTO `version`(`id`, `timestamp`) VALUES (NULL, CURRENT_TIMESTAMP)';
        $this->db->query($query);
    }

    public function getLatest()
    {
        $query = 'SELECT `id`, `timestamp` FROM `version` ORDER BY `timestamp` DESC  LIMIT 1';
        $result = $this->db->query($query);
        return $result->result_array();
    }
}