<?php

use Hazzard\Filepicker\Handler;
use Hazzard\Filepicker\Uploader;
use Intervention\Image\ImageManager;
use Hazzard\Config\Repository as Config;

class Filepicker extends CI_Controller
{
    /**
     * Handle an incoming HTTP request.
     */
    public function index()
    {
        $handler = new Handler(
            new Uploader($config = new Config, new ImageManager)
        );

        $config['debug'] = true;

        // Path to the files directory (files).
        $config['upload_dir'] =  FCPATH . 'files';

        // Url to the files directory.
        $config['upload_url'] = base_url('/files');

        // Handle the request.
        $handler->handle()->send();
    }
}