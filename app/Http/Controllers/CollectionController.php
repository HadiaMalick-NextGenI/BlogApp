<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CollectionController extends Controller
{
    public function test(){

        //-----1-----
        //fetch all users with their blogs
        // $users = User::with('blogs')->get();

        //-----2-----
        //fetch only specific columns from both users and blogs
        // $users = User::with(['blogs' => function ($query) {
        //     $query->select('title', 'content', 'user_id');
        // }])->select('id', 'name')->get();

        //-----3-----
        //Fetch Users with Blogs, Only for Specific Users
        // $users = User::with('blogs')->where('age', '>', 11)->get();
        // $simplifiedData = $users->map(function ($user) {
        //     return [
        //         'name' => $user->name,
        //         //'blogs' => $user->blogs->pluck('title'), 
        //         'blogs' => $user->blogs->map(function ($blog) {
        //             return [
        //                 'title' => $blog->title,
        //                 'content' => $blog->content,
        //             ];
        //         }),
        //     ];
        // });
        // dd($simplifiedData);

        //-----4-----
        //Fetch Blogs with Author Information
        // $blogs = Blog::with('user')->get();
        // dd($blogs);

        //-----5-----
        //Fetch Users with the Count of Their Blogs
        //$users = User::withCount('blogs')->get();
        //dd($users->first()->blogs_count);

        // $simplifiedData = $users->map(function ($user) {
        //     return [
        //         'name' => $user->name,
        //         'blogs_count' => $user->blogs_count,
        //     ];
        // });
        // dd($simplifiedData);

        $blogs = Blog::whereTime('created_at', '>=', '07:00:00')->get();
        dd($blogs);
        
        //examples
        //dd('collection');
        //$items = collect(['one', 'two', 'three']);

        // $items = new Collection(['one', 'two', 'three']);
        // dd($items);
    }
}
