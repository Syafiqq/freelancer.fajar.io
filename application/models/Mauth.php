<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 10 December 2016, 6:20 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Mauth extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    /**
     * @param string $email
     * @param string $password
     * @return array
     */
    public function login($email, $password)
    {
        $query = 'SELECT `id`, `name`, `email`, `password` FROM `user` WHERE `email` = ? AND `password` = ? LIMIT 1';
        $result = $this->db->query($query, array($email, md5(md5($password))));
        return $result->result_array();
    }
}