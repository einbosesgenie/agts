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

    public function mapTree($catalogsModel):array
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
            else
            {
                $result[$catalog['parent_id']]['childs'][$id] = &$catalog;
            }
        }

        return $tree;
    }

    public function getParent()
    {
        return Catalog::where('parent_id', null);
    }
}