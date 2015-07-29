<?php
namespace TestApp\Components;

/**
 * Class RssReader
 * @package TestApp\Components
 * @author Michał Zydroń <michal.zydron@gmail.com>
 */
class RssReader implements ReaderInterface
{
    /**
     * @var string RSS resource url.
     */
    private $resource;

    /**
     * @var array Data from RSS resource.
     */
    private $data;

    /**
     * Sets resource url.
     *
     * @param $resource string RSS resource url.
     */
    public function __construct($resource)
    {
        $this->resource = $resource;
    }

    /**
     * Gets data from resource.
     *
     * @throws \Exception If the resource doesn't exist.
     */
    public function fetchData()
    {
        try {
            $rss = @simplexml_load_file($this->resource);

            if($rss === false) {
                throw new \Exception('Resource doesn\'t exist.');
            }

            foreach ($rss->channel->item as $item) {
                $data[] = [
                    'title' => (string)$item->title,
                    'date' => (string)$item->pubDate
                ];
            }

            $this->data = $data;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Returns data.
     *
     * @return array Data from RSS resource.
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Sorts data by date from newest to oldest.
     *
     * @return void
     */
    public function sortDataByDate()
    {
        usort($this->data, function($a, $b) {
            return strtotime($b['date']) - strtotime($a['date']);
        });
    }
}
