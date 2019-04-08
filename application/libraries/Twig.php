<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Twig
{
    private $_twig = null;
    private $_CI = null;

    public function __construct()
    {
        $this->_CI = &get_instance();
    }

    public function init($paths = '', $config = [])
    {

        $dir = array(VIEWPATH . 'templates', VIEWPATH);

        if (gettype($paths) === 'string') {
            if (!empty($paths)) {
                array_push($dir, VIEWPATH . $paths);
            }
        } else if (gettype($paths) === 'array') {
            foreach ($paths as $path) {
                if (gettype($path) === 'string') {
                    if (!empty($path)) {
                        array_push($dir, VIEWPATH . $path);
                    }

                } else {
                    show_error('Twig Exception: the first parameter of twig->init() should be a string or an array of string.');
                }

            }
        } else {
            show_error('Twig Exception: the first parameter of twig->init() should be a string or an array of string.');
        }

        $env_opt = $this->_CI->config->item('twig');
        if (gettype($config) !== 'array') {
            show_error('Twig Exception: the second parameter of twig->init() should be an array of twig env options.');
        } else {
            foreach ($config as $key => $value) {
                if (isset($env_opt[$key])) {
                    $env_opt[$key] = $value;
                }
            }
        }

        $loader = new \Twig\Loader\FilesystemLoader($dir);
        $this->_twig = new \Twig\Environment($loader, $env_opt);
    }

    public function render($target, $data = [])
    {
        if ($this->_twig === null) {
            show_error('Twig Exception: using $this->twig before initialized.');
        } else {
            return $this->_twig->render($target, $data);
        }
    }
}
