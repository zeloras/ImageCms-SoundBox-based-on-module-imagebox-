<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//error_reporting(0);

/**
 * Image CMS
 *
 * Imagebox module.
 */

class Admin extends MY_Controller {

    public $settings = array(
            'upload_folder' => './uploads/soundbox/',
            'allowed_types'       => 'mp3|wav|aiff|flac|ape|ogg',
            'maintain_ratio' => TRUE,
        );

	function __construct()
	{
		parent::__construct();

        $this->load->library('DX_Auth');
        cp_check_perm('module_admin'); 

        $settings = $this->get_settings();

        if (is_array($settings))
        {
            foreach($settings as $k => $v)
            {
                $this->settings[$k] = $v;
            }
        }
	}

    /**
     * Display install settings
     */
    public function index()
    {
        $this->display_tpl('install');
    }

	public function main()
    {
        $this->template->add_array(array(
                'settings' => $this->settings
            ));

	    $this->display_tpl('main_window');
	}

    public function upload()
    {
        if ($_POST['file_url'] != '')
        {
            $url = $this->input->post('file_url');            

            $p = @fopen($url, 'rb');
            
            if (!$p)
            {
                echo 'Error: Ошибка загрузки файла.';
                return;
            }

            $image_data = stream_get_contents($p);
            fclose($p);

            $this->load->helper('file');

            $name = md5( time() ).'.'.'mp3';
            write_file($this->settings['upload_folder'].$name, $image_data);
        }
        else
        {   
            $config['upload_path']   = $this->settings['upload_folder'];
            //$config['max_size']      = 1024 * 1024 * $this->max_file_size;
            
            $this->load->library('upload', $config);
            if ($_FILES['userfile']['name'] != '')
            {
                move_uploaded_file($_FILES['userfile']['tmp_name'], $config['upload_path'].$_FILES['userfile']['name']);
                $file['file_name'] = $_FILES['userfile']['name'];
            }
            else
            {
           
                echo 'Error: Не выбран файл';
                return;
            }
           
        }

        $link_url = $this->settings['upload_folder'].$file['file_name'];

        
        echo '<object type="application/x-shockwave-flash" data="/application/modules/soundbox/player/ump3player_500x70.swf" height="70" width="470"><param name="wmode" value="transparent" /><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="movie" value="/application/modules/soundbox/player/ump3player_500x70.swf" /><param name="FlashVars" value="way=http://'.$_SERVER['HTTP_HOST'].$link_url.'&amp;swf=/application/modules/soundbox/player/ump3player_500x70.swf&amp;w=470&amp;h=70&amp;time_seconds=0&amp;autoplay=0&amp;q=&amp;skin=white&amp;volume=70&amp;comment=audio" /></object>';
       // echo '<audio src="http://'.$_SERVER['HTTP_HOST'].$link_url.'" controls autobuffer> </audio>';
        //echo '<a href="'.$link_url.'">'.$link_url.'jjjjjj</a>'; 
    }

    public function get_settings()
    {
        $this->db->where('name', 'soundbox');
        $query = $this->db->get('components')->row_array();

        return unserialize($query['settings']);
    }
    /**
     * Display template file
     */ 
	private function display_tpl($file = '')
	{
        $file =  realpath(dirname(__FILE__)).'/templates/'.$file.'.tpl';  
		$this->template->display('file:'.$file);
	}

}

/* End of file admin.php */
