<?php
namespace TestApp\Controllers;

use Phalcon\Mvc\Controller;
use TestApp\Components\RssReader;
use TestApp\Components\JsonReader;

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view->disable();
        $this->response->redirect('varnish-log');
    }

    public function varnishLogAction()
    {
        $mostTrafficHostnames = [
            'hostname-1',
            'hostname-2',
            'hostname-3',
            'hostname-4',
            'hostname-5'
        ];

        $mostRequestedFiles = [
            'file-1',
            'file-2',
            'file-3',
            'file-4',
            'file-5'
        ];

        $this->view->hostnames = $mostTrafficHostnames;
        $this->view->files = $mostRequestedFiles;
    }

    public function rssFeedAction()
    {
        $rss = new RssReader('http://www.vg.no/rss/nyfront.php?frontId=1');
        $rss->fetchData();
        $rss->sortDataByDate();

        $this->view->articles = $rss->getData();
    }

    public function jsonFeedAction()
    {
        $json = new JsonReader('http://rexxars.com/playground/testfeed/');
        $json->fetchData();
        $json->sortDataByDate();

        $this->view->articles = $json->getData();
    }
}
