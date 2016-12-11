<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 11 December 2016, 1:40 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdata extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function getCountPerYear($from, $to)
    {
        $query = 'SELECT `year`, count(`id`) AS \'count\' FROM `data` WHERE `year` >= ? AND `year` <= ? GROUP BY `year` ORDER BY `year` ASC';
        $result = $this->db->query($query, array($from, $to));
        return $result->result_array();
    }

    public function getDataNoAccordingToYear($year)
    {
        $query = 'SELECT `data`.`id`, `data`.`year`, `data`.`no`, count(`data_tag`.`tag`) AS `tag` FROM `data` LEFT OUTER JOIN `data_tag` ON `data`.`id` = `data_tag`.`data`  WHERE `data`.`year` = ? GROUP BY `data`.`id` ORDER BY `data`.`id` ASC';
        $result = $this->db->query($query, array($year));
        return $result->result_array();
    }

    public function getData($id)
    {
        $query = 'SELECT `id`, `year`, `no`, `description`, `status`, `timestamp` FROM `data` WHERE `id` = ? LIMIT 1';
        $result = $this->db->query($query, array((int)$id));
        return $result->result_array();
    }
}