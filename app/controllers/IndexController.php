<?php
namespace TestApp\Controllers;

use Phalcon\Mvc\Controller;

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
        $articles = [
            [
                'title' => 'article-1',
                'date' => 'date-1'
            ],
            [
                'title' => 'article-2',
                'date' => 'date-2'
            ],
            [
                'title' => 'article-3',
                'date' => 'date-3'
            ]
        ];

        $this->view->articles = $articles;
    }

    public function jsonFeedAction()
    {
        $articles = [
            [
                'title' => 'article-1',
                'link' => 'link-1',
                'description' => 'description-1',
                'date' => 'date-1',
                'time' => 'time-1',
                'category' => 'category-1'
            ],
            [
                'title' => 'article-2',
                'link' => 'link-2',
                'description' => 'description-2',
                'date' => 'date-2',
                'time' => 'time-2',
            ],
            [
                'title' => 'article-3',
                'link' => 'link-3',
                'date' => 'date-3',
                'time' => 'time-3',
            ]
        ];

        $this->view->articles = $articles;
    }
}
