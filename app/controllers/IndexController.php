<?php
namespace TestApp\Controllers;

use Phalcon\Mvc\Controller;
use TestApp\Components\VarnishLogReader;
use TestApp\Components\RssReader;
use TestApp\Components\JsonReader;

/**
 * Class IndexController
 *
 * Main application controller.
 *
 * @package TestApp\Controllers
 * @author Michał Zydroń <michal.zydron@gmail.com>
 */
class IndexController extends Controller
{
    /**
     *  Redirects to "varnish-log" route.
     */
    public function indexAction()
    {
        $this->view->disable();
        $this->response->redirect('varnish-log');
    }

    /**
     * Generates view with data from Varnish log file.
     *
     * @throws \Exception If the resource doesn't exist.
     */
    public function varnishLogAction()
    {
        $varnishLog = new VarnishLogReader('../app/resources/varnish.log');
        $varnishLog->fetchData();

        $this->view->hostnames = $varnishLog->getTheMostTrafficHostnames(5);
        $this->view->files = $varnishLog->getTheMostRequestedFiles(5);
    }

    /**
     * Generates view with data from RSS-feed.
     *
     * @throws \Exception If the resource doesn't exist.
     */
    public function rssFeedAction()
    {
        $rss = new RssReader('http://www.vg.no/rss/nyfront.php?frontId=1');
        $rss->fetchData();
        $rss->sortDataByDate();

        $this->view->articles = $rss->getData();
    }

    /**
     * Generates view with data from JSON-feed.
     *
     * @throws \Exception If the resource doesn't exist.
     */
    public function jsonFeedAction()
    {
        $json = new JsonReader('http://rexxars.com/playground/testfeed/');
        $json->fetchData();
        $json->sortDataByDate();

        $this->view->articles = $json->getData();
    }
}
