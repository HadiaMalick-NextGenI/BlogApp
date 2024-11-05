<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BlogPublished;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $filter = $request->get('filter', 'published');

        Debugbar::startMeasure('render', 'Time for rendering');
        $user = Auth::user(); 
        $blogs = $user->blogs()->filterByStatus($filter)->get();
        $view = view('blogs.index', compact('blogs', 'filter'));
        //$blogs = Blog::query()->filterByStatus($filter)->get();

        // $filter === 'draft' ? $blogs = Blog::where('status', 'draft')->get() :  
        //     $blogs = Blog::where('status', 'published')->get();
        
        Debugbar::stopMeasure('render');
       
        return $view;
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
            $blog = Blog::create([
                'title' => $request->title,
                'content' => $request->content,
                'status' => $request->status,
                'user_id' =>  Auth::user()->id
            ]);

            if($request->status === 'published'){
                Notification::send(Auth::user(), new BlogPublished($blog));
            }

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
        if (!Auth::user()->hasRole('admin') && !Auth::user()->hasRole('editor') && $blog->user_id !== Auth::id()) {
            //Log::error('User is forbidden');
            Log::channel('custom')
                ->error('This is a message for the custom log channel formatted.');
                
            abort(403); 
        }
        Debugbar::info('Slug: '.$blog->slug);
        
        return view('blogs.view', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id)
    {
        try{
            $blog = Blog::findById($id);

            $blog->update([
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'status' => $blog->status 
            ]);

            return redirect()->route('blogs.index')->with('success', 'Blog post updated successfully.');
        } catch (\Exception $e){
            return back()->withInput()->withErrors(['error' => 'An error occurred while updating the blog: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        try{
            $blog->delete();
            return redirect()->route('blogs.index')->with('success', 'Blog post deleted successfully.');
        } catch(\Exception $e){
            return back()->withInput()->withErrors(['error' => 'An error occurred while deleting the blog: ' . $e->getMessage()]);
        }
    }
}
