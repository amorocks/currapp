<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Cohort;
use Illuminate\Http\Request;
use Auth;

class AssetController extends Controller
{
    public function show(Asset $asset)
    {
        if($asset->type == 'link') return redirect($asset->link);
    }

    public function create($type, $assetable_type, $assetable_id)
    {
        return view('assets.create_' . $type)
            ->with(compact('assetable_type'))
            ->with(compact('assetable_id'));
    }

    public function store(Request $request, $type, $assetable_type, $assetable_id)
    {
        
        $this->validate(request(), [
            'link' => 'required|url',
            'visibility' => 'required|in:student,teacher'
        ]);

        $asset = new Asset();
        $asset->assetable_id = $assetable_id;
        $asset->assetable_type = 'App\\' . ucfirst($assetable_type);
        $asset->owner = Auth::user()->id;
        $asset->type = $type;
        $asset->title = $request->title;
        $asset->visibility = $request->visibility;
        
        switch ($type) {
            case 'link':
                $asset->link = $request->link;
                break;
        }
        
        $asset->save();

        switch ($assetable_type) {
            case 'cohort':
                $cohort = Cohort::find($assetable_id);
                return redirect()->route('qualifications.cohorts.assets.index', [$cohort->qualification, $cohort]);
                break;
            
            default:
                return redirect()->route('home');
                break;
        }
    }
}
