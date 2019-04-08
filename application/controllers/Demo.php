<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Demo extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Demo';

        $this->twig->init('demo');
        echo $this->twig->render('demo.html', $data);
    }
}
