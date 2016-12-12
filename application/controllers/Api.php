<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 12 December 2016, 2:05 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
use Carbon\Carbon;

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function index()
    {
        show_404();
    }

    public function latest()
    {
        if (isset($_SERVER['HTTP_X_REQUEST_ACCESS_CERTIFICATE']))
        {
            if (strcmp(strtolower($_SERVER['HTTP_X_REQUEST_ACCESS_CERTIFICATE']), 'cb2f4b3f8af65c661f71bef52cb80f4fd2590c0c7e45810573e93d4645cf0b8eca978af15b953dfbc5db2dda33ad66e02477f647e32b5b72a467e3b9f63bcb7e') === 0)
            {
                $this->load->model('mtag');
                $this->load->model('mdata');
                $this->load->model('mdatatag');
                $tagLatest = $this->mtag->getLatestTimestamp();
                $datatagLatest = $this->mdata->getLatestTimestamp();
                $dataLatest = $this->mdatatag->getLatestTimestamp();
                $timestamps = array();
                if (count($tagLatest) > 0)
                {
                    array_push($timestamps, Carbon::createFromFormat('Y-m-d H:i:s', $tagLatest[0]['timestamp']));
                    unset($tagLatest);
                }
                if (count($datatagLatest) > 0)
                {
                    array_push($timestamps, Carbon::createFromFormat('Y-m-d H:i:s', $datatagLatest[0]['timestamp']));
                    unset($datatagLatest);
                }
                if (count($dataLatest) > 0)
                {
                    array_push($timestamps, Carbon::createFromFormat('Y-m-d H:i:s', $dataLatest[0]['timestamp']));
                    unset($dataLatest);
                }
                $timestamp = Carbon::now();
                if (count($timestamps) > 0)
                {
                    $timestamp = Carbon::createFromFormat('Y-m-d H:i:s', '2000-01-01 00:00:00');
                    foreach ($timestamps as $tms)
                    {
                        if ($timestamp->lt($tms))
                        {
                            $timestamp = $tms;
                        }
                    }
                }
                echo json_encode(array('code' => 200, 'message' => 'Accepted', 'data' => array('timestamp' => $timestamp->toDateTimeString())));
            }
            else
            {
                echo json_encode(array('code' => 401, 'message' => 'Access Denied'));
            }
        }
        else
        {
            echo json_encode(array('code' => 401, 'message' => 'Access Denied'));
        }
    }

    public function stream()
    {
        if (isset($_SERVER['HTTP_X_REQUEST_ACCESS_CERTIFICATE']))
        {
            if (strcmp(strtolower($_SERVER['HTTP_X_REQUEST_ACCESS_CERTIFICATE']), 'cb2f4b3f8af65c661f71bef52cb80f4fd2590c0c7e45810573e93d4645cf0b8eca978af15b953dfbc5db2dda33ad66e02477f647e32b5b72a467e3b9f63bcb7e') === 0)
            {
                if (isset($_GET['from']) && isset($_GET['to']))
                {
                    try
                    {
                        $_GET['from'] = Carbon::createFromFormat('Y-m-d H:i:s', $_GET['from']);
                        $_GET['to'] = Carbon::createFromFormat('Y-m-d H:i:s', $_GET['to']);
                        $this->load->model('mtag');
                        $this->load->model('mdata');
                        $this->load->model('mdatatag');
                        $tag = $this->mtag->getDataWithinBound($_GET['from'], $_GET['to']);
                        $data = $this->mdata->getDataWithinBound($_GET['from'], $_GET['to']);
                        $datatag = $this->mdatatag->getDataWithinBound('2000-01-01 00:00:00', $_GET['to']);
                        echo json_encode(array('code' => 200, 'message' => 'Accepted', 'data' => array(
                            'tag' => $tag,
                            'data' => $data,
                            'datatag' => $datatag
                        )));
                    }
                    catch (InvalidArgumentException $ignored)
                    {
                        echo json_encode(array('code' => 403, 'message' => 'Invalid Data'));
                    }
                }
                else
                {
                    echo json_encode(array('code' => 402, 'message' => 'Insufficient Data'));
                }
            }
            else
            {
                echo json_encode(array('code' => 401, 'message' => 'Access Denied'));
            }
        }
        else
        {
            echo json_encode(array('code' => 401, 'message' => 'Access Denied'));
        }
    }
}