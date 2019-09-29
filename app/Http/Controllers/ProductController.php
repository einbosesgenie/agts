<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Manufacturer;
use App\Product;
use Doctrine\DBAL\Schema\AbstractAsset;

class ProductController extends Controller
{
    public function index($id)
    {
        $catalogModel = Catalog::all()->toArray();
        $catsId = $this->_getCatsId($catalogModel, $id);
        $catalogType = Catalog::whereId($id)->first();

        $catsId = !$catsId ? [$id] : explode(',', $catsId . $id);

        $breadcrumbs = array_reverse($this->_getBreadcrumbCategory($catalogModel, $id));

        $products = Product::leftJoin('manufacturers', 'products.manufacturers_id', '=', 'manufacturers.id')
                           ->whereIn('catalog_id', $catsId)
                           ->select('products.id',
                               'products.name',
                               'catalog_id',
                               'products.created_at',
                               'products.body',
                               'products.manufacturers_id',
                               'products.img',
                               'manufacturers.title',
                               'manufacturers.url',
                               'manufacturers.display_url'
                               )
                           ->paginate(6);

        $breadcrumbsEnd = array_pop($breadcrumbs);

        $breadcrumbs = $this->_getBreadcrumbCategory($catalogModel, $id);

        unset($breadcrumbs[$breadcrumbsEnd['id']]);

        return view('product.list', [
            'products'       => $products,
            'catalogType'    => $catalogType->display_name,
            'breadcrumbs'    => array_reverse($breadcrumbs),
            'breadcrumbsEnd' => $breadcrumbsEnd,
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
            'products'    => $products,
            'catalogType' => $catalogType->display_name,
        ]);
    }

    public function viewProduct($id)
    {
        $product = Product::whereId($id)->first()->toArray();

        $manufacturer = Manufacturer::whereId($product['manufacturers_id'])->first()->toArray();

        $news = (new NewsController())->getInterestingNews();

        $catalogModel = Catalog::all()->toArray();

        $breadcrumbs = array_reverse($this->_getBreadcrumbCategory($catalogModel, $product['catalog_id']));

        $breadcrumbsEnd = array_pop($breadcrumbs);

        $breadcrumbs = $this->_getBreadcrumbCategory($catalogModel, $product['catalog_id']);

        unset($breadcrumbs[$breadcrumbsEnd['id']]);

        return view('product.view', [
            'news'           => $news,
            'manufacturer'   => $manufacturer,
            'product'        => $product,
            'breadcrumbs'    => array_reverse($breadcrumbs),
            'breadcrumbsEnd' => $breadcrumbsEnd,
        ]);
    }

    public function getProductsForCast(array $catsId)
    {
        return Product::leftJoin('manufacturers', 'products.manufacturers_id', '=', 'manufacturers.id')
                      ->select('products.*', 'manufacturers.title')
                      ->whereIn('catalog_id', $catsId)->paginate(6);
    }

    private function _getBreadcrumbs($productId)
    {
        $catalog = Product::whereId($productId)->first()->toArray();
        $catalogId = $catalog['catalog_id'];

        $catalogsModel = Catalog::all()->toArray();

        $data = [];
        $result = [];

        foreach ($catalogsModel as $catalog)
        {
            $result[$catalog['id']] = $catalog;
        }

        $count = count($result);

        for ($i = 0; $i < $count; $i++)
        {
            if ($catalogId !== null)
            {
                if ($result[$catalogId])
                {
                    $data[$result[$catalogId]['id']] = $result[$catalogId];
                    $catalogId = $result[$catalogId]['parent_id'];
                }
            }
            else
            {
                break;
            }
        }

        return array_reverse($data);
    }

    private function _getBreadcrumbCategory($catalogsModel, $id)
    {
        if (!$id)
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

    private function _getCatsId($array, $id)
    {
        if (!$id)
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
