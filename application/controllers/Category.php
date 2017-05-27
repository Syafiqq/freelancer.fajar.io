<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 27 May 2017, 3:59 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
use Carbon\Carbon;

defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller
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
        $this->load->model('mcategory');
        $result = $this->mcategory->getAll();

        if (isset($_SESSION['user']['profile']))
        {
            $this->load->view('category/list', array('year' => Carbon::now()->year, 'categories' => $result));
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
            $this->load->view('category/create', array('year' => Carbon::now()->year));
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
            redirect('category');
        }
        $this->load->model('mcategory');
        $result = $this->mcategory->findByID($_GET['id']);
        if (empty($result))
        {
            redirect('category');

            return;
        }
        $result = $result[0];

        if (isset($_SESSION['user']['profile']))
        {
            $this->load->view('category/edit', array('year' => Carbon::now()->year, 'data' => $result));
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
                    isset($_POST['slug'])
                )
                {
                    $this->load->model('mcategory');
                    $this->load->model('mversion');
                    $this->mcategory->insert(null, $_POST['name'], $_POST['slug']);
                    $this->mversion->insert();
                    echo json_encode(array('code' => 200, 'message' => 'Create Kategori Success', 'redirect' => site_url('category'), 'data' => array('notify' => array(
                        array('Create Kategori Success', 'success')
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
                        isset($_POST['slug'])
                    )
                    {
                        $this->load->model('mcategory');
                        $this->load->model('mversion');
                        $this->mcategory->patch($_GET['id'], $_POST['name'], $_POST['slug']);
                        $this->mversion->insert();
                        echo json_encode(array('code' => 200, 'message' => 'Edit Kategori Success', 'redirect' => site_url('category'), 'data' => array('notify' => array(
                            array('Edit Kategori Success', 'success')
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
                    $this->load->model('mcategory');
                    $this->load->model('mversion');
                    $this->mcategory->delete($_GET['id']);
                    $this->mversion->insert();
                    echo json_encode(array('code' => 200, 'message' => 'Delete Data Success', 'redirect' => site_url('category'), 'data' => array('notify' => array(
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
