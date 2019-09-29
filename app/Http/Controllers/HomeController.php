<?php


namespace App\Http\Controllers;

use App\Catalog;
use App\Manufacturer;
use App\News;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::all()->toArray();
        $newsSql = News::leftJoin('type_news', 'type_news.id', '=', 'news.type_id')
                       ->select('news.*', DB::raw('type_news.title as title_type'))
                       ->orderBy('news.created_at')
                       ->limit(6)
                       ->get()
                       ->toArray();

        $manufacturerSql = Manufacturer::limit(12)->get()->toArray();

        $manufacturer = array_chunk($manufacturerSql, 6);

        $manufacturerFirst = array_shift($manufacturer);

        $manufacturerSecond = $manufacturer[0];

        $news = array_chunk($newsSql, 3);

        $newsFirst = array_shift($news);

        $newsSecond = $news[0];

        $result = [];

        foreach ($catalogs as $catalog)
        {
            $result[$catalog['id']] = $catalog;
        }

        return view('index', [
            'catalogTree'        => $this->mapTree($result),
            'newsFirst'          => $newsFirst,
            'newsSecond'         => $newsSecond,
            'manufacturerFirst'  => $manufacturerFirst,
            'manufacturerSecond' => $manufacturerSecond,
        ]);
    }

    private function mapTree($catalogs): array
    {
        $tree = [];

        foreach ($catalogs as $id => &$catalog)
        {
            if ($catalog['parent_id'] === null)
            {
                $tree[$id] = &$catalog;
            }
            else
            {
                $catalogs[$catalog['parent_id']]['childs'][$id] = &$catalog;
            }
        }
        return $tree;
    }

    public function breadcrumbs($data, $id = null)
    {
        if (!$id)
        {
            return false;
        }

        $count = count($data);

        $breadcrumbsArray = [];

        for ($i = 0; $i < $count; $i++)
        {
            if (isset($data[$id]))
            {
                $breadcrumbsArray[$data[$id]['id']] = $data[$id]['display_name'];
                $id = $data[$id]['parent_id'];
            }
            else
            {
                break;
            }
        }

        if ($breadcrumbsArray)
        {
            $breadCrumbs = '';

            foreach ($breadcrumbsArray as $id => $name)
            {
                $breadCrumbs .= "<a href='?catalogId={$id}'>{$name}</a> / ";
            }

            $breadCrumbs = rtrim($breadCrumbs, ' / ');
        }
        else
        {
            $breadCrumbs = '<p>Каталог</p>';
        }

        return $breadCrumbs;
    }

}