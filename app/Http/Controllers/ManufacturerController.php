<?php


namespace App\Http\Controllers;

use App\Manufacturer;
use App\Product;

class ManufacturerController extends Controller
{
    public function index()
    {
        $paginate = 12;

        $manufacturers = Manufacturer::paginate($paginate);

        if (request('page') && request('ajax') === 'true')
        {
            return view('manufacturer.grid',[
                'manufacturers' => $manufacturers
            ]);
        }

        return view('manufacturer.list', [
            'manufacturers' => $manufacturers
        ]);
    }

    public function viewProduct($manufacturerId)
    {
        $manufacturer = Manufacturer::find($manufacturerId);

        $products = $this->_getProducts($manufacturer->id);

        return view('manufacturer.viewProduct', [
            'products' => $products,
            'manufacturer' => $manufacturer,
            ]);
    }

    private function _getProducts($manufacturerId)
    {
        return Product::where('manufacturers_id', '=', $manufacturerId)->paginate(3);
    }
}