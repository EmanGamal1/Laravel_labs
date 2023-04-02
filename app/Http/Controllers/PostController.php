<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function test()
    {
        $books = ['book1', 'book2'];
        return view('test', [
                'books' => $books,
                'name' => 'Eman'
            ]
        );
    }

    public function index()
    {
        $allPosts = [
            [
                'id' => 1,
                'title' => 'HTML',
                'description' => 'hello laravel',
                'posted_by' => 'Eman',
                'created_at' => '2023-04-01 10:00:00',
            ],

            [
                'id' => 2,
                'title' => 'CSS',
                'description' => 'hello php',
                'posted_by' => 'Rana',
                'created_at' => '2023-04-01 10:00:00',
            ],

            [
                'id' => 3,
                'title' => 'Javascript',
                'description' => 'hello javascript',
                'posted_by' => 'Mai',
                'created_at' => '2023-04-01 10:00:00',
            ],
        ];

        return view('posts.index',[
            'posts' => $allPosts,
        ]);
    }

    public function show($id)
    {
        $post = [
            'id' => 3,
            'title' => 'Javascript',
            'description' => 'hello javascript',
            'posted_by' => 'Mai',
            'created_at' => '2023-04-01 10:00:00',
        ];

        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        return view('posts.create');
    }
    public function store()
    {
        return redirect()->route('posts.index');
    }
    public function destroy($post)
    {
        return redirect()->route('posts.index');
    }
    public function edit($id)
    {
        $post = [
            'id' => 3,
            'title' => 'Javascript',
            'description' => 'Hello Javascript',
            'posted_by' => 'Alaa',
            'created_at' => '2023-04-01 10:00:00',
        ];
        return view('posts.edit', ['post' => $post]);
    }
    public function update(Request $request, $id)
    {
        return redirect()->route('posts.index');
    }
}
