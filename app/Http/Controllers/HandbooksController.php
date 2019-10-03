<?php


namespace App\Http\Controllers;

use App\IndustrialFilter;
use App\Instruction;
use App\LineProductsFilter;
use App\ResourceTypeFilter;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


class HandbooksController extends Controller
{
    public function index()
    {
        $files = Instruction::leftJoin('products', 'products.id', '=', 'instructions.products_id')
                            ->select('instructions.*', DB::raw('products.name as products_name'))
                            ->paginate(10);

        if (empty(trim(request('category'), '[]'))
            && empty(trim(request('industry'), '[]'))
            && empty(trim(request('type'), '[]'))
            && request('ajax') === 'true')
        {
            $files = Instruction::leftJoin('products', 'products.id', '=', 'instructions.products_id')
                                ->select('instructions.*', DB::raw('products.name as products_name'))
                                ->paginate(10);

            foreach ($files as $file)
            {
                $filename = json_decode($file->file, true)[0]['original_name'];
                $filePath = json_decode($file->file, true)[0]['download_link'];

                $file['expansion'] = pathinfo($filename, PATHINFO_EXTENSION);
                $file['size'] = $this->FBytes(Storage::size('/storage/' . $filePath));
                $file['link'] = $filePath;
            }

            return view('handbooks.fileWrap', ['files' => $files]);

        }
        elseif(!empty(trim(request('category'), '[]'))
            || !empty(trim(request('industry'), '[]'))
            || !empty(trim(request('type'), '[]')))
        {
            $category = [];
            $industry = [];
            $type = [];

            if (!empty(trim(request('category'), '[]')))
            {
                $category = explode(',', trim(request('category'), '[]'));
            }

            if (!empty(trim(request('industry'), '[]')))
            {
                $industry = explode(',', trim(request('industry'), '[]'));
            }

            if (!empty(trim(request('type'), '[]')))
            {
                $type = explode(',', trim(request('type'), '[]'));

            }

            if ($category && !$industry && !$type)
            {
                $files = Instruction::leftJoin('products', 'products.id', '=', 'instructions.products_id')
                                    ->whereIn('line_products_id', $category)
                                    ->select('instructions.*', DB::raw('products.name as products_name'))
                                    ->paginate(10);
            }

            if ($category && $industry && !$type)
            {
                $files = Instruction::leftJoin('products', 'products.id', '=', 'instructions.products_id')
                                    ->whereIn('line_products_id', $category)
                                    ->whereIn('resource_type_id', $industry)
                                    ->select('instructions.*', DB::raw('products.name as products_name'))
                                    ->paginate(10);
            }

            if ($category && $industry && $type)
            {
                $files = Instruction::leftJoin('products', 'products.id', '=', 'instructions.products_id')
                                    ->whereIn('line_products_id', $category)
                                    ->whereIn('resource_type_id', $industry)
                                    ->whereIn('industrial_id', $type)
                                    ->select('instructions.*', DB::raw('products.name as products_name'))
                                    ->paginate(10);
            }

            if (!$category && $industry && $type)
            {

                $files = Instruction::leftJoin('products', 'products.id', '=', 'instructions.products_id')
                                    ->whereIn('resource_type_id', $industry)
                                    ->whereIn('industrial_id', $type)
                                    ->select('instructions.*', DB::raw('products.name as products_name'))
                                    ->paginate(10);
            }

            if (!$category && !$industry && $type)
            {

                $files = Instruction::leftJoin('products', 'products.id', '=', 'instructions.products_id')
                                    ->whereIn('resource_type_id', $type)
                                    ->select('instructions.*', DB::raw('products.name as products_name'))
                                    ->paginate(10);
            }

            if (!$category && $industry && !$type)
            {

                $files = Instruction::leftJoin('products', 'products.id', '=', 'instructions.products_id')
                                    ->whereIn('industrial_id', $industry)
                                    ->select('instructions.*', DB::raw('products.name as products_name'))
                                    ->paginate(10);
            }

            if ($category && !$industry && $type)
            {

                $files = Instruction::leftJoin('products', 'products.id', '=', 'instructions.products_id')
                                    ->whereIn('line_products_id', $category)
                                    ->whereIn('industrial_id', $type)
                                    ->select('instructions.*', DB::raw('products.name as products_name'))
                                    ->paginate(10);
            }

            foreach ($files as $file)
            {
                $filename = json_decode($file->file, true)[0]['original_name'];
                $filePath = json_decode($file->file, true)[0]['download_link'];

                $file['expansion'] = pathinfo($filename, PATHINFO_EXTENSION);
                $file['size'] = $this->FBytes(Storage::size('/storage/' . $filePath));
                $file['link'] = $filePath;
            }

            return view('handbooks.fileWrap', ['files' => $files]);
        }


        foreach ($files as $file)
        {
            $filename = json_decode($file->file, true)[0]['original_name'];
            $filePath = json_decode($file->file, true)[0]['download_link'];

            $file['expansion'] = pathinfo($filename, PATHINFO_EXTENSION);
            $file['size'] = $this->FBytes(Storage::size('/storage/' . $filePath));
            $file['link'] = $filePath;
        }

        if (request('page') && request('ajax') === 'true')
        {
            return view('handbooks.fileWrap', ['files' => $files]);
        }

        $industrialFilter = IndustrialFilter::orderBy('created_at')->get();
        $lineProductFilter = LineProductsFilter::orderBy('created_at')->get();
        $resourceTypeFilter = ResourceTypeFilter::orderBy('created_at')->get();

        return view('handbooks.list', [
            'files'              => $files,
            'industrialFilter'   => $industrialFilter,
            'lineProductFilter'  => $lineProductFilter,
            'resourceTypeFilter' => $resourceTypeFilter,
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

}