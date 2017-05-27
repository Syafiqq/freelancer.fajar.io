<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 27 May 2017, 2:42 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcategory extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function insert($id = null, $name, $slug)
    {
        $query = 'INSERT INTO `category`(`id`, `name`, `slug`) VALUES (?, ?, ?)';
        $this->db->query($query, [$id, $name, $slug]);
    }

    public function getAll()
    {
        $query = 'SELECT `id`, `name`, `slug` FROM `category` ORDER BY `id` ASC';
        $result = $this->db->query($query);

        return $result->result_array();
    }

    public function findByID($id)
    {
        $query = 'SELECT `id`, `name`, `slug` FROM `category` WHERE `id`=? LIMIT 1';
        $result = $this->db->query($query, [$id]);

        return $result->result_array();
    }

    public function patch($id, $name, $slug)
    {
        $query = 'UPDATE `category` SET `name`=?,`slug`=? WHERE `id`=?';
        $this->db->query($query, [$name, $slug, $id]);
    }

    public function delete($id)
    {
        $query = 'DELETE FROM `category` WHERE `id`=?';
        $this->db->query($query, [$id]);
    }
}

?>
