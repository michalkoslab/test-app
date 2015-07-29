<?php
namespace TestApp\Controllers;

use Phalcon\Mvc\Controller;
use TestApp\Components\VarnishLogReader;
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
        $varnishLog = new VarnishLogReader('../app/resources/varnish.log');
        $varnishLog->fetchData();

        $this->view->hostnames = $varnishLog->getTheMostTrafficHostnames(5);
        $this->view->files = $varnishLog->getTheMostRequestedFiles(5);
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
