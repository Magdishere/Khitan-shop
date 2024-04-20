<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\Posts;

class AdminEditPostsComponent extends Component
{

    use WithFileUploads;

    public $title;
    public $slug;
    public $description;
    public $image_path;
    public $post_id;
    public $newImage;

    public function mount($post_id){

        $post = Posts::find($post_id);
        $this->title = $post->title;
        $this->slug = $post->slug;
        $this->description = $post->description;
        $this->image_path = $post->image_path;
        $this->post_id = $post->id;

    }

    public function updatePost(){

        $this->validate([

            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',

        ]);

        $post = Posts::find($this->post_id);

        $post->title = $this->title;
        $post->slug = $this->slug;
        $post->description = $this->description;

        if($this->newImage){
            unlink('assets/imgs/blog/'. $post->image_path);
            $imageName = Carbon::now()->timestamp . '.' . $this->newImage->extension();
            $this->newImage->storeAs('blog', $imageName);
            $post->image_path = $imageName;
        }

        $post->save();
        session()->flash('message', 'post updated successfully');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-posts-component');
    }
}
