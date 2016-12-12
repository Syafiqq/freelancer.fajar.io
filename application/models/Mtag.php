<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 11 December 2016, 10:40 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtag extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function create($name, $description, $color, $colortext)
    {
        $query = 'INSERT INTO `tag`(`id`, `name`, `description`, `color`, `colortext`, `timestamp`) VALUES (NULL, ?, ?, ?, ?, CURRENT_TIMESTAMP)';
        $this->db->query($query, array($name, $description, $color, $colortext));
    }

    public function getFromDataTag($data)
    {
        $query = 'SELECT `tag`.`id`, `tag`.`name`, `tag`.`description`, `tag`.`color`, `tag`.`colortext` FROM `tag` RIGHT OUTER JOIN `data_tag` ON `data_tag`.`tag` = `tag`.`id` WHERE `data_tag`.`data` = ? ORDER BY `tag`.`id` ASC ';
        $result = $this->db->query($query, array((int)$data));
        return $result->result_array();
    }

    public function getIDFromDataTag($data)
    {
        $query = 'SELECT `tag`.`id` FROM `tag` RIGHT OUTER JOIN `data_tag` ON `data_tag`.`tag` = `tag`.`id` WHERE `data_tag`.`data` = ? ORDER BY `tag`.`id` ASC ';
        $result = $this->db->query($query, array((int)$data));
        return $result->result_array();
    }

    public function getAll()
    {
        $query = 'SELECT `id`, `name`, `description`, `color`, `colortext` FROM `tag` ORDER BY `id` ASC ';
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getAllID()
    {
        $query = 'SELECT `id` FROM `tag` ORDER BY `id` ASC ';
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getLatestTimestamp()
    {
        $query = 'SELECT `timestamp` FROM `tag` ORDER BY `timestamp` DESC LIMIT 1';
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function getDataWithinBound($from, $to)
    {
        $query = 'SELECT `id`, `name`, `description`, `color`, `colortext`, `timestamp` FROM `tag` WHERE `timestamp` > ? AND `timestamp` <= ?';
        $result = $this->db->query($query, array($from, $to));
        return $result->result_array();
    }
}