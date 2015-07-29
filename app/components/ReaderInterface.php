<?php
namespace TestApp\Components;

/**
 * Interface ReaderInterface
 *
 * @package TestApp\Components
 * @author Michał Zydroń <michal.zydron@gmail.com>
 */
interface ReaderInterface
{
    /**
     * Gets data from resource.
     */
    public function fetchData();

    /**
     * Returns data from resource.
     */
    public function getData();
}
