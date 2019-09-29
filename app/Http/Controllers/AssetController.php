<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use App\Traits\GetTemporaryUrl;
use Auth;

class AssetController extends Controller
{
    use GetTemporaryUrl;

    public function show(Asset $asset)
    {
        if($asset->type == 'link') return redirect($asset->link);
        if($asset->type == 'file') return redirect($this->temporaryUrl($asset->link));
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
            'title' => 'required|string',
            'link' => 'nullable|url',
            'file' => 'nullable|file',
            'visibility' => 'required|in:student,teacher'
        ]);

        $asset = new Asset();
        $asset->assetable_id = $assetable_id;
        $asset->assetable_type = 'App\\' . ucfirst($assetable_type);
        $asset->owner = Auth::user()->id;
        $asset->type = $type;
        $asset->title = $request->title;
        $asset->visibility = $request->visibility;
        
        if($request->hasFile('file'))
        {
            $extension = $request->file->getClientOriginalExtension();
            $filename = 'asset_' . $assetable_type . '_' . uniqid() . '.' . $extension;
            $path = Storage::disk('spaces')->putFileAs('uploads/assets', $request->file, $filename, 'private');
            $asset->link = $path;
        }
        else
        {
            $asset->link = $request->link;
        }
        
        $asset->save();

        switch ($assetable_type) {
            case 'term':
                $term = Term::find($assetable_id);
                return redirect()->route('qualifications.cohorts.terms.assets.index', [$term->cohort->qualification, $term->cohort, $term]);
                break;
            
            default:
                return redirect()->route('home');
                break;
        }
    }
}
