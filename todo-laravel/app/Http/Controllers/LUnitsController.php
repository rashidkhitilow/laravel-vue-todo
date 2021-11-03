<?php

namespace App\Http\Controllers;

use App\LUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LUnitsController extends Controller
{
    public function index(Request $req)
    {
        $lunits = $this->all($req);
        return compact('lunits');
    }
    public function all(Request $req)
    {
        $page = $req->input('page', 1);
        $per_page = 2;
        $offset = ($page - 1) * $per_page;
        $pages = 0;

        $items = new LUnit();
        $items = $items->select(
            'l_units.*'
        );

        $items = $items->orderBy('title');
        $items = $items->offset($offset)
            ->limit($per_page)
            ->get()
            ->map(function ($item){
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'created_at' =>  $item->created_at->format('d.m.Y')
                ];
            })
        ;
        // dd(MyUtils::dbLog());
        return compact('per_page', 'page', 'offset', 'items', 'pages');
    }
    public function allWithPagination(Request $req)
    {

        $items = new LUnit();
        $items = $items->select(
            'l_units.*'
        );

        $items = $items->orderBy('id', 'desc');
        $items = $items->paginate(2);
        $updatedItems = $items
            ->getCollection()
            ->map(function ($item){
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'created_at' =>  $item->created_at->format('d.m.Y')
                ];
            })
        ;
        $items->setCollection($updatedItems);
        // dd(MyUtils::dbLog());
        return compact( 'items');
    }
    public function save(Request $req,$id)
    {
        $req->validate([
            'title' => 'required',
        ]);
        DB::beginTransaction();
        try {


            $item = LUnit::findOrFail($id);
            $item->title = $req->title;
            $item->user_id = auth()->user()->id;
            $item->save();

            DB::commit();
            $result = 'success';
            $message = 'Unit was successfully updated!';
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

            $item = new LUnit();
            $item->title = $req->title;
            $item->user_id = auth()->user()->id;
            $item->save();
            DB::commit();
            $result = 'success';
            $message = 'Unit was successfully created!';
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
            $item = LUnit::findOrFail($id);
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
            $a = LUnit::where('title', 'like', '%'.$term.'%')
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
