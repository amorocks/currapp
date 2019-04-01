<?php

namespace App\Http\Controllers;

use App\TagType;
use Illuminate\Http\Request;

class TagTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tag_types.index')
            ->with('types', TagType::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag_types.form')
            ->with('type', new TagType());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate(request(), [
            'title' => 'required|string',
            'color' => 'required|string',
        ]);

        $tagType = new TagType();
        $tagType->title = $request->title;
        $tagType->back_color = $request->color;
        $tagType->text_color = $this->contrast($request->color); 
        $tagType->save();
        
        return redirect()->route('tag-types.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TagType  $tagType
     * @return \Illuminate\Http\Response
     */
    public function edit(TagType $tagType)
    {
        return view('tag_types.form')
            ->with('type', $tagType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TagType  $tagType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TagType $tagType)
    {
        $this->validate(request(), [
            'title' => 'required|string',
            'color' => 'required|string',
        ]);

        $tagType->title = $request->title;
        $tagType->back_color = $request->color;
        $tagType->text_color = $this->contrast($request->color);
        $tagType->save();

        return redirect()->route('tag-types.index');
    }

    public function delete(TagType $tagType)
    {
        return view('tag_types.delete')
            ->with(compact('tagType'));
    }

    public function destroy(TagType $tagType)
    {
        $tagType->delete();
        return redirect()->route('tag-types.index')->with('status', [
            'success' => 'Tagsoort verwijderd!'
        ]);
    }

    private function contrast($hexColor) {
        
        //////////// hexColor RGB
        $R1 = hexdec(substr($hexColor, 1, 2));
        $G1 = hexdec(substr($hexColor, 3, 2));
        $B1 = hexdec(substr($hexColor, 5, 2));

        //////////// Black RGB
        $blackColor = "#000000";
        $R2BlackColor = hexdec(substr($blackColor, 1, 2));
        $G2BlackColor = hexdec(substr($blackColor, 3, 2));
        $B2BlackColor = hexdec(substr($blackColor, 5, 2));

         //////////// Calc contrast ratio
         $L1 = 0.2126 * pow($R1 / 255, 2.2) +
               0.7152 * pow($G1 / 255, 2.2) +
               0.0722 * pow($B1 / 255, 2.2);

        $L2 = 0.2126 * pow($R2BlackColor / 255, 2.2) +
              0.7152 * pow($G2BlackColor / 255, 2.2) +
              0.0722 * pow($B2BlackColor / 255, 2.2);

        $contrastRatio = 0;
        if ($L1 > $L2) {
            $contrastRatio = (int)(($L1 + 0.05) / ($L2 + 0.05));
        } else {
            $contrastRatio = (int)(($L2 + 0.05) / ($L1 + 0.05));
        }

        //////////// If contrast is more than 5, return black color
        if ($contrastRatio > 6) {
            return 'black';
        } else { //////////// if not, return white color.
            return 'white';
        }
    }
}
