<?php

namespace tests\functional\AppBundle\Page;


use Symfony\Component\DomCrawler\Crawler;

class TasksListPage
{
    private $crawler;

    public function __construct(Crawler $crawler)
    {
        $this->crawler = $crawler;
    }

    /**
     * @return Crawler
     */
    public function addNewLink()
    {
        return $this->crawler->selectLink('Add new');
    }

    public function tasksTable()
    {
        return $this->crawler->filter('table');
    }

    public function tasksRows()
    {
        return $this->crawler->filter('table > tbody > tr');
    }
}