<?php


namespace App\Http\Controllers;

use App\About;

class AboutController extends Controller
{
    public function index()
    {
        $aboutCompany = About::firstOrFail();
        $news = (new NewsController())->getLastNews();

        return view('about.list', [
            'aboutCompany' => $aboutCompany,
            'news'         => $news
        ]);
    }
}