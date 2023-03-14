<?php


namespace App\Http\Services\Product;


use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class ProductAdminService
{
    public function getMenuParent()
    {
        return Menu::where('active', 1)->where('parent_id', '<>', 0)->get();
    }

    public function getMenu()
    {
        return Menu::where('active', 1)->get();
    }

    protected function isValidPrice($request)
    {
        if ($request->input('price') != 0 && $request->input('price_sale') != 0
            && $request->input('price_sale') >= $request->input('price')
        ) {
            Session::flash('error', 'Reduced price must be less than original price!');
            return false;
        }

        if ($request->input('price_sale') != 0 && (int)$request->input('price') == 0) {
            Session::flash('error', 'Please enter origin price!');
            return false;
        }

        return  true;
    }

    public function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $request->except('_token');
            Product::create($request->all());

            session()->flash('success', 'Add new product success!');
        } catch (\Exception $err) {
            session()->flash('error', 'Error to add new product!');
            \Log::info($err->getMessage());
            dd($err->getMessage());
            return  false;
        }

        return  true;
    }

    public function get()
    {
        return Product::with('menu')
            ->orderByDesc('id')->paginate(9);
    }

    public function update($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $product->fill($request->input());
            $product->save();
            session()->flash('success', 'Update product success!');
        } catch (\Exception $err) {
            Session::flash('error', 'Error to update product!');
            \Log::info($err->getMessage());
            return false;
        }
        return true;
    }

    public function delete($request)
    {
        $product = Product::where('id', $request->input('id'))->first();
        if ($product) {
            $product->delete();
            return true;
        }

        return false;
    }
}
