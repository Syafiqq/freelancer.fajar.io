<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 27 May 2017, 3:44 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
use Carbon\Carbon;

defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends CI_Controller
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
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index()
    {
        $this->load->model('mtag');
        $result = $this->mtag->getAll();

        if (isset($_SESSION['user']['profile']))
        {
            $this->load->view('tag/list', array('year' => Carbon::now()->year, 'dataCount' => $result));
        }
        else
        {
            show_404();
        }
    }

    public function create()
    {
        if (isset($_SESSION['user']['profile']))
        {
            $this->load->view('tag/create', array('year' => Carbon::now()->year));
        }
        else
        {
            show_404();
        }
    }

    public function edit()
    {
        if (!isset($_GET['id']))
        {
            redirect('tag');
        }
        $this->load->model('mtag');
        $result = $this->mtag->getFromID($_GET['id']);
        if (count($result) <= 0)
        {
            redirect('tag/create');

            return;
        }
        $result = $result[0];

        if (isset($_SESSION['user']['profile']))
        {
            $this->load->view('tag/edit', array('year' => Carbon::now()->year, 'data' => $result));
        }
        else
        {
            show_404();
        }
    }

    public function do_create()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_SESSION['user']['profile']))
            {
                if (isset($_POST['name']) &&
                    isset($_POST['description']) &&
                    isset($_POST['color']) &&
                    isset($_POST['colortext'])
                )
                {
                    $this->load->model('mtag');
                    $this->load->model('mversion');
                    $this->mtag->create($_POST['name'], $_POST['description'], $_POST['color'], $_POST['colortext']);
                    $this->mversion->insert();
                    echo json_encode(array('code' => 200, 'message' => 'Create Tag Success', 'redirect' => site_url('tag'), 'data' => array('notify' => array(
                        array('Create Tag Success', 'success')
                    ))));
                }
            }
            else
            {
                echo json_encode(array('code' => 401, 'message' => 'Access Denied', 'data' => array('notify' => array(
                    array('Access Denied', 'danger')
                ))));
            }
        }
        else
        {
            echo json_encode(array('code' => 401, 'message' => 'Bad Request', 'data' => array('notify' => array(
                array('Bad Request', 'danger')
            ))));
        }
    }

    public function do_edit()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_SESSION['user']['profile']))
            {
                if (!isset($_GET['id']))
                {
                    echo json_encode(array('code' => 401, 'message' => 'Insufficient Data', 'data' => array('notify' => array(
                        array('Insufficient Data', 'danger')
                    ))));
                }
                else
                {
                    if (isset($_POST['name']) &&
                        isset($_POST['description']) &&
                        isset($_POST['color']) &&
                        isset($_POST['colortext'])
                    )
                    {
                        $this->load->model('mtag');
                        $this->load->model('mversion');
                        $this->mtag->edit($_GET['id'], $_POST['name'], $_POST['description'], $_POST['color'], $_POST['colortext']);
                        $this->mversion->insert();
                        echo json_encode(array('code' => 200, 'message' => 'Edit Tag Success', 'redirect' => site_url('tag'), 'data' => array('notify' => array(
                            array('Edit Tag Success', 'success')
                        ))));
                    }
                }
            }
            else
            {
                echo json_encode(array('code' => 401, 'message' => 'Access Denied', 'data' => array('notify' => array(
                    array('Access Denied', 'danger')
                ))));
            }
        }
        else
        {
            echo json_encode(array('code' => 401, 'message' => 'Bad Request', 'data' => array('notify' => array(
                array('Bad Request', 'danger')
            ))));
        }
    }

    public function do_delete()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_SESSION['user']['profile']))
            {
                if (!isset($_GET['id']))
                {
                    echo json_encode(array('code' => 401, 'message' => 'Insufficient Data', 'data' => array('notify' => array(
                        array('Insufficient Data', 'danger')
                    ))));
                }
                else
                {
                    $this->load->model('mtag');
                    $this->load->model('mversion');
                    $this->mtag->delete($_GET['id']);
                    $this->mversion->insert();
                    echo json_encode(array('code' => 200, 'message' => 'Delete Data Success', 'redirect' => site_url('tag'), 'data' => array('notify' => array(
                        array('Delete Data Success', 'success')
                    ))));
                }
            }
            else
            {
                echo json_encode(array('code' => 401, 'message' => 'Access Denied', 'data' => array('notify' => array(
                    array('Access Denied', 'danger')
                ))));
            }
        }
        else
        {
            echo json_encode(array('code' => 401, 'message' => 'Bad Request', 'data' => array('notify' => array(
                array('Bad Request', 'danger')
            ))));
        }
    }
}

?>
