<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Instruction;
use App\Manufacturer;
use App\Product;
use Doctrine\DBAL\Schema\AbstractAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        if (request('page') && request('ajax') === 'true')
        {
            return view('product.grid',[
                'products' => $products
            ]);
        }

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

        $files = $this->_getFiles($id);

        $manufacturer = Manufacturer::whereId($product['manufacturers_id'])->first()->toArray();

        $news = (new NewsController())->getInterestingNews();

        $catalogModel = Catalog::all()->toArray();

        $breadcrumbs = array_reverse($this->_getBreadcrumbCategory($catalogModel, $product['catalog_id']));

        $breadcrumbsEnd = array_pop($breadcrumbs);

        $breadcrumbs = $this->_getBreadcrumbCategory($catalogModel, $product['catalog_id']);

        unset($breadcrumbs[$breadcrumbsEnd['id']]);

        $relatedProductsId = [
            $product['related_product_first'],
            $product['related_product_second'],
            $product['related_product_third'],
        ];

        $relatedProducts = Product::whereIn('id', $relatedProductsId)->get();

        return view('product.view', [
            'news'            => $news,
            'manufacturer'    => $manufacturer,
            'product'         => $product,
            'breadcrumbs'     => array_reverse($breadcrumbs),
            'breadcrumbsEnd'  => $breadcrumbsEnd,
            'files'           => $files,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    private function FBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    private function _getFiles($id)
    {
        $files = Instruction::where('products_id', '=', $id)->get();

        if (count($files) > 0)
        {
            foreach ($files as $file)
            {
                $filename = json_decode($file->file, true)[0]['original_name'];
                $filePath = json_decode($file->file, true)[0]['download_link'];

                $file['expansion'] = pathinfo($filename, PATHINFO_EXTENSION);
                $file['size'] = $this->FBytes(Storage::size('/storage/' . $filePath));
                $file['link'] = $filePath;
            }
        }

        return $files;
    }

    public function getProductsForCast(array $catsId)
    {
        return Product::leftJoin('manufacturers', 'products.manufacturers_id', '=', 'manufacturers.id')
                      ->select('products.*', 'manufacturers.title')
                      ->whereIn('catalog_id', $catsId)->paginate(6);
    }

    public function search()
    {
        $dataSearch = mb_strtolower(request('q'));

        $products = Product::leftJoin('manufacturers', 'products.manufacturers_id', '=', 'manufacturers.id')
                           ->whereRaw('lower(name) like (?)',["%{$dataSearch}%"])->paginate(6);

        if (request('page') && request('ajax') === 'true')
        {
            return view('product.grid',[
                'products' => $products
            ]);
        }

        return view('product.search', ['products' => $products]);

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
