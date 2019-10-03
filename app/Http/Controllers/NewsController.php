<?php


namespace App\Http\Controllers;

use App\Http\HighlightNews;
use App\News;
use App\SubscribeMail;
use App\TypeNews;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::leftJoin('type_news', 'type_news.id', '=', 'news.type_id')
                    ->select('news.*', DB::raw('type_news.title as title_type'))
                    ->orderBy('news.created_at')
                    ->paginate(9);

        $newsType = TypeNews::all();

        foreach ($news as $new)
        {
            $date = new \DateTimeImmutable($new->date);
            $year = $date->format('Y');
            $stringMonth = $this->_getMonthName($date->format('m'));
            $day = $date->format('d');

            $stringDate = $day . ' ' . $stringMonth . ' ' . $year;

            $new->date = $stringDate;
        }

        if (request('page') && request('ajax') === 'true')
        {
            return view('news.grid',[
                'news' => $news
            ]);
        }

        return view('news.list', [
            'news'     => $news,
            'newsType' => $newsType,
        ]);
    }

    public function typeView($id)
    {
        if (!$id)
        {
            return false;
        }

        $typeNews = TypeNews::whereId($id)->first();

        $news = News::where('news.type_id','=', $id)
                    ->leftJoin('type_news', 'type_news.id', '=', 'news.type_id')
                    ->select('news.*', DB::raw('type_news.title as title_type'))
                    ->paginate(9);

        if (request('page') && request('ajax') === 'true')
        {
            return view('news.grid',[
                'news' => $news
            ]);
        }

        return view('news.viewType', [
            'news'     => $news,
            'typeNews' => $typeNews,
        ]);
    }

    public function view($id)
    {
        $news = News::where('news.id', '=', $id)
                    ->leftJoin('type_news', 'type_news.id', '=', 'news.type_id')
                    ->select('news.*', DB::raw('type_news.title as title_type'))
                    ->first();

        $similarNewsArray = $this->getSimilarNews($news);

        if (!$similarNewsArray->news)
        {
            $lastNews = $this->getLastNews();
            $similarNewsArray->news = $lastNews->news;
        }

        return view('news.view', [
            'generalNews' => $news,
            'news'        => $similarNewsArray,
        ]);
    }

    public function getLastNews(): HighlightNews
    {
        $newsTitle = 'Последние новости';
        $newsSql = News::leftJoin('type_news', 'type_news.id', '=', 'news.type_id')
                       ->select('news.*', DB::raw('type_news.title as title_type'))
                       ->orderBy('news.created_at')
                       ->limit(4)
                       ->get()
                       ->toArray();

        return new HighlightNews($newsTitle, $this->reductionNews($newsSql));
    }

    public function getSimilarNews($news): HighlightNews
    {
        $arr = explode(' ', trim($news->title))[0];

        $newsSql = News::leftJoin('type_news', 'type_news.id', '=', 'news.type_id')
                       ->select('news.*', DB::raw('type_news.title as title_type'))
                       ->where('body', 'like', '%' . $arr . '%')
                       ->limit(4)
                       ->get()
                       ->toArray();

        $title = 'Похожие новости';

        return new HighlightNews($title, $this->reductionNews($newsSql));
    }

    public function getInterestingNews()
    {
        $title = 'Интересные новости';

        $newsSql = News::leftJoin('type_news', 'type_news.id', '=', 'news.type_id')
                       ->select('news.*', DB::raw('type_news.title as title_type'))
                       ->orderBy('created_at')
                       ->limit(4)
                       ->get()
                       ->toArray();

        $newsKeysRand = array_rand($newsSql, 4);

        $news = [];

        foreach ($newsKeysRand as $newsKeyRand)
        {
            $news[] = $newsSql[$newsKeyRand];
        }

        return new HighlightNews($title, $this->reductionNews($news));
    }

    public function reductionNewsDate($news): string
    {
        $dateNews = $news->date;

        $date = new \DateTimeImmutable($dateNews);
        $year = $date->format('Y');
        $stringMonth = $this->_getMonthName($date->format('m'));
        $day = $date->format('d');

        return $day . ' ' . $stringMonth . ' ' . $year;
    }

    public function reductionNewsDateArray($news): string
    {
        $dateNews = $news['date'];

        $date = new \DateTimeImmutable($dateNews);
        $year = $date->format('Y');
        $stringMonth = $this->_getMonthName($date->format('m'));
        $day = $date->format('d');

        return $day . ' ' . $stringMonth . ' ' . $year;
    }

    private function reductionNews($news): array
    {
        $reductionNews = [];

        foreach ($news as $new)
        {
            $date = new \DateTime($new['date']);
            $year = $date->format('Y');
            $stringMonth = $this->_getMonthName($date->format('m'));
            $day = $date->format('d');

            $stringDate = $day . ' ' . $stringMonth . ' ' . $year;

            $new['date'] = $stringDate;

            $reductionNews[] = $new;
        }

        return $reductionNews;
    }

    private function _getMonthName($month): string
    {
        switch ($month)
        {
            case '01':
                return 'января';
            case '02':
                return 'февраля';
            case '03':
                return 'марта';
            case '04':
                return 'апреля';
            case '05':
                return 'мая';
            case '06':
                return 'июня';
            case '07':
                return 'июля';
            case '08':
                return 'августа';
            case '09':
                return 'сентября';
            case '10':
                return 'отктября';
            case '11':
                return 'ноября';
            case '12':
                return 'декабря';
            default:
                return 'Не верно указан месяц';
        }
    }

    public function subscribeSave(Request $request)
    {
        $data = $request->all();

        $feedback = new SubscribeMail();

        $feedback->mail = $data['email'];

        $feedback->save();
    }
}