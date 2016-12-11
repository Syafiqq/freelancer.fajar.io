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

    public function getFromDataTag($data)
    {
        $query = 'SELECT `tag`.`name`, `tag`.`description`, `tag`.`color`, `tag`.`colortext` FROM `tag` RIGHT OUTER JOIN `data_tag` ON `data_tag`.`tag` = `tag`.`id` WHERE `data_tag`.`data` = ?';
        $result = $this->db->query($query, array((int)$data));
        return $result->result_array();
    }
}