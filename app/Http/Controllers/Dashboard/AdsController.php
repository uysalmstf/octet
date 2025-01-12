<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\AdTypess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdsController extends Controller
{
    
    public function adTypes(){
        $items = AdTypess::all();

        foreach ($items as $key => $value) {
            # code...
            $items[$key]->type = $this->findType($value->type);
        }
        
        return view('panel.ads.adtypes', compact('items'));
    }

    private function findType($type) : string
    {
        $ad_type_enums = array(
            ["SiteBanner" => 1],
            ["Pages" => 2],
        );

        foreach ($ad_type_enums as $key => $value) {
            
            foreach ($value as $k => $v) {
                
                if ($v == $type){
                    return $k;
                }
            }
            
        }

        return "";
        
    }

    public function adTypeAddOrUpdate($id = null){

        if ($id == null){
            $ad_type = null;
        }else{
            $ad_type = AdTypess::where('id', $id)->firstOrFail();
        }

        $ad_type_enums = array(
            ["SiteBanner" => 1],
            ["Pages" => 2],
        );

        return view('panel.ads.adtypes_add', compact('ad_type', 'ad_type_enums'));
    }

    public function adTypeSave(Request $request){

        if ($request->page_id != 'undefined'){
            $ad_type = AdTypess::where('id', $request->page_id)->firstOrFail();
        }else{
            $ad_type = new AdTypess();
        }

        $ad_type->title = $request->title;
        $ad_type->type = $request->type;
        $ad_type->script = $request->script;
        $ad_type->save();
    }

    public function adTypeDelete($id = null){
        $ad_type = AdTypess::where('id', $id)->firstOrFail();
        $ad_type->delete();
        return back()->with(['message' => 'Deleted Successfully', 'type' => 'success']);
    }
}
