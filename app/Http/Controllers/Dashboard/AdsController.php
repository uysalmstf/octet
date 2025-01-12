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
            ["PagesLeft" => 2],
            ["PagesInner" => 3],
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
        $ad_type->save();
    }

    public function adTypeDelete($id = null){
        $ad_type = AdTypess::where('id', $id)->firstOrFail();
        $ad_type->delete();
        return back()->with(['message' => 'Deleted Successfully', 'type' => 'success']);
    }

    public function ads(){

        $ads = Ads::all();

        if ($ads != null){ 
            foreach ($ads as $key => $value) {
                # code...
                $ad_type = AdTypess::where('id', $value->ad_type_id)->firstOrFail();
                $ads[$key]->ad_type_id = $ad_type->title;
            }
        }
        
        
        return view('panel.ads.ads', compact('ads'));
    }

    public function adsDelete($id = null){
        $ads = Ads::where('id', $id)->firstOrFail();
        $ads->delete();
        return back()->with(['message' => 'Deleted Successfully', 'type' => 'success']);
    }

    public function adsSave(Request $request){

        if ($request->page_id != 'undefined'){
            $ads = Ads::where('id', $request->page_id)->firstOrFail();
        }else{
            $ads = new Ads();
        }

        $ads->title = $request->title;
        $ads->ad_type_id = $request->ad_type_id;
        $ads->redirected_url = $request->redirected_url;
        $ads->save();
    }

    public function adsAddOrUpdate($id = null){

        if ($id == null){
            $ads = null;
        }else{
            $ads = Ads::where('id', $id)->firstOrFail();
        }

        $ad_types = AdTypess::all();

        return view('panel.ads.ads_add', compact('ads', 'ad_types'));
    }
}
