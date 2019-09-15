<?php


namespace App\Http\Controllers;

use App\Catalog;

class HomeController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::all()->toArray();

        $result = [];

        foreach ($catalogs as $catalog)
        {
            $result[$catalog['id']] = $catalog;
        }

        return view('index', [
            'catalogsTree' => $this->mapTree($result)
        ]);

        echo $this->breadcrumbs($result, 4);
    }

    private function mapTree($catalogs):array
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