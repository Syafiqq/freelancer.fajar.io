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
        $this->load->helper('cookie');
        // Your own constructor code
    }


    public function index()
    {
        $this->load->model('mdata');
        $categories = $this->mdata->getCategoryCount();
        if (isset($_SESSION['user']['profile']))
        {
            $view = get_cookie('view_layout');
            if (!empty($view))
            {
                switch ($view)
                {
                    case 'all' :
                    {
                        $layout = 'dashboard/index_admin_layout_all';
                        $data = array('year' => Carbon::now()->year, 'meta' => array('domain' => site_url(), 'path' => '/dashboard', 'source' => site_url('/dashboard/do_retrieve_all')));
                    }
                        break;
                    case 'search' :
                    {
                        $layout = 'dashboard/index_admin_layout_search';
                        $data = array('year' => Carbon::now()->year, 'meta' => array('domain' => site_url(), 'path' => '/dashboard', 'source' => site_url('/dashboard/do_retrieve_all')));
                    }
                        break;
                    default :
                    {
                        $layout = 'dashboard/index_admin_default';
                        $data = array('year' => Carbon::now()->year, 'categories' => $categories, 'meta' => array('domain' => base_url(), 'path' => '/dashboard'));
                    }
                }
            }
            else
            {
                $layout = 'dashboard/index_admin_default';
                $data = array('year' => Carbon::now()->year, 'categories' => $categories, 'meta' => array('domain' => base_url(), 'path' => '/dashboard'));
            }
            $this->load->view($layout, $data);
        }
        else
        {
            $this->load->view('dashboard/index_free', array('year' => Carbon::now()->year, 'categories' => $categories));
        }
    }

    public function do_retrieve_all()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            $content = $this->_getAllData();
            echo json_encode(array('code' => 200, 'message' => 'Accepted', 'redirect' => site_url('dashboard'), 'data' => array('data' => $content, 'on_edit' => site_url('law/do_get_detail?id='), 'notify' => array(
                array('Authentication complete', 'success')
            ))));
        }
        else
        {
            echo json_encode(array('code' => 401, 'message' => 'Bad Request', 'data' => array('notify' => array(
                array('danger', 'Bad Request')
            ))));
        }
    }

    private function _getAllData()
    {
        $this->load->model('mdata');
        $this->load->model('mcategory');
        $this->load->model('mtag');
        $data = $this->mdata->getAllDataNo();
        $_category = array();
        $category = $this->mcategory->getAll();
        foreach ($category as $value)
        {
            $_category["${value['id']}."] = $value;
        }
        unset($category);
        $category = $_category;
        unset($_category);
        if (count($data) <= 0)
        {
            $data = array();
        }
        else
        {
            foreach ($data as $key => $value)
            {
                if ($value['tag'] <= 0)
                {
                    $data[$key]['tag'] = array();
                }
                else
                {
                    $data[$key]['tag'] = $this->mtag->getFromDataTag($value['id']);
                }
                $data[$key]['category'] =& $category["${value['category']}."];
            }
        }

        return $data;
    }

    public function do_search()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_SESSION['user']['profile']))
            {
                if (isset($_POST['description']) &&
                    isset($_POST['year']) &&
                    isset($_POST['no']) &&
                    isset($_POST['status'])
                )
                {
                    if (empty($_POST['description']))
                    {
                        $_POST['description'] = null;
                    }
                    if (empty($_POST['year']))
                    {
                        $_POST['year'] = null;
                    }
                    if (empty($_POST['no']))
                    {
                        $_POST['no'] = null;
                    }
                    if (empty($_POST['status']))
                    {
                        $_POST['status'] = null;
                    }

                    $content = $this->_getAllDataWithConstraint($_POST['year'], $_POST['no'], $_POST['description'], $_POST['status']);
                    echo json_encode(array('code' => 200, 'message' => 'Accepted', 'redirect' => site_url('dashboard'), 'data' => array('data' => $content, 'on_edit' => site_url('law/do_get_detail?id='), 'notify' => array(
                        array('Authentication complete', 'success')
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

    private function _getAllDataWithConstraint($year, $no, $description, $status)
    {
        $this->load->model('mdata');
        $this->load->model('mcategory');
        $this->load->model('mtag');
        if (!empty($description))
        {
            $description = explode(' ', $description);
        }
        if (!empty($status))
        {
            $status = explode(' ', $status);
        }

        $data = $this->mdata->getAllDataNoWithConstraint($year, $no, $description, $status);
        $_category = array();
        $category = $this->mcategory->getAll();
        foreach ($category as $value)
        {
            $_category["${value['id']}."] = $value;
        }
        unset($category);
        $category = $_category;
        unset($_category);
        if (count($data) <= 0)
        {
            $data = array();
        }
        else
        {
            foreach ($data as $key => $value)
            {
                if ($value['tag'] <= 0)
                {
                    $data[$key]['tag'] = array();
                }
                else
                {
                    $data[$key]['tag'] = $this->mtag->getFromDataTag($value['id']);
                }
                $data[$key]['category'] =& $category["${value['category']}."];
                if (strlen($data[$key]['description']) > 50)
                {
                    $pos = strpos($data[$key]['description'], ' ', 50);
                    $data[$key]['description'] = substr($data[$key]['description'], 0, $pos) . '...';
                }

            }
        }

        return $data;
    }

}
