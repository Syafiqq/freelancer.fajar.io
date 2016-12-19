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
                $this->load->model('mversion');
                $version = $this->mversion->getLatest();
                if (count($version) > 0)
                {
                    $version = Carbon::createFromFormat('Y-m-d H:i:s', $version[0]['timestamp']);
                }
                else
                {
                    $version = Carbon::now();
                }
                echo json_encode(array('code' => 200, 'message' => 'Accepted', 'data' => array('timestamp' => $version->toDateTimeString())));
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
                        $this->load->model('mversion');
                        $tag = $this->mtag->getAll();
                        $data = $this->mdata->getAll();
                        $datatag = $this->mdatatag->getAll();
                        $version = $this->mversion->getLatest();
                        echo json_encode(array('code' => 200, 'message' => 'Accepted', 'data' => array(
                            'tag' => $tag,
                            'data' => $data,
                            'datatag' => $datatag,
                            'version' => $version
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