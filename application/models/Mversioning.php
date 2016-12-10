<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 10 December 2016, 6:49 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Mversioning extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    /**
     * @param $user
     * @param $timstamp
     * @return array
     */
    public function createAndLoadVersion($user, $timstamp)
    {
        $this->create($user, $timstamp);
        return $this->loadFromData($user, $timstamp);
    }

    public function create($user, $timestamp)
    {
        $query = 'INSERT INTO `versioning`(`id`, `user`, `timestamp`) VALUES (NULL, ?, ?)';
        $this->db->query($query, array($user, $timestamp));
    }

    /**
     * @param $user
     * @param $timestamp
     * @return array mixed
     */
    public function loadFromData($user, $timestamp)
    {
        $query = 'SELECT `id`, `user`, `timestamp` FROM `versioning` WHERE `user` = ? AND `timestamp` = ? LIMIT 1';
        $result = $this->db->query($query, array($user, $timestamp));
        return $result->result_array();
    }
}


