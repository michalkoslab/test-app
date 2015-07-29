<?php
namespace TestApp\Components;

/**
 * Class VarnishLogReader
 * @package TestApp\Components
 * @author Michał Zydroń <michal.zydron@gmail.com>
 */
class VarnishLogReader implements ReaderInterface
{
    /**
     * @var string Varnish log file url.
     */
    private $resource;

    /**
     * @var array Data from Varnish log file.
     */
    private $data;

    /**
     * Sets resource url.
     *
     * @param $resource string Varnish log file url.
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
            if (!file_exists($this->resource)) {
                throw new \Exception('Resource doesn\'t exist.');
            }

            $file = file($this->resource);

            $this->data = $file;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Returns data.
     *
     * @return array Data from Varnish log file.
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Returns the most traffic hostnames.
     *
     * @param $number Number of hostnames.
     * @return array The most traffic hostnames.
     */
    public function getTheMostTrafficHostnames($number)
    {
        $urls = $this->getRequestedUrls();

        foreach ($urls as $url) {
            $hostnames[] = parse_url($url, PHP_URL_HOST);
        }

        $trafficCount = array_count_values($hostnames);
        arsort($trafficCount);

        return array_keys(array_slice($trafficCount, 0, $number));
    }

    /**
     * Returns the most requested files.
     *
     * @param $number Number of files.
     * @return array The most requested files.
     */
    public function getTheMostRequestedFiles($number)
    {
        $urls = $this->getRequestedUrls();

        $requestsCount = array_count_values($urls);
        arsort($requestsCount);

        return array_keys(array_slice($requestsCount, 0, $number));
    }

    /**
     * Retrieves all requested urls from data.
     *
     * @return array All requested urls.
     */
    private function getRequestedUrls()
    {
        foreach ($this->data as $line) {
            preg_match('/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/', $line, $matches);
            $urls[] = $matches[0];
        }

        return $urls;
    }
}
