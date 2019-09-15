<?php


namespace App\Http\Controllers;

use App\Catalog;
use App\News;
use App\TypeNews;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::paginate(9);

        $catalogParents = Catalog::where('parent_id', null);
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

        return view('news.list', [
            'news' => $news,
            'newsType' => $newsType,
            'catalogParents' => $catalogParents,
        ]);
    }

    public function getLastNews()
    {
        $newsTitle = 'Последние новости';
        $news = DB::select('select n.*,
       tn.title as title_type
from news n
inner join type_news tn on tn.id = n.type_id
order by n.created_at
limit 3');

        foreach ($news as $new)
        {
            $date = new \DateTimeImmutable($new->date);
            $year = $date->format('Y');
            $stringMonth = $this->_getMonthName($date->format('m'));
            $day = $date->format('d');

            $stringDate = $day . ' ' . $stringMonth . ' ' . $year;

            $new->date = $stringDate;
        }

        return [
            'news' => $news,
            'title' => $newsTitle
        ];
    }

    private function _getMonthName($month)
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
}