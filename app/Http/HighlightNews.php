<?php


namespace App\Http;


class HighlightNews
{
    public $title;
    public $news;

    public function __construct($title, $news)
    {
        $this->title = $title;
        $this->news = $news;
    }
}