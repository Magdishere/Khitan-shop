<?php

namespace App\Http\Livewire\Admin;

use App\Models\Posts;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\User;
class AdminAddBlogPost extends Component
{

    use WithFileUploads;

    public $title;
    public $slug;
    public $description;
    public $image_path;

    public function generateSlug(){

        $this->slug = Str::slug($this->title);

    }

    public function addPost(){

        $this->validate([

            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'image_path' => 'required|mimes:jpg,png,jpeg|max:5048',
        ]);

        $post = new Posts();
        $post->title = $this->title;
        $post->slug = $this->slug;
        $post->description = $this->description;
        $imageName = Carbon::now()->timestamp.'.' .$this->image_path->extension();
        $this->image_path->storeAs('blog', $imageName);
        $post->image_path = $imageName;
        $post->user_id = auth()->user()->id;

        $post->save();
        session()->flash('message', 'Post Added Successfully');



    }
    public function render()
    {

        return view('livewire.admin.admin-add-blog-post');
    }
}
