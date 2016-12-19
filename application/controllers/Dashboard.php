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
        $this->century();
    }

    public function century()
    {
        $this->load->model('mdata');
        $result = $this->mdata->getCountPerYear();

        if (isset($_SESSION['user']['profile']))
        {
            $this->load->view('dashboard/century_admin', array('year' => Carbon::now()->year, 'dataCount' => $result));
        }
        else
        {
            $this->load->view('dashboard/century_free', array('year' => Carbon::now()->year, 'dataCount' => $result));
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
            $this->load->view('dashboard/year_admin', array('year' => Carbon::now()->year, 'data' => $result, 'dataYear' => $_GET['year']));
        }
        else
        {
            $this->load->view('dashboard/year_free', array('year' => Carbon::now()->year, 'data' => $result, 'dataYear' => $_GET['year']));
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
            $this->load->model('mdata');
            $result = $this->mdata->getData($_GET['id']);
            $tags = $this->mtag->getAll();
            if (count($result) > 0)
            {
                $result = $result[0];
                $result['tag'] = $this->mtag->getIDFromDataTag($result['id']);
            }
            else
            {
                $result = null;
            }

            $this->load->view('dashboard/edit', array('year' => Carbon::now()->year, 'data' => $result, 'tags' => $tags));
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
            $this->load->model('mtag');
            $tags = $this->mtag->getAll();
            $this->load->view('dashboard/create', array('year' => Carbon::now()->year, 'tags' => $tags));
        }
        else
        {
            show_404();
        }
    }

    public function createtag()
    {
        if (isset($_SESSION['user']['profile']))
        {
            $this->load->view('dashboard/createtag', array('year' => Carbon::now()->year));
        }
        else
        {
            show_404();
        }
    }

    public function tag()
    {
        $this->load->model('mtag');
        $result = $this->mtag->getAll();

        if (isset($_SESSION['user']['profile']))
        {
            $this->load->view('dashboard/tag_admin', array('year' => Carbon::now()->year, 'dataCount' => $result));
        }
        else
        {
            show_404();
        }
    }

    public function edittag()
    {
        if (!isset($_GET['id']))
        {
            redirect('dashboard/tag');
        }
        $this->load->model('mtag');
        $result = $this->mtag->getFromID($_GET['id']);
        if (count($result) <= 0)
        {
            redirect('dashboard/createtag');
            return;
        }
        $result = $result[0];

        if (isset($_SESSION['user']['profile']))
        {
            $this->load->view('dashboard/edittag_admin', array('year' => Carbon::now()->year, 'data' => $result));
        }
        else
        {
            show_404();
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

                echo json_encode(array('code' => 200, 'message' => 'Get Data Success', 'data' => array('result' => $result, 'edit' => site_url('dashboard/edit?id=' . $_GET['id']), 'delete' => site_url('dashboard/do_delete?id=' . $_GET['id']))));
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
                    if (count($id) > 0)
                    {
                        $_POST['tag'] = isset($_POST['tag']) ? $_POST['tag'] : array();
                        if (isset($_POST['tag']) &&
                            isset($_POST['description']) &&
                            isset($_POST['status'])
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

                            $this->mdata->edit($_GET['id'], $_POST['description'], $_POST['status']);
                            $this->mdatatag->clear($_GET['id']);
                            if (count($_POST['tag']) > 0)
                            {
                                $this->mdatatag->add($_GET['id'], $_POST['tag']);
                            }
                            $this->mversion->insert();
                            $year = $this->mdata->getDataYear($_GET['id']);

                            echo json_encode(array('code' => 200, 'message' => 'Edit Data Success', 'redirect' => site_url('dashboard/year?year=' . $year[0]['year']), 'data' => array('notify' => array(
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
                    isset($_POST['status'])
                )
                {
                    $this->load->model('mdata');
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

                    $this->mdata->create($_POST['no'], $_POST['year'], $_POST['description'], $_POST['status']);
                    $status = $this->mdata->getFromNoAndYear($_POST['no'], $_POST['year']);
                    if (count($_POST['tag']) > 0)
                    {
                        $this->mdatatag->add($status[0]['id'], $_POST['tag']);
                    }
                    $this->mversion->insert();

                    echo json_encode(array('code' => 200, 'message' => 'Create Data Success', 'redirect' => site_url('dashboard/year?year=' . $_POST['year']), 'data' => array('notify' => array(
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

    public function do_createtag()
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
                    echo json_encode(array('code' => 200, 'message' => 'Create Tag Success', 'data' => array('notify' => array(
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

    public function do_edittag()
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
                        echo json_encode(array('code' => 200, 'message' => 'Edit Tag Success', 'redirect' => site_url('dashboard/tag'), 'data' => array('notify' => array(
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

    public function do_deletetag()
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
                    echo json_encode(array('code' => 200, 'message' => 'Delete Data Success', 'redirect' => site_url('dashboard/tag'), 'data' => array('notify' => array(
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
