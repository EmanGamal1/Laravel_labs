<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        // $allPosts = Post::all(); //Select * from posts; ... return collection object
        $allPosts = Post::paginate(5);
        //dd($allPosts);
        return view('posts.index',[
            'posts' => $allPosts,
        ]);
    }

    public function show($id)
    {
        $post = Post::find($id); 
        // $comments = $post->comments;
        return view('posts.show',['post'=>$post]); //, compact('post', 'comments')
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create',[
            'users' => $users
        ]);
    }
    public function store(PostRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            // $imagePath = $image->storeAs('public/images', $imageName);
            $image->move('images', $imageName);
            $data['image'] = $imageName;
            $data['imagePath'] = $image;
        }
        else {
            $data['imagePath'] = '';
        }
        $post = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['user_id'],
            'image' => $data['image'],
            // 'imagePath' => $data['imagePath'],
        ]);
        $slug = $post->slug;
        return redirect()->route('posts.index');
    }
    public function destroy($id)
    {
        $post1 = Post::find($id);
        $imagePath = $post1->image;
        Storage::delete($imagePath);
        $post = Post::destroy($id);
        return back();
    }

    public function edit($id)
    {
        $users = User::all();
        $item = Post::find($id);
        $post = [
            'id' => $item->id,
            'title' => $item->title,
            'description' => $item->description,
            'user_id' => $item->user_id,
            'posted_by' => $item->posted_by,
            'image' => $item->image,
            'imagePath' => $item->imagePath
        ];
        return view('posts.edit', compact('post', 'users'));
    }
    public function update(PostRequest $request, $id)
    {
        $item = Post::find($id);
        $item ->title = $request->input('title');
        $item ->description = $request->input('description');
        $item ->user_id = $request->input('user_id');
        if ($request->hasFile('image')) {
            $oldImagePath = $item->imagePath;
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/images', $imageName);
            $item['image'] = $imageName;
            $item['imagePath'] = $imagePath;
            if ($oldImagePath && Storage::exists($oldImagePath)) {
                Storage::delete($oldImagePath);
            }
        }
        $item ->save();
        return redirect()->route('posts.index');
    }

    public function addComment($post_id){
        $post = Post::find($post_id);
        if($post){
            $post->comments()->create([
                'commentContent'=>request()->commentContent,
                'commentable_id'=>$post_id,
            ]);
        }
        return to_route('posts.show',['post'=>$post_id]);
    }
    public function DeleteComment($id)
    {
        $post = Comment::find($id);
        $post->destroy($id);
        return redirect()->back();
    }

    public function EditComment($id)
    {
        $data = Comment::find($id);
        $comment = [
            'id' => $data->id,
            'commentContent' => $data->commentContent,
            'commentable_id'=>$data->commentable_id,
            'commentable_type'=>$data->commentable_type,
        ];
        return view('comments.edit', ['comment' => $comment]);
    }

    //Update
    public function updateComment(Request $request, $id)
    {
        $data = Comment::find($id);
        $data ->commentContent = $request->input('commentContent');
        $data ->save();
        return redirect()->route('posts.index');
    }
    
}
