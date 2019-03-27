<?php
defined('BASEPATH')OR exit('No direct script access allowed');

class BaseControllerClass extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper('custom');
        $this->config = array_merge(array(
            'authentication' => true,
            'ffmpeg_path' => str_replace('\\', '/', getcwd()).('/ffmpeg/bin/ffmpeg'),
            'ffprobe_path' => str_replace('\\', '/', getcwd()).('/ffmpeg/bin/ffprobe'),
            'base_url' => '/',
            'root_path' => '',
            'input_dir' => str_replace('\\', '/', getcwd()).('/ffmpeg/input/'),
            'output_dir' => str_replace('\\', '/', getcwd()).('/ffmpeg/output/'),
            // 'input_dir' => str_replace('\\', '/', getcwd()).('/ffmpeg/input/Emitra.mp4'),
            // 'output_dir' => str_replace('\\', '/', getcwd()).('/ffmpeg/output/vout.mp4'),
            'tmp_dir' => 'userfiles/tmp/',
            'log_filename' => 'log.txt',
            'database_dir' => 'database/',
            'ffmpeg_string_arr' => array(),
            'users_restrictions' => array(),
            'watermark_text' => '',
            'watermark_text_font_name' => 'libel-suit-rg.tt',
            'queue_size' => 10,
            'debug' => false,
            'video_path_d' => str_replace('\\', '/', getcwd()).('/ffmpeg/input/Emitra.mp4')
        ));
    }
    

    public function createVideo() {
        echo "Hello Video";
        $this->load->view('web/video.php');
    }

    public function resizeVideo()
    {
        $content = shell_exec('ffmpeg -i '.$this->config['input_dir'].' -ss 00:01:00 -t 00:01:00 -async 1 -strict -2 '.$this->config['output_dir']);
        if($content) {
            echo "Video cut successfully";
        }
        else {
            echo "error";
        }
    }


    public function getVideoProperties()
    {
        $output = array();
        $content = shell_exec( $this->config['ffprobe_path'] . ' -i "' . $this->config['video_path_d'] . '" 2>&1' );
        
        $regex_size = "/Video: (?:.*), ([0-9]{1,4})x([0-9]{1,4})/";
        if ( preg_match($regex_size, $content, $matches) ) {
            $output['width'] = $matches[1] ? intval( $matches[1] ) : null;
            $output['height'] = $matches[2] ? intval( $matches[2] ) : null;
        }
        
        $regex_duration = "/Duration: ([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}).([0-9]{1,2})/";
        if ( preg_match($regex_duration, $content, $matches) ) {
            $hours = $matches[1] ? intval( $matches[1] ) : 0;
            $mins = $matches[2] ? intval( $matches[2] ) : 0;
            $secs = $matches[3] ? intval( $matches[3] ) : 0;
            $ms = $matches[4] ? intval( $matches[4] ) : 0;
            $output['duration_ms'] = ($hours * 60 * 60) * 1000;
            $output['duration_ms'] += ($mins * 60) * 1000;
            $output['duration_ms'] += $secs * 1000;
            $output['duration_ms'] += $ms;
        }
        
        return $output;

    }

    public function getExtension( $filePath )
    {
        if( strpos( $filePath, '.' ) === false ){
            return '';
        }
        $temp_arr = $filePath ? explode( '.', $filePath ) : array();
        $ext = !empty( $temp_arr ) ? end( $temp_arr ) : '';
        return strtolower( $ext );
    }


    static function sizeFormat($bytes, $unit = "", $decimals = 2)
    {
        $units = array('B' => 0, 'KB' => 1, 'MB' => 2, 'GB' => 3, 'TB' => 4, 'PB' => 5, 'EB' => 6, 'ZB' => 7, 'YB' => 8);
        $value = 0;
        if ($bytes > 0) {
            if (!array_key_exists($unit, $units)) {
                $pow = floor(log($bytes)/log(1024));
                $unit = array_search($pow, $units);
            }
            $value = ($bytes/pow(1024,floor($units[$unit])));
        }
        if (!is_numeric($decimals) || $decimals < 0) {
            $decimals = 2;
        }
        return sprintf('%.' . $decimals . 'f '.$unit, $value);
    }

    public function downloadFile( $filePath, $fileName = '' )
    {

        $pathInfo = pathinfo( $filePath );
        $fileSize = filesize( $filePath );
        if( !$fileName ){
            $fileName = $pathInfo['basename'];
        }

        if (isset($_SERVER['HTTP_USER_AGENT']) and strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
            header('Content-Type: application/force-download');
        else
            header('Content-Type: application/octet-stream');

        header('Accept-Ranges: bytes');
        header('Content-Length: ' . $fileSize);
        header('Content-disposition: attachment; filename="' . $fileName . '"');

        ob_clean();
        flush();
        readfile($filePath);

        exit;
    }
 
}