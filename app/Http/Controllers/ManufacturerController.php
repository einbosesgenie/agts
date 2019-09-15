<?php


namespace App\Http\Controllers;

use App\Manufacturer;
use App\Product;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::paginate(9);

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