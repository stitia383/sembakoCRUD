<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use Carbon\Carbon;
use function GuzzleHttp\json_encode;

class SembakoController extends Controller
{
    public function index($item){
        $item_condition = $item;

        $item = $this->item($item)[0];
        $items = $this->item($item)[1];
        $barang = $this->item($item)[2];
        return view('sembako.barang')->with([
            'barang' => $barang,
            'item' => $item,
            'item_condition' => $item_condition
        ]);
    }

    public function item($item){
      $items =[
          ['item' => 'all'],
          ['item' => '3 hari']
      ];

      $item = str_replace("_"," ",$item);
        $items = json_decode(json_encode($items));
        $items = collect($items);
        $items = $items->where('item', $item)->isEmpty();
        if($items){
            return abort(404);
        }else if($item == '3 hari'){
            $barang = $this->exp();
        }else if($item == 'all'){
            $barang = $this->all();
        }
        return [$item,$items,$barang];
    }

    public function all(){
        $barang = $this->expiredMessage();
        return collect($barang)->sortBy('name');
    }

    public function exp(){
        $barang = $this->expiredMessage();
        return collect($barang)->sortBy('exp');
    }

    public function expiredMessage(){
        $barang = Item::all();
        foreach($barang as $Barang){
            $today = Carbon::now()->setTime(0,0,0);
            $exp = Carbon::parse($Barang->exp);
            $day_difference = $today->diffInDays($exp);
            if( $day_difference <= '3'){
                if($today == $exp){
                    $Barang['message'] = "Barang hari ini kadaluwarsa";
                    $Barang['bg_alert'] = "btn-default";

                }else if($today > $exp){
                    $Barang['message'] = "Barang Kadaluwarsa";
                    $Barang['bg_alert'] = "btn-danger";
                }else{
                    $Barang['message'] = "Barang akan segera kadaluwarsa";
                    $Barang['bg_alert'] = "btn-warning";
                }
            }else{
                $Barang['message'] = "Barang Masih Bagus";
                $Barang['bg_alert'] = "btn-success";
            }

            }

            return $barang;
        }
        public function create(){
            return view('sembako.tambah');
        }

        public function store(Request $request){
            $this->validate($request,[
                'name'=>'required|max:200',
                'stock' => 'required|integer',
                'exp' => 'required|date'
            ]);

            try{
                $barang = Item::create([
                    'name'=> $request->name,
                    'stock' => $request->stock,
                    'exp' => $request->exp
                ]);
                return back()->with('berhasil', 'barang berhasil di simpan');
            }catch(Exception $e){
                DB::rollback();
                return back()->with('error',$e->getMessage());
            }
        }

        public function edit($id, $item){
            $this->item($item);
            $barang = Item::findOrFail($id);
            return view('sembako.edit')->with([
                'barang' => $barang,
                'item' => $item
            ]);
        }

        public function update(Request $request,$id,$item){
            $this->validate($request,[
                'name'=>'required|max:200',
                'stock' => 'required|integer',
                'exp' => 'required|date'
            ]);

            $this->item($item);
            try{
                $barang = Item::findOrFail($id);
                $barang->update([
                    'name'=> $request->name,
                    'stock' => $request->stock,
                    'exp' => $request->exp
                ]);
                return redirect(route('index.sembako', $item))->with('sukses','data berhasil di perbaharui');

            }catch(Exception $e){
                DB::rollback();
                return back()->with('error', $e->getMessage());
            }
        }

    public function destroy($id){

        try{
            $barang = Item::findOrFail($id);
            $barang->delete();
            return back()->with('sukses', 'data berhasil dihapus');
        }catch(Exception $e){
            return back()->with('error', $e->getMessage());
        }

    }
}


