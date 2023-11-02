<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CategoryRequest $request)
    {
        $name = $request->validated()['name'];

        if (Category::create($request->validated())) {
            return redirect(route('categories.index'))
                ->with('flash', [
                    'class' => 'success',
                    'message' => "Category $name was created succesfully",
                ]);
        }

        return redirect(route('categories.index'))
            ->with('flash', [
                'class' => 'danger',
                'message' => "Category $name was not created",
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        $oldName = $category->name;
        $newName = $data['name'];

        if ($category->update($data)) {
            return redirect(route('categories.index'))
                ->with('flash', [
                    'class' => 'success',
                    'message' => "Category $oldName was updated to $newName succesfully",
                ]);
        }

        return redirect(route('categories.index'))
            ->with('flash', [
                'class' => 'danger',
                'message' => "Category $oldName was not updated",
            ]);
    }

    public function destroy(Category $category)
    {
        $name = $category->name;
        $category->delete();

        if (Category::where('name', $name)->exists()) {
            return redirect(route('categories.index'))
                ->with('flash', [
                    'class' => 'warning',
                    'message' => "Category $name was not deleted",
                ]);
        }

        return redirect(route('categories.index'))
            ->with('flash', [
                'class' => 'danger',
                'message' => "Category $name deleted",
            ]);
    }
}
