<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules());
        Tag::create($request->all());
        return redirect()->route('tags.index')->with('message', "Tag created correctly");
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate($this->rules($tag->id));
        $tag->update($request->all());
        return redirect()->route('tags.index')->with('message', "Tag updated correctly");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('message', "Tag removed correctly");
    }

    public function rules(?int $id = null)
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:15', 'unique:tags,name,' . $id],
            'color' => ['required', 'color_hex'],
        ];
    }
}
