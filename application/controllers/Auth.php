<?php
/**
 * This <freelancer.fajar.io> project created by :
 * Name         : syafiq
 * Date / Time  : 10 December 2016, 2:30 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');
use Carbon\Carbon;

class Auth extends CI_Controller
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
        if (isset($_SESSION['user']['profile']))
        {
            redirect('dashboard');
        }
        else
        {
            redirect('/auth/login');
        }
    }

    public function login()
    {
        if (isset($_SESSION['user']['profile']))
        {
            redirect('dashboard');
        }
        else
        {
            $this->load->view('auth/login', array('year' => Carbon::now()->year));
        }
    }

    public function do_login()
    {
        if ($this->input->is_ajax_request() && ($_SERVER['REQUEST_METHOD'] === 'POST'))
        {
            if (isset($_POST['user']['email']) && isset($_POST['user']['password']))
            {
                $_POST['email'] = strtolower($_POST['user']['email']);
                $this->load->model('mauth');
                $result = $this->mauth->login($_POST['user']['email'], $_POST['user']['password']);
                if (count($result) > 0)
                {
                    $_SESSION['user']['profile'] = $result[0];
                    /*$this->load->model('mversioning');
                    $result = $this->mversioning->createAndLoadVersion($_SESSION['user']['profile']['id'], Carbon::now('UTC')->toDateTimeString());
                    if (count($result) > 0)
                    {
                        $_SESSION['user']['version'] = $result[0];*/
                        echo json_encode(array('code' => 200, 'message' => 'Accepted', 'redirect' => base_url('dashboard'), 'data' => array('notify' => array(
                            array('Authentication complete', 'success')
                        ))));
                    /* }
                     else
                     {
                         echo json_encode(array('code' => 403, 'message' => 'Failed to Login', 'data' => array('notify' => array(
                             array('Failed to Login', 'info')
                         ))));
                     }*/
                }
                else
                {
                    echo json_encode(array('code' => 403, 'message' => 'User Not Registered', 'data' => array('notify' => array(
                        array('User Not Registered', 'info')
                    ))));
                }
            }
            else
            {
                echo json_encode(array('code' => 402, 'message' => 'Insufficient Data', 'data' => array('notify' => array(
                    array('Insufficient Data', 'info')
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

    public function do_signout()
    {
        session_destroy();
        echo json_encode(array('code' => 200, 'message' => 'Accepted', 'data' => array('notify' => array(
            array('Sign out successfully', 'success')
        ))));
    }
}