<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::get();

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
    public function store(TagRequest $request)
    {
        $data = $request->validated();

        if (Tag::create($data)) {
            return redirect(route('tags.index'))->with('flash', [
                'class' => 'success',
                'message' => "Tag $data[name] was created succesfully",
            ]);
        }

        return redirect(route('articles.index'))->with('flash', [
            'class' => 'danger',
            'message' => "Tag $data[name] was not created",
        ]);
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
    public function update(TagRequest $request, Tag $tag)
    {
        $data = $request->validated();
        $oldName = $tag->name;
        $newName = $data['name'];

        if ($tag->update($data)) {
            return redirect(route('tags.index'))->with('flash', [
                'class' => 'success',
                'message' => "Category $oldName was updated to $newName succesfully",
            ]);
        }

        return redirect(route('articles.index'))->with('flash', [
            'class' => 'warning',
            'message' => "Tag $oldName was not updated",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $name = $tag->name;
        $tag->delete();

        if (Tag::where('name', $name)->exists()) {
            return redirect(route('tags.index'))
                ->with('warning', [
                    'class' => 'warning',
                    'message' => "Tags $name was not deleted",
                ]);
        }

        return redirect(route('tags.index'))
            ->with('flash', [
                'class' => 'danger',
                'message' => "Tags $name was deleted",
            ]);
    }
}
