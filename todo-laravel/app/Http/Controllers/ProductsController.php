<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(Request $req)
    {
        $products = $this->all($req);
        return compact('products');
    }
    public function filter(Request $req)
    {
        $all = $this->all($req);
        return compact('all');
    }
    public function all(Request $req)
    {
        $page = $req->input('page', 1);
        $per_page = 2;
        $offset = ($page - 1) * $per_page;
        $pages = 0;

        $items = new Product();
        $items = $items->select(
            'products.*'
        );

        $items = $items->orderBy('id',"desc");
        $items = $items->offset($offset)
            ->limit($per_page)
            ->get()
            ->map(function ($item){
                $user = $item->user;
                $username = $user->name;
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'user' => $username,
                    'created_at' =>  $item->created_at->format('d.m.Y')
                ];
            })
        ;
        // dd(MyUtils::dbLog());
        return compact('per_page', 'page', 'offset', 'items', 'pages');
    }
    public function save(Request $req,$id)
    {
        $req->validate([
            'title' => 'required',
        ]);
        DB::beginTransaction();
        try {


            $item = Product::findOrFail($id);
            $item->title = $req->title;
            $item->user_id = auth()->user()->id;
            $item->save();

            DB::commit();
            $result = 'success';
            $message = 'Product was successfully updated!';
            return compact('result', 'message', 'item');
        } catch(\Exception $e) {
            DB::rollBack();
            $result = 'fail';
            $message = $e->getMessage();
            return compact('result', 'message');
        }
    }
    public function new(Request $req)
    {
        $req->validate([
            'title' => 'required',
        ]);
        DB::beginTransaction();
        try {

            $product = new Product();
            $product->title = $req->title;
            $product->user_id = auth()->user()->id;
            $product->save();

            $item = $product;
            DB::commit();
            $result = 'success';
            $message = 'Product was successfully created!';
            return compact('result', 'message', 'item');
        } catch(\Exception $e) {
            DB::rollBack();
            $result = 'fail';
            $message = $e->getMessage();
            return compact('result', 'message');
        }
    }
    public function remove($id)
    {
        DB::beginTransaction();
        try {
            $item = Product::findOrFail($id);
            $item->delete();
            DB::commit();
            $result = 'success';
            return compact('result');
        } catch(\Exception $e) {
            DB::rollBack();
            $result = 'fail';
            $message = $e->getMessage();
            return compact('result', 'message');
        }
    }

    public function autocomplete(Request $req) {
        $term = $req->input('term')??'';
        $page = $req->page??1;
        $per_page = 10;
        $offset = ($page - 1) * $per_page;
        if($term) {
            // DB::connection()->enableQueryLog();
            $a = Product::where('title', 'like', '%'.$term.'%')
                ->offset($offset)
                ->limit($per_page)
                ->orderBy('title')
                ->get()
                ->map(function ($item){
                    $title = $item->title;
                    return [
                        'value' => $title,
                        'id' => $item->id,
                        'text' => $title,
                        'label' => $title,
                        'title' => $title,
                    ];
                });
            return $a;
        } else {
            return [];
        }
    }
}
