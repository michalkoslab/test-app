<?php
namespace TestApp\Components;

/**
 * Class JsonReader
 *
 * @package TestApp\Components
 * @author Michał Zydroń <michal.zydron@gmail.com>
 */
class JsonReader implements ReaderInterface
{
    /**
     * @var string JSON resource url.
     */
    private $resource;

    /**
     * @var array Data from JSON resource.
     */
    private $data;

    /**
     * Sets resource url.
     *
     * @param $resource string JSON resource url.
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
            $json = file_get_contents($this->resource);

            $status = $http_response_header[0];
            $status = explode(' ', $status);

            if ($status[1] != '200') {
                throw new \Exception('Resource doesn\'t exist.');
            }

            $this->data = (array)json_decode($json, true);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Returns data.
     *
     * @return array Data from JSON resource.
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
            return strtotime($this->convertNorwayDateToEnglish($b['date'].' '.$b['time'])) > strtotime($this->convertNorwayDateToEnglish($a['date'].' '.$a['time']));
        });
    }

    /**
     * Converts months names from Norway to English.
     *
     * @param $date string Date with Norway month name.
     * @return string Date with English month name.
     */
    private function convertNorwayDateToEnglish($date)
    {
        $norwayMonths = [
            '/Januar/',
            '/Februar/',
            '/Mars/',
            '/April/',
            '/Mai/',
            '/Juni/',
            '/Juli/',
            '/August/',
            '/September/',
            '/Oktober/',
            '/November/',
            '/Desember/'
        ];

        $englishMonths = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];

        return preg_replace($norwayMonths, $englishMonths, $date);
    }
}
