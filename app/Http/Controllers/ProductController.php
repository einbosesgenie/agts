<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Product;

class ProductController extends Controller
{
    public function index($id)
    {
        $catalogModel = Catalog::all()->toArray();
        $catsId = $this->_getCatsId($catalogModel, $id);

        $catsId = !$catsId ? $id : rtrim($catsId,',');

        $products = Product::whereIn('catalog_id',$catsId)->get();
        dd($products);

    }

    private function _getCatsId($array, $id)
    {
        if(!$id)
        {
            return false;
        }

        $data = '';

        foreach ($array as $item)
        {
            if ($item['parent_id'] === (int)$id)
            {
                $data .= $item['id'] . ',';
                $data .= $this->_getCatsId($array, $item['id']);
            }
        }

        return $data;
    }
}
