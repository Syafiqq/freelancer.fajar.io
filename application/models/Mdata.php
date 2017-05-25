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

    public function getCountPerYear($category)
    {
        $query = 'SELECT `year`, count(`id`) AS \'count\' FROM `data` WHERE `category` = ? GROUP BY `year` ORDER BY `year` ASC';
        $result = $this->db->query($query, [(int)$category]);

        return $result->result_array();
    }

    public function findCategoryByID($id)
    {
        $query = 'SELECT `id`, `name`, `slug` FROM `category` WHERE `id` = ?';
        $result = $this->db->query($query, [(int)$id]);

        return $result->result_array();
    }

    public function getCategoryCount()
    {
        $query = 'SELECT `category`.`id`, `category`.`name`, `category`.`slug`, count(`data`.`id`) AS \'count\' FROM `data` RIGHT OUTER JOIN `category` ON `data`.`category` = `category`.`id`  GROUP BY `category`.`id` ORDER BY `category`.`id` ASC';
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getAll()
    {
        $query = 'SELECT `id`, `year`, `no`, `description`, `status`, `category`, `reference` FROM `data` ORDER BY `id` ASC , `year` ASC ';
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getDataNoAccordingToYear($year, $category)
    {
        $query = 'SELECT `data`.`id`, `data`.`year`, `data`.`no`, `data`.`category`, `data`.`reference`, count(`data_tag`.`tag`) AS \'tag\' FROM `data` LEFT OUTER JOIN `data_tag` ON `data`.`id` = `data_tag`.`data`  WHERE `data`.`year` = ? AND `data`.`category` = ? GROUP BY `data`.`id` ORDER BY `data`.`id` ASC';
        $result = $this->db->query($query, [(int)$year, (int)$category]);
        return $result->result_array();
    }

    public function getData($id)
    {
        $query = 'SELECT `id`, `year`, `no`, `description`, `status`, `category`, `reference` FROM `data` WHERE `id` = ? LIMIT 1';
        $result = $this->db->query($query, array((int)$id));
        return $result->result_array();
    }

    public function getFromNoAndYear($no, $year)
    {
        $query = 'SELECT `id`, `year`, `no`, `description`, `status`, `category`, `reference` FROM `data` WHERE `no` = ? AND `year` = ? LIMIT 1';
        $result = $this->db->query($query, array($no, $year));
        return $result->result_array();
    }

    public function getDataYear($id)
    {
        $query = 'SELECT `year` FROM `data` WHERE `id` = ? LIMIT 1';
        $result = $this->db->query($query, array((int)$id));
        return $result->result_array();
    }

    public function getDataID($id)
    {
        $query = 'SELECT `id` FROM `data` WHERE `id` = ? LIMIT 1';
        $result = $this->db->query($query, array((int)$id));
        return $result->result_array();
    }

    public function edit($id, $description, $status)
    {
        $query = 'UPDATE `data` SET `description`=?,`status`=? WHERE `id` = ?';
        $this->db->query($query, array($description, $status, (int)$id));
    }

    public function delete($id)
    {
        $query = 'DELETE FROM `data` WHERE `id` = ?';
        $this->db->query($query, array((int)$id));
    }

    public function create($no, $year, $description, $status)
    {
        $query = 'INSERT INTO `data`(`id`, `year`, `no`, `description`, `status`) VALUES (NULL, ?, ?, ?, ?)';
        $this->db->query($query, array($year, $no, $description, $status));
    }

    /*    public function getLatestTimestamp()
        {
            $query = 'SELECT `timestamp` FROM `data` ORDER BY `timestamp` DESC LIMIT 1';
            $result = $this->db->query($query);
            return $result->result_array();
        }

        public function getDataWithinBound($from, $to)
        {
            $query = 'SELECT `id`, `year`, `no`, `description`, `status`, `timestamp` FROM `data` WHERE `timestamp` > ? AND `timestamp` <= ?';
            $result = $this->db->query($query, array($from, $to));
            return $result->result_array();
        }*/
}
