<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;

use App\Models\Posts;
use App\Models\Comments;
use App\Models\User;

// note: use true and false for active posts in postgresql database
// '0' and '1' are used here for active posts because of mysql database

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //fetch 5 posts from database which are active and latest
        $posts = Posts::where('active', '1')->orderBy('created_at', 'desc')->paginate(5);

        // page heading
        $title = 'Latest FoodShares';

        // return home.blade.php template from resources/views
        return view('home')->with('posts', $posts)->with('title', $title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        //
        if ($request->user()->can_post()) {
            return view('posts.create');
        } else {
            return redirect('/')->withErrors('You have no sufficient permissions for writing a FoodShare.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(PostFormRequest $request)
    {
        $post = new Posts();
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->slug = Str::slug($post->title);

        $duplicate = Posts::where('slug', $post->slug)->first();
        if ($duplicate) {
            return redirect('new-post')->withErrors('Title already exists.')->withInput();
        }

        if ($request->hasFile('image')) {
            $file = request('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('posts/imgs', $filename);
            $post->image = $filename;
        } else {
            $post->image = '';
        }

        $post->author_id = $request->user()->id;
        if ($request->has('save')) {
            $post->active = 0;
            $message = 'FoodShare saved successfully';
        } else {
            $post->active = 1;
            $message = 'FoodShare published successfully';
        }
        $post->save();
        return redirect('edit/' . $post->slug)->withMessage($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($slug)
    {
        $post = Posts::where('slug', $slug)->first();

        if ($post) {
            if ($post->active == false)
                return redirect('/')->withErrors('requested page not found');
            $comments = $post->comments;
        } else {
            return redirect('/')->withErrors('requested page not found');
        }
        return view('posts.show')->with('post', $post)->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $slug)
    {
        $post = Posts::where('slug', $slug)->first();
        if ($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
            return view('posts.edit')->with('post', $post);
        else {
            return redirect('/')->withErrors('you have no sufficient permissions');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        //
        $post_id = $request->input('post_id');
        $post = Posts::find($post_id);
        if ($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
            $title = $request->input('title');
            $slug = Str::slug($title);
            $duplicate = Posts::where('slug', $slug)->first();
            if ($duplicate) {
                if ($duplicate->id != $post_id) {
                    return redirect('edit/' . $post->slug)->withErrors('FoodShare Title already exists.')->withInput();
                } else {
                    $post->slug = $slug;
                }
            }


            $post->title = $title;
            $post->body = $request->input('body');

            if ($flag = $request->hasFile('image')) {
                $file = request('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move('posts/imgs', $filename);
                $post->image = $filename;
            }
            //  else {
            //     // $post->image = "";
            //     $post->image = $request->input('image');
            // }
            // dd($post);


            if ($request->has('save')) {
                $post->active = 0;
                $message = 'FoodShare saved successfully';
                $landing = 'edit/' . $post->slug;
            } else {
                $post->active = 1;
                $message = 'FoodShare updated successfully';
                $landing = $post->slug;
            }
            $post->save();
            return redirect($landing)->withMessage($message);
        } else {
            return redirect('/')->withErrors('you have no sufficient permissions');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        //
        $post = Posts::find($id);
        if ($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
            $post->delete();
            $data['message'] = 'FoodShare deleted Successfully';
        } else {
            $data['errors'] = 'Invalid Operation. You have no sufficient permissions';
        }

        return redirect('/')->with($data);
    }
}
