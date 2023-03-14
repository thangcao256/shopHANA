<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;

class MenuController extends Controller
{
    protected  $menuService;

    public function __construct(MenuService $menuService)
    {
        $this -> menuService = $menuService;
    }

    public function index(Request $request, $id, $slug = '')
    {
        $menu = $this->menuService->getId($id);
        $products = $this->menuService->getProduct($menu, $request);
        if ($menu->getAttributes()['parent_id'] == 0){
            return view('category', [
                'title' => $menu->name,
                'products' => $this -> menuService -> getProductByCategory($menu, $request),
                'menus' => $this -> menuService -> showMenu($id),
                'menu'  => $menu ,
            ]);
        }
        else{
            return view('menu', [
                'title' => $menu->name,
                'products' => $products,
                'menu'  => $menu,
            ]);
        }
    }
}
