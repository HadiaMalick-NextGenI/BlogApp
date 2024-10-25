<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $filter = $request->get('filter', 'published');

        $user = Auth::user(); 
        $blogs = $user->blogs()->filterByStatus($filter)->get();

        //$blogs = Blog::query()->filterByStatus($filter)->get();

        $error = session('error');

        // $filter === 'draft' ? $blogs = Blog::where('status', 'draft')->get() :  
        //     $blogs = Blog::where('status', 'published')->get();
       
        return view('blogs.index', compact('blogs', 'filter', 'error'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        try {
            Blog::create([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'user_id' =>  Auth::user()->id
            ]);

            return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['error' => 'An error occurred while creating the blog: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        if ($blog->user_id !== Auth::id()) {
            abort(403); 
        }
        //$blog = Blog::findById($id);
        //$blog = User::find($blog->id)->blog;
        return view('blogs.view', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //$blog = Blog::findById($id);
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id)
    {
        $blog = Blog::findById($id);

        $blog->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'status' => $blog->status 
        ]);

        // $blog->title = $request->input('title');
        // $blog->content = $request->input('content');
        // $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //$blog = Blog::findById($id);

        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
