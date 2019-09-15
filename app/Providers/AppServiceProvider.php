<?php

namespace App\Providers;

use App\Catalog;
use App\Http\Controllers\CatalogController;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('layout.layout', function($view) {

            $catalogs = Catalog::all()->toArray();

            $view->with('catalogsTree', (new CatalogController)->mapTree($catalogs));
            $view->with('catalogParents', $catalogs);
        });
    }

    private function mapTree($catalogsModel):array
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
}
