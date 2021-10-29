<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->library('form_validation');

        //load date helper
        $this->load->helper('date');
    }

    public function index()
    {


        if ($this->session->userdata('isLoggedIn')) {
            $clientid     = $this->session->userdata('clientdb');
            $usertype     = $this->session->userdata('usertype');

            $clientname   = $this->session->userdata('ClientName');
            $hostname     = $this->session->userdata('hostname');
            $databasename = $this->session->userdata('dbname');
            $dbusername   = $this->session->userdata('dbusername');
            $dbpassword   = $this->session->userdata('dbpassword');


            // echo 'host ' . $hostname ;
            // echo "<br>" ;
            // echo 'dbname ' . $databasename ;
            // echo "<br>" ;
            // echo 'db user name ' . $dbusername ;
            // echo "<br>" ;
            // echo 'db user password ' . $dbpassword ;
            // echo "<br>" ;
            // die ; 
            $this->load->database();

            if ($usertype == 'admin') {

                $this->load_Menu();
                // $this->load_dashboard();
            } else {
                $this->load_Menu();
                // $this->load_building();
            }
        } else {
            // echo "hello ";
            // die ;
            //
            //get the posted values
            $username = $this->input->post("txt_username");
            $password = $this->input->post("txt_password");
            // $clientid = $this->input->post("txt_clientid");

            $captcha_form = $this->config->item('captcha_form');

            $data['captcha_form'] = $captcha_form;
            if ($captcha_form) {
                $data['captcha_html'] = $this->session->flashdata('captcha_image') != NULL ? $this->session->flashdata('captcha_image') : $this->_create_captcha();
            }
            //set validations
            $this->form_validation->set_rules("txt_username", "Username", "trim|required");
            $this->form_validation->set_rules("txt_password", "Password", "trim|required");
            // $this->form_validation->set_rules("txt_clientid", "clientid", "trim|required");
            if ($captcha_form) {
                $this->form_validation->set_rules('not_robot', 'Captcha', 'required|callback__check_captcha');
            }

            if ($this->form_validation->run() == FALSE) {
                //validation fails
                $this->load->view('login_view', $data);
            } else {
                //validation succeeds
                if ($this->input->post('btn_login') == "Login") {

                    date_default_timezone_set("Asia/Kolkata");

                    // apmc_admin database
                    $sessiondata['clientid'] = '1';
                    $sessiondata['clientname'] = 'StartUP';
                    //   $sessiondata['hostname'] = '127.0.0.1' ;
                    $sessiondata['hostname'] = '206.189.137.92';
                    $sessiondata['databasename'] = 'apmc_admin';
                    $sessiondata['dbusername'] = 'apmc_sa';
                    $sessiondata['dbpassword'] = 'aPmC%210420';

                    // // apmc_admin database
                    // $sessiondata['clientid'] = '1';
                    // $sessiondata['clientname'] = 'StartUP';
                    // $sessiondata['hostname'] = '127.0.0.1';
                    // // $sessiondata['hostname'] = '206.189.137.92';
                    // $sessiondata['databasename'] = 'admin';
                    // $sessiondata['dbusername'] = 'root';
                    // $sessiondata['dbpassword'] = '';



                    $this->session->set_userdata($sessiondata);

                    // print_r($sessiondata);
                    // echo "<br>";
                    // die ;
                    // echo "loading database ";
                    //
                    $this->load->database();

                    // echo "<br>";
                    // echo "loaded ";

                    $this->load->model('login_model');
                    // echo "loading login_model ";
                    // echo "<br>";

                    //check if username and password is correct
                    $usr_result = $this->login_model->get_user($username, $password);
                    // echo "get_user";
                    // echo "<br>";
                    // print_r ($usr_result);
                    // die ;

                    if ($usr_result > 0) //active user record is present
                    {

                        $usr = $this->db->escape_str($username);
                        $pwd = $this->db->escape_str($password);

                        // look for new database parameters
                        $query = $this->db->query("
                                SELECT  apmc_users.id,
                                        apmc_users.clientid,
                                        apmc_users.clientuserid,
                                        apmc_users.username,
                                        apmc_users.UserMobile, 
                                        apmc_users.user_last_login,
                                        apmc_users.last_login_ip,
                                        apmc_users.usertype,
                                        apmc_users.allow,
                                        apmc_users.active,
                                        apmc_users.Sales,
                                        apmc_users.Marketing,
                                        apmc_users.PlanningEst,
                                        apmc_users.MaterialMgt,
                                        apmc_users.Maintenance,

                                        apmc_clients.clientcd,
                                        apmc_clients.ClientName,
                                        apmc_clients.hostname,
                                        apmc_clients.databasename dbname,
                                        apmc_clients.username dbusername,
                                        apmc_clients.userpassword dbpassword,
                                        apmc_clients.docfolder,
                                        apmc_clients.logoimage,
                                        apmc_clients.EmailAddress,
                                        apmc_clients.EmailPassword,
                                        apmc_clients.RecepientEmailAddress,
                                        apmc_clients.impMessage,
                                        apmc_clients.rcptfname,
                                        apmc_clients.expiry_date,
                                        apmc_clients.ContactPerson,
                                        apmc_clients.Mobile,
                                        apmc_clients.email,
                                        apmc_clients.senderid,
                                        apmc_clients.sms_login,
                                        apmc_clients.sms_hashkey,
                                        apmc_clients.senderid,
                                        apmc_clients.senderid_due,
                                        apmc_clients.call_apikey

                                 FROM apmc_users, apmc_clients
                                WHERE apmc_users.ClientId = apmc_clients.id
                                  and apmc_users.username= '$usr'
                                  and apmc_users.password= '$pwd'
                                                ");

                        $user_last_login = $query->row()->user_last_login;
                        $clientcd        = $query->row()->clientcd;
                        $clientid        = $query->row()->clientid;
                        $clientuserid    = $query->row()->clientuserid;
                        $clientname      = $query->row()->ClientName;
                        $groupname       = $query->row()->ClientName;
                        $hostname        = $query->row()->hostname;
                        $databasename    = $query->row()->dbname;
                        $dbusername      = $query->row()->dbusername;
                        $dbpassword      = $query->row()->dbpassword;
                        $docfolder       = $query->row()->docfolder;
                        $logoimage       = $query->row()->logoimage;
                        $EmailAddress    = $query->row()->EmailAddress;

                        $userid          = $query->row()->id;
                        $usermobile      = $query->row()->UserMobile;
                        $user_last_login = $query->row()->user_last_login;
                        $last_login_ip   = $query->row()->last_login_ip;

                        $usertype        = $query->row()->usertype;
                        $impMessage      = $query->row()->impMessage;
                        $rcptfname       = $query->row()->rcptfname;

                        $allow           = $query->row()->allow;
                        $active          = $query->row()->active;

                        $expiry_date     = $query->row()->expiry_date;
                        $ContactPerson   = $query->row()->ContactPerson;
                        $Mobile          = $query->row()->Mobile;
                        $email           = $query->row()->email;

                        $senderid        = $query->row()->senderid;
                        $sms_login       = $query->row()->sms_login;
                        $sms_hashkey     = $query->row()->sms_hashkey;
                        $senderid_due    = $query->row()->senderid_due;

                        $call_apikey     = $query->row()->call_apikey;

                        if ($active == 'Y') {
                            echo "<script> ";
                            echo "alert('Another user with the same username $username is already logged in APMC Traders. ');";
                            echo "</script>";
                        }

                        $today = $dtText = date("Y-m-d");

                        if ($allow == 'N') {
                            echo "<script>";
                            echo " alert('Sorry, Your account has been disabled by Admin  !!');
                                window.location.href='https://apmctraders.com/#contact';
                        </script>";
                        }

                        // validate expiry_date with current date
                        elseif ($today > $expiry_date) {
                            echo "<script>";
                            echo " alert('Sorry, You are requested to renew your Subscription ...');
                                window.location.href='https://apmctraders.com/#contact';
                        </script>";
                        } else {
                            // $con_client = mysqli_connect($hostname,$dbusername,$dbpassword,$databasename) ;
                            $sessiondata = array(
                                'userid'            => $clientuserid, //$userid,
                                'useridlogout'      => $userid,
                                'username'          => $username,
                                'usermobile'        => $usermobile,
                                'isLoggedIn'        => true,
                                'clientid'          => $clientid,
                                'clientuserid'      => $clientuserid,
                                'clientname'        => $clientname,
                                'GroupName'         => $groupname,
                                'clientcd'          => $clientcd,
                                'LoginDateTime'     => $this->getDateTime(),
                                'user_last_login'   => $user_last_login,
                                'lastlogindt'       => $user_last_login,
                                'ipaddress'         => $last_login_ip,
                                'usertype'          => $usertype,
                                'loginuser'         => TRUE,
                                'hostname'          => $hostname,
                                'databasename'      => $databasename,
                                'dbusername'        => $dbusername,
                                'dbpassword'        => $dbpassword,
                                'docfolder'         => $docfolder,
                                'logoimage'         => $logoimage,
                                'clientName'        => $clientname,
                                'clientlogo'        => $logoimage,
                                'EmailAddress'      => $EmailAddress,
                                'rcptfname'         => $rcptfname,
                                'impMessage'        => $impMessage,
                                // 'con_client'        => $con_client,
                                //   'Sales'             => $Sales,
                                //   'Marketing'         => $Marketing,
                                //   'PlanningEst'       => $PlanningEst,
                                //   'MaterialMgt'       => $MaterialMgt,
                                //   'Maintenance'       => $Maintenance,

                                'expiry_date'       => $expiry_date,
                                'ContactPerson'     => $ContactPerson,
                                'Mobile'            => $Mobile,
                                'email'             => $email,
                                'senderid'          => $senderid,
                                'senderid_due'      => $senderid_due,
                                'sms_login'         => $sms_login,
                                'sms_hashkey'       => $sms_hashkey,
                                'call_apikey'       => $call_apikey

                            );

                            $this->session->set_userdata($sessiondata);

                            // echo 'host ' . $hostname ;
                            // echo "<br>" ;
                            // echo 'dbname ' . $databasename ;
                            // echo "<br>" ;
                            // echo 'client id  ' . $clientid ;
                            // echo "<br>" ;
                            // echo 'db user password ' . $dbpassword ;
                            // echo "<br>" ;
                            // die ; 


                            // print_r ($sessiondata);
                            // die ; 

                            // SELECT CURRENT_DATE, CURRENT_TIMESTAMP, now(),
                            //        CONVERT_TZ(CURRENT_TIMESTAMP,'+00:00','+12:30'),
                            //        CONVERT_TZ(now(),'+00:00','+12:30')
                            //  FROM dual

                            $format = "%Y-%m-%d %H:%i"; // 24 hr format
                            $mdate = mdate($format);

                            $ipaddress =  $this->input->ip_address();
                            $query = " UPDATE apmc_users
                                        SET user_last_login = '$mdate',
                                            last_login_ip = '$ipaddress',
                                            active = 'Y'
                                      WHERE UserName ='$username' ";
                            $result = $this->db->query($query);

                            $this->db->close();

                            $this->load->database();

                            $query = " INSERT INTO APMCUsersLog (userid, logDatetime, InOutFlag, login_ip)
                                            VALUES ($userid, '$mdate',      'I',       '$ipaddress')
                                     ";

                            $result = $this->db->query($query);

                            $this->session->set_userdata('timestamp', time());

                            if ($usertype == 'admin') {
                                // $this->load_dashboard();
                                $this->load_Menu();
                            } else {
                                // $this->load_building();
                                $this->load_Menu();
                            }
                        }
                    } else {
                        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username and password!</div>');
                        $this->load->view('login_view', $data);
                    }
                } else {
                    redirect(base_url());
                }
            }
        }
    }

    public function contact()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $message = $this->input->post('message');

        $ci = get_instance();
        $ci->load->library('email');

        $ci->email->from('hisapp@his-erp.com');
        $ci->email->to('infowaysoftware@gmail.com');
        $ci->email->subject('Enquiry For APMC Traders From Contact Form');

        $message = '
            Dear Sir,


            Name:' . $name . '
            Email:' . $email . '
            Phone:' . $phone . '
            Message:' . $message;
        $ci->email->message($message);
        if ($ci->email->send()) {
            echo "<script> ";
            echo "alert('Email Sent Successfully, we will get back to you soon  !!');";
            echo "</script>";
            redirect(base_url());
        } else {
            $result = "not Working";
        }
    }

    public function sendEmaillivedemo()
    {
        $f_name     = $this->input->post('f_name');
        $company    = $this->input->post('company');
        $phone_no   = $this->input->post('phone_no');
        $user_email = $this->input->post('user_email');
        $contact    = $this->input->post('contact');
        $comment    = $this->input->post('comment');

        $contact1   = implode(',', $contact);


        $date = $this->input->post('date');
        $time = $this->input->post('time');

        $date1 = $this->input->post('date1');
        $time1 = $this->input->post('time1');

        $date2 = $this->input->post('date2');
        $time2 = $this->input->post('time2');

        $comment = $this->input->post('comment');

        $startDate = new DateTime($date);
        $result = $startDate->format('d/m/Y');

        $startDate1 = new DateTime($date1);
        $result1 = $startDate1->format('d/m/Y');

        $startDate2 = new DateTime($date2);
        $result2 = $startDate2->format('d/m/Y');

        $ci = get_instance();
        $ci->load->library('email');

        $ci->email->from('hisapp@his-erp.com');
        $list = array('hisapp@his-erp.com');
        $ci->email->to('infowaysoftware@gmail.com');
        $ci->email->subject('APMC Traders - Request for Live Demo');

        // $message = 'Dear Sir,
        //             Name        : '.$f_name    .'
        //             Company     : '.$company   .'
        //             Mobile No   : '.$phone_no  .'
        //             Email       : '.$user_email.'
        //             Contact Via : '.$contact1  . '
        //             Comment     : '.$comment ;


        $message = 'Dear Sir,

 Request for Live Demo.

 Name        : ' . $f_name . '
 Company     : ' . $company . '

 Mobile No   : ' . $phone_no . '
 Email       : ' . $user_email . '
 Contact Via : ' . $contact1  . '

 Preferred Date & Time of Demo :
 '
            . $result  . ' - ' . $time  . '
 '
            . $result1 . ' - ' . $time1 . '
 '
            . $result2 . ' - ' . $time2 . '

 Comment:' . $comment;

        $ci->email->message($message);
        if ($ci->email->send()) {
            $result = 'Mail Send Sucessfully';
            redirect(base_url());
        } else {
            $result = "Could not Send Email, Try Again Later ... ";
            echo (json_encode($result));
        }
    }

    public function sendEmail()
    {
        $f_name = $this->input->post('f_name');
        $l_name = $this->input->post('l_name');
        $company = $this->input->post('company');
        $phone_no = $this->input->post('phone_no');
        $user_email = $this->input->post('user_email');
        $contact = $this->input->post('contact');

        $comment = $this->input->post('comment');

        $contact1 = implode(',', $contact);
        $ci = get_instance();
        $ci->load->library('email');

        $ci->email->from('hisapp@his-erp.com');
        $list = array('hisapp@his-erp.com');
        $ci->email->to('infowaysoftware@gmail.com');
        $ci->email->subject('Enquiry From APMC Traders');

        $message = 'Dear Sir,
                         Name        : ' . $f_name . $l_name . '
                         Company     : ' . $company . '
                         Mobile No   : ' . $phone_no . '
                         Email       : ' . $user_email . '
                         Contact Via : ' . $contact1 . '
                         Comment     : ' . $comment;
        $ci->email->message($message);
        if ($ci->email->send()) {
            $result = 'Mail Send Sucessfully';
            redirect(base_url());
            // echo (json_encode($result));
        } else {
            $result = "Could not Send Email, Try Again Later ... ";
            echo (json_encode($result));
        }
    }

    public function load_Menu()
    {
        //  $this->load->view('menu_1');
        //  $this->load->view('welcome_message');
        $this->load->model('CompanyMasterModel');
        $data['Item_List'] = $this->CompanyMasterModel->get_comp_data();
        // $this->load->view('menu_1.php');
        $this->load->view('select_company_view', $data);
    }

    public function selcompany()
    {
        redirect('https://apmctraders.com/index.php/login/index');
    }

    public function logout()
    {
        $hostname = $this->session->userdata['hostname'];
        $uname    = $this->session->userdata['dbusername'];
        $mdb      = $this->session->userdata['databasename'];
        $upass    = $this->session->userdata['dbpassword'];
        $this->load->database();

        $username = $this->session->userdata('username');
        $useridlogout = $this->session->userdata('useridlogout');
        $ipaddress = $this->session->userdata('ipaddress');

        $query = " INSERT INTO APMCUsersLog (userid, logDatetime, InOutFlag, login_ip)
                                         VALUES ($useridlogout, CONVERT_TZ(now(),'+00:00','+12:30'), 'O', '$ipaddress')
                              ";



        $result = $this->db->query($query);

        $this->db->close();

        // apmc_admin database
        $sessiondata['clientid'] = '1';
        $sessiondata['clientname'] = 'StartUP';
        // $sessiondata['hostname'] = '127.0.0.1' ;
        $sessiondata['hostname'] = '206.189.137.92';
        $sessiondata['databasename'] = 'apmc_admin';
        $sessiondata['dbusername'] = 'apmc_sa';
        $sessiondata['dbpassword'] = 'aPmC%210420';

        $this->session->set_userdata($sessiondata);

        $this->load->database();

        $query = " UPDATE apmc_users
                        SET active = ''
                      WHERE UserName = '$username'
                     ";
        $result = $this->db->query($query);

        $data = [
            'userid',
            'username',
            'clientid',
            'Cl-_login',
            'loginuser',
            'hostname',
            'databasename',
            'dbusername',
            'dbpassword',
            'docfolder',
            'logoimage'
        ];
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();

        $this->db->close();

        echo "<script> ";
        echo "alert('Thank you " . $username . ", See you soon !!!');";
        echo "</script>";

        redirect(base_url());
    }

    public function registration_from()
    {
        $this->load->view('registeration_view');
    }
    public function show()
    {
        $data['error'] = "null";
        $this->load->view('userregist_view', $data);
    }

    function getDateTime()
    {
        //$format = "%Y-%m-%d %h:%m %a";
        $format = "%d-%m-%Y %h:%m %a";
        //echo @mdate($format);
        return @mdate($format);
    }

    public function download()
    {
        //load the download helper
        $this->load->helper('download');
        //Get the file from whatever the user uploaded (NOTE: Users needs to upload first), @See http://localhost/CI/index.php/upload
        //$data = file_get_contents("./img/globe_navy_1.png");
        //Read the file's contents
        //$name = 'hissales';

        //use this function to force the session/browser to download the file uploaded by the user
        //force_download($name, $data);
        //force_download('./apk/app-debug.apk', NULL);
        $fname = './android/hissales.apk';
        echo $fname;
        if (file_exists($fname)) {
            echo "YES";
        } else
            echo "No"; {
        }

        force_download($fname, NULL);
    }

    /**
     * Create CAPTCHA image to verify user as a human
     *
     * @return    string
     */
    function _create_captcha()
    {
        $this->load->helper('captcha');
        $cap_config = array(
            'img_path' => './' . $this->config->item('captcha_path'),
            'img_url' => base_url() . $this->config->item('captcha_path'),
            'font_path' => './' . $this->config->item('captcha_fonts_path'),
            'font_size' => $this->config->item('captcha_font_size'),
            'img_width' => $this->config->item('captcha_width'),
            'img_height' => $this->config->item('captcha_height'),
            'show_grid' => $this->config->item('captcha_grid'),
            'expiration' => $this->config->item('captcha_expire'),
            'ip_address' => $this->input->ip_address(),
            // White background and border, black text and red grid
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
            )
        );
        $cap = create_captcha($cap_config);
        //        print_r($cap);
        //        exit();
        //        // Save captcha params in session
        $this->session->set_flashdata(array(
            'captcha_word' => $cap['word'],
            'captcha_image' => $cap['image']
        ));
        return $cap['image'];
    }

    /**
     * Callback function. Check if CAPTCHA test is passed.
     *
     * @param    string
     * @return    bool
     */
    function _check_captcha($code)
    {
        $word = $this->session->flashdata('captcha_word');
        if (($this->config->item('captcha_case_sensitive') and $code != $word) or
            strtolower($code) != strtolower($word)
        ) {
            $this->form_validation->set_message('_check_captcha', 'Captcha is incorrect');
            return FALSE;
        }
        return TRUE;
    }
}
