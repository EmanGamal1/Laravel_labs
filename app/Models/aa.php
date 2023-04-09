// store
    public function store(PostRequest $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png'
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/images', $imageName);
            $data['image'] = $imageName;
            $data['imagePath'] = $imagePath;
        }
        $post=Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'posted_by' => $data['posted_by'],
            'image' => $data['image'],
            'imagePath' => $data['imagePath'],
        ]);
        $slug = $post->slug;
        return redirect()->route('posts.index');
    }

    //Edit Form
    public function edit($id)
    {
        $users = User::all();
        $var = Post::find($id);
        $post = [
            'id' => $var->id,
            'title' => $var->title,
            'description' => $var->description,
            'posted_by' => $var->posted_by,
            'image' => $var->image,
            'imagePath' => $var->imagePath
        ];
        return view('posts.edit', ['post' => $post,'users' => $users]);
    }

    //Update
    public function update(PostRequest $request, $id)
{
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'image' => 'required|mimes:jpg,png'
    ]);
    $post = Post::findOrFail($id);
    if ($request->hasFile('image')) {
        $oldImagePath = $post->imagePath;
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName();
        $imagePath = $image->storeAs('public/images', $imageName);
        $post['image'] = $imageName;
        $post['imagePath'] = $imagePath;
        if ($oldImagePath && Storage::exists($oldImagePath)) {
            Storage::delete($oldImagePath);
        }
    }
    $post->update($request->all());
    return redirect()->route('posts.show', $post->id);
}

    //Delete
    public function destroy($id)
    {
            $postt = Post::find($id);
            $imagePath = $postt->imagePath;
            Storage::delete($imagePath);
            $post = Post::destroy($id);
            return redirect()->route('posts.index');
    }