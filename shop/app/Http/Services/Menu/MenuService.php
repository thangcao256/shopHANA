<?php

namespace App\Http\Services\Menu;

use App\Models\Menu;
use App\Models\Product;
use MongoDB\Driver\Session;

class MenuService
{

    public function getParent(){
        return Menu::where('parent_id', 0)->get();
    }

    public function getAll(){
        return Menu::get();
    }

    public function create($request){
        try {
            Menu::create([
                'name' => (string) $request -> input('name'),
                'parent_id' => (int) $request -> input('parent_id'),
                'description' => (string) $request -> input('description'),
                'content' => (string) $request -> input('content'),
                'thumb' => (string) $request -> input('thumb'),
                'active' => (int) $request -> input('active')
            ]);
            session()->flash('sucess', 'Create new menu success!');
        } catch (\Exception $err) {
            session()->flash('error', $err -> getMessage());
            return false;
        }

        return true;
    }

    public function update($request, $menu): bool
    {
//        $menu->fill($request->input());
//        $menu->save();
        if ($request->input('parent_id') !== $menu->id){
            $menu->parent_id = (string) $request->input('parent_id');
        }

        $menu->name = (string) $request->input('name');
        $menu->description = (string) $request->input('description');
        $menu->content = (string) $request->input('content');
        $menu->active = (string) $request->input('active');
        $menu->thumb = (string) $request->input('thumb');
        $menu->save();

        session()->flash('sucess', 'Update menu success!');
        return true;
    }

    public function destroy($request){
        $id = (int) $request->input('id');
        $menu = Menu::where('id', $id)->first();
        if($menu) {
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }

        return false;
    }

    public function show(){
        return Menu::select('name', 'id', 'thumb')->where('parent_id', 0)->orderBy('id')->get();
    }

    public function showMenu($id){
        return Menu::select('name', 'id', 'thumb')->where('parent_id', $id)->orderBy('id')->get();
    }

    public function getId($id){
        return Menu::Where('id', $id)->where('active', 1)->firstOrFail();
    }

    public function getProduct($menu, $request)
    {
        $query = $menu->products()
            ->select('id', 'name', 'price', 'price_sale', 'thumb')
            ->where('active', 1);

        if ($request->input('price')) {
            $query->orderBy('price', $request->input('price'));
        }

        return $query
            ->orderByDesc('id')
            ->paginate(8)
            ->withQueryString();
    }

    public function getProductByCategory($menu, $request)
    {
        $query = Product::select('products.id', 'products.price', 'products.price_sale', 'products.thumb', 'products.name')
            ->join('menus', 'products.menu_id', '=', 'menus.id')
            ->Where('menus.parent_id', $menu->id);

        if ($request->input('price')) {
            $query->orderBy('price', $request->input('price'));
        }

        return $query
            ->orderByDesc('products.id')
            ->paginate(8)
            ->withQueryString();
    }
}
