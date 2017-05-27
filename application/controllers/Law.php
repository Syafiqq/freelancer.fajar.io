<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 27 May 2017, 1:52 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
use Carbon\Carbon;

defined('BASEPATH') OR exit('No direct script access allowed');

class Law extends CI_Controller
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
        $this->create();
    }

    public function create()
    {
        if (isset($_SESSION['user']['profile']))
        {
            $this->load->model('mtag');
            $this->load->model('mcategory');
            $tags = $this->mtag->getAll();
            $categories = $this->mcategory->getAll();
            $this->load->view('law/create', array('year' => Carbon::now()->year, 'tags' => $tags, 'categories' => $categories));
        }
        else
        {
            show_404();
        }
    }

    public function century()
    {
        $this->load->model('mdata');

        $result = $this->mdata->getCountPerYear($_GET['category']);
        $category = $this->mdata->findCategoryByID($_GET['category'])[0];

        if (isset($_SESSION['user']['profile']))
        {
            $this->load->view('law/century_admin', array('year' => Carbon::now()->year, 'dataCount' => $result, 'category' => $_GET['category'], 'metadata' => ['category' => $category]));
        }
        else
        {
            $this->load->view('law/century_free', array('year' => Carbon::now()->year, 'dataCount' => $result, 'category' => $_GET['category'], 'metadata' => ['category' => $category]));
        }
    }

    public function year()
    {
        if (!isset($_GET['year']))
        {
            redirect('dashboard');
        }
        $this->load->model('mdata');
        $this->load->model('mtag');
        $result = $this->mdata->getDataNoAccordingToYear($_GET['year'], $_GET['category']);
        $category = $this->mdata->findCategoryByID($_GET['category'])[0];
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
            $this->load->view('law/year_admin', array('year' => Carbon::now()->year, 'data' => $result, 'dataYear' => $_GET['year'], 'metadata' => ['category' => $category]));
        }
        else
        {
            $this->load->view('law/year_free', array('year' => Carbon::now()->year, 'data' => $result, 'dataYear' => $_GET['year'], 'metadata' => ['category' => $category]));
        }
    }

    public function edit()
    {
        if (isset($_SESSION['user']['profile']))
        {
            if (!isset($_GET['id']))
            {
                redirect('dashboard');
            }

            $this->load->model('mtag');
            $this->load->model('mcategory');
            $this->load->model('mdata');
            $tags = $this->mtag->getAll();
            $categories = $this->mcategory->getAll();
            $result = $this->mdata->getData($_GET['id']);
            $category = [];
            if (count($result) > 0)
            {
                $result = $result[0];
                $category = $this->mdata->findCategoryByID($result['category'])[0];
                $result['tag'] = $this->mtag->getIDFromDataTag($result['id']);
            }
            else
            {
                $result = null;
            }

            $this->load->view('law/edit', array('year' => Carbon::now()->year, 'data' => $result, 'tags' => $tags, 'metadata' => ['category' => $category], 'categories' => $categories));
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
                $_POST['tag'] = isset($_POST['tag']) ? $_POST['tag'] : array();
                if (isset($_POST['tag']) &&
                    isset($_POST['description']) &&
                    isset($_POST['year']) &&
                    isset($_POST['no']) &&
                    isset($_POST['category']) &&
                    isset($_POST['status']) &&
                    isset($_POST['reference'])
                )
                {
                    $this->load->model('mdata');
                    $this->load->model('mdatatag');
                    $this->load->model('mtag');
                    $this->load->model('mcategory');
                    $this->load->model('mversion');
                    $tags = $this->mtag->getAllID();
                    if (!is_array($_POST['tag']))
                    {
                        $_POST['tag'] = array($_POST['tag']);
                    }
                    foreach ($_POST['tag'] as $tv)
                    {
                        $gt = false;
                        foreach ($tags as $ttv)
                        {
                            if ($tv == $ttv['id'])
                            {
                                $gt = true;
                                break;
                            }
                        }
                        if (!$gt)
                        {
                            echo json_encode(array('code' => 401, 'message' => 'Invalid Data', 'data' => array('notify' => array(
                                array('Invalid Data', 'danger')
                            ))));

                            return;
                        }
                    }

                    $category = $this->mcategory->findByID($_POST['category']);
                    if (empty($category))
                    {
                        echo json_encode(array('code' => 401, 'message' => 'Invalid Data', 'data' => array('notify' => array(
                            array('Invalid Data', 'danger')
                        ))));

                        return;
                    }

                    if (empty($_POST['reference']))
                    {
                        $_POST['reference'] = null;
                    }

                    $this->mdata->create($_POST['no'], $_POST['year'], $_POST['description'], $_POST['status'], $_POST['category'], $_POST['reference']);
                    $status = $this->mdata->getFromNoAndYear($_POST['no'], $_POST['year']);
                    if (count($_POST['tag']) > 0)
                    {
                        $this->mdatatag->add($status[0]['id'], $_POST['tag']);
                    }
                    $this->mversion->insert();

                    echo json_encode(array('code' => 200, 'message' => 'Create Data Success', 'redirect' => site_url("law/year?year={$_POST['year']}&category={$_POST['category']}"), 'data' => array('notify' => array(
                        array('Create Data Success', 'success')
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

    public function do_get_detail()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (!isset($_GET['id']))
            {
                echo json_encode(array('code' => 401, 'message' => 'Insufficient Data', 'data' => array('notify' => array(
                    array('danger', 'Insufficient Data')
                ))));
            }
            else
            {
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

                echo json_encode(array('code' => 200, 'message' => 'Get Data Success', 'data' => array('result' => $result, 'edit' => site_url('law/edit?id=' . $_GET['id']), 'delete' => site_url('law/do_delete?id=' . $_GET['id']))));
            }
        }
        else
        {
            echo json_encode(array('code' => 401, 'message' => 'Bad Request', 'data' => array('notify' => array(
                array('danger', 'Bad Request')
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
                    $this->load->model('mdata');
                    $id = $this->mdata->getDataID($_GET['id']);
                    if (!empty($id))
                    {
                        $_POST['tag'] = isset($_POST['tag']) ? $_POST['tag'] : array();
                        if (isset($_POST['tag']) &&
                            isset($_POST['description']) &&
                            isset($_POST['status']) &&
                            isset($_POST['category']) &&
                            isset($_POST['reference'])
                        )
                        {
                            $this->load->model('mdatatag');
                            $this->load->model('mtag');
                            $this->load->model('mversion');
                            $tags = $this->mtag->getAllID();
                            if (!is_array($_POST['tag']))
                            {
                                $_POST['tag'] = array($_POST['tag']);
                            }
                            foreach ($_POST['tag'] as $tv)
                            {
                                $gt = false;
                                foreach ($tags as $ttv)
                                {
                                    if ($tv == $ttv['id'])
                                    {
                                        $gt = true;
                                        break;
                                    }
                                }
                                if (!$gt)
                                {
                                    echo json_encode(array('code' => 401, 'message' => 'Invalid Data', 'data' => array('notify' => array(
                                        array('Invalid Data', 'danger')
                                    ))));

                                    return;
                                }
                            }

                            $this->mdata->edit($_GET['id'], $_POST['description'], $_POST['status'], $_POST['category'], $_POST['reference']);
                            $this->mdatatag->clear($_GET['id']);
                            if (count($_POST['tag']) > 0)
                            {
                                $this->mdatatag->add($_GET['id'], $_POST['tag']);
                            }
                            $this->mversion->insert();
                            $year = $this->mdata->getDataYear($_GET['id']);

                            echo json_encode(array('code' => 200, 'message' => 'Edit Data Success', 'redirect' => site_url("law/year?year={$year[0]['year']}&category={$_POST['category']}"), 'data' => array('notify' => array(
                                array('Edit Data Success', 'success')
                            ))));

                        }
                        else
                        {
                            echo json_encode(array('code' => 401, 'message' => 'Insufficient Data', 'data' => array('notify' => array(
                                array('Insufficient Data', 'danger')
                            ))));
                        }
                    }
                    else
                    {
                        echo json_encode(array('code' => 401, 'message' => 'Invalid Data', 'data' => array('notify' => array(
                            array('Invalid Data', 'danger')
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
                    $this->load->model('mdata');
                    $this->load->model('mversion');
                    $this->mdata->delete($_GET['id']);
                    $this->mversion->insert();
                    echo json_encode(array('code' => 200, 'message' => 'Delete Data Success', 'data' => array('notify' => array(
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
