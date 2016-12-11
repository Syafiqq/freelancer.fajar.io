<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 10 December 2016, 10:16 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
use Carbon\Carbon;

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        $this->load->helper('url');
        $this->load->library('session');
        // Your own constructor code
    }

    public function index()
    {
        if (!isset($_GET['century']))
        {
            $_GET['century'] = 1900;
        }
        $centuryTo = $_GET['century'] + 99;
        $this->load->model('mdata');
        $result = $this->mdata->getCountPerYear($_GET['century'], $centuryTo);

        $data = array();
        $idx = $_GET['century'] - 1;
        foreach ($result as $value)
        {
            for ($idx, $is = $value['year']; ++$idx < $is;)
            {
                array_push($data, array('year' => $idx, 'count' => 0));
            }

            array_push($data, $value);
        }
        for ($i = $idx, $is = $centuryTo + 1; ++$i < $is;)
        {
            array_push($data, array('year' => $i, 'count' => 0));
        }


        if (isset($_SESSION['user']['profile']))
        {
            $this->load->view('dashboard/index_admin', array('year' => Carbon::now()->year, 'isVersionEnabled' => isset($_SESSION['user']['version']), 'dataCount' => $data));
        }
        else
        {
            $this->load->view('dashboard/index_free', array('year' => Carbon::now()->year, 'dataCount' => $data));
        }
    }

    public function year()
    {
        if (!isset($_GET['year']))
        {
            $_GET['year'] = 1945;
        }
        $this->load->model('mdata');
        $this->load->model('mtag');
        $result = $this->mdata->getDataNoAccordingToYear($_GET['year']);
        if (count($result) <= 0)
        {
            $result = array();
        }
        else
        {
            foreach ($result as $key => $value)
            {
                if ($value['tag'] <= 0)
                {
                    $result[$key]['tag'] = array();
                }
                else
                {
                    $result[$key]['tag'] = $this->mtag->getFromDataTag($value['id']);
                }
            }

        }


        if (isset($_SESSION['user']['profile']))
        {
            $this->load->view('dashboard/year_admin', array('year' => Carbon::now()->year, 'isVersionEnabled' => isset($_SESSION['user']['version']), 'data' => $result, 'dataYear' => $_GET['year']));
        }
        else
        {
            $this->load->view('dashboard/year_free', array('year' => Carbon::now()->year, 'data' => $result, 'dataYear' => $_GET['year']));
        }
    }

    public function do_versioning()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_SESSION['user']['profile']))
            {
                $this->load->model('mversioning');
                $result = $this->mversioning->createAndLoadVersion($_SESSION['user']['profile']['id'], Carbon::now('UTC')->toDateTimeString());
                if (count($result) > 0)
                {
                    $_SESSION['user']['version'] = $result[0];
                    echo json_encode(array('code' => 200, 'message' => 'Editing Enabled', 'redirect' => site_url('dashboard'), 'data' => array('notify' => array(
                        array('Editing Enabled', 'success')
                    ))));
                }
                else
                {
                    echo json_encode(array('code' => 403, 'message' => 'Failed to Enable', 'data' => array('notify' => array(
                        array('Failed to Enable', 'info')
                    ))));
                }
            }
            else
            {
                echo json_encode(array('code' => 402, 'message' => 'Access Denied', 'data' => array('notify' => array(
                    array('Access Denied', 'info')
                ))));
            }
        }
        else
        {
            echo json_encode(array('code' => 401, 'message' => 'Bad Request', 'data' => array('notify' => array(
                array('danger', 'Bad Request')
            ))));
        }
    }

    public function do_get_detail()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (!isset($_GET['id']))
            {
                $_GET['id'] = 1;
            }
            $this->load->model('mdata');
            $result = $this->mdata->getData($_GET['id']);
            if (count($result) > 0)
            {
                $result = $result[0];
                $this->load->model('mtag');
                $result['tag'] = $this->mtag->getFromDataTag($result['id']);
            }
            else
            {
                $result = null;
            }

            echo json_encode(array('code' => 200, 'message' => 'Get Data Success', 'data' => array('result' => $result, 'edit' => site_url('dashboard/edit?id=' . $_GET['id'])
            , 'notify' => array(
                    array('Get Data Success', 'success')
                ))));
        }
        else
        {
            echo json_encode(array('code' => 401, 'message' => 'Bad Request', 'data' => array('notify' => array(
                array('danger', 'Bad Request')
            ))));
        }
    }
}
