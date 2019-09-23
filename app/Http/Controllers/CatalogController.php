<?php


namespace App\Http\Controllers;

use App\Catalog;

class CatalogController extends Controller
{
    public function index()
    {
        $catalogs = Catalog::all()->toArray();

        $catalogsTree = $this->mapTree($catalogs);

        return view('catalog.root', [
            'catalogTree' => $catalogsTree
        ]);
    }

    public function viewCategory($id)
    {
        $catalogs = Catalog::all()->toArray();

        $catalogsTree = $this->levelTree($catalogs, $id);
        $breadcrumbs = $this->_getBreadcrumb($catalogs, $id);

        return view('catalog.category', [
            'catalogTree' => $catalogsTree,
            'breadcrumbs' => array_reverse($breadcrumbs, true)
        ]);
    }

    public function mapTree($catalogsModel, $catalogId = null):array
    {
        $result = [];

        foreach ($catalogsModel as $catalog)
        {
            $result[$catalog['id']] = $catalog;
        }

        $tree = [];

        foreach ($result as $id => &$catalog)
        {
            if ($catalog['parent_id'] === null)
            {
                $tree[$id] = &$catalog;
            }
            elseif ($catalog['parent_id'] !== null && $id === (int)$catalogId)
            {
                $tree[$id] = &$catalog;
            }
            else
            {
                $result[$catalog['parent_id']]['childs'][$id] = &$catalog;
            }
        }

        return $tree;
    }

    public function levelTree($catalogsModel, $id)
    {
        $catsId = $this->getCutsId($catalogsModel, $id);
        $catsId = !$catsId ? [$id] : explode(',', $catsId . $id);

        $catalogsModel = Catalog::whereIn('id', $catsId)->get()->toArray();

        return $this->mapTree($catalogsModel, $id);
    }

    public function getCutsId($catalogsModel, $id)
    {
        if(!$id)
        {
            return false;
        }

        $data = '';

        foreach ($catalogsModel as $item)
        {
            if ($item['parent_id'] === (int)$id)
            {
                $data .= $item['id'] . ',';
                $data .= $this->getCutsId($catalogsModel, $item['id']);
            }
        }

        return $data;
    }

    public function _getBreadcrumb($catalogsModel, $id)
    {
        if(!$id)
        {
            return false;
        }

        $data = [];
        $result = [];

        foreach ($catalogsModel as $catalog)
        {
            $result[$catalog['id']] = $catalog;
        }

        $count = count($result);

        for ($i = 0; $i < $count; $i++)
        {
            if ($id !== null)
            {
                if ($result[$id])
                {
                    $data[$result[$id]['id']] = $result[$id];
                    $id = $result[$id]['parent_id'];
                }
            }
            else
            {
                break;
            }
        }

        return $data;
    }

    public function getParent()
    {
        return Catalog::where('parent_id', null);
    }
}