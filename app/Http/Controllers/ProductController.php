<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Manufacturer;
use App\Product;

class ProductController extends Controller
{
    public function index($id)
    {
        $catalogModel = Catalog::all()->toArray();
        $catsId = $this->_getCatsId($catalogModel, $id);
        $catalogType = Catalog::whereId($id)->first();

        $catsId = !$catsId ? [$id] : explode(',', $catsId . $id);

        $products = Product::leftJoin('manufacturers', 'products.manufacturers_id', '=', 'manufacturers.id')
                           ->whereIn('catalog_id', $catsId)->paginate(6);

        return view('product.list', [
            'products' => $products,
            'catalogType' => $catalogType->display_name
        ]);
    }

    public function viewCategory($id)
    {
        $catalogModel = Catalog::all()->toArray();
        $catsId = $this->_getCatsId($catalogModel, $id);
        $catalogType = Catalog::whereId($id)->first();

        $catsId = !$catsId ? [$id] : explode(',', $catsId . $id);

        $products = Product::leftJoin('manufacturers', 'products.manufacturers_id', '=', 'manufacturers.id')
                           ->whereIn('catalog_id', $catsId)->paginate(6);

        return view('product.category', [
            'products' => $products,
            'catalogType' => $catalogType->display_name
        ]);
    }

    public function viewProduct($id)
    {

        $product = Product::whereId($id)->first()->toArray();

        $manufacturer = Manufacturer::whereId($product['manufacturers_id'])->first()->toArray();

        $news = (new NewsController())->getInterestingNews();

        return view('product.view', [
            'news'         => $news,
            'manufacturer' => $manufacturer,
        ]);
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
