<?php

namespace App\Http\Livewire\Admin;

use App\Models\Posts;
use Livewire\Component;
use Livewire\WithPagination;



class AdminPostsComponent extends Component
{
    use WithPagination;

    public $post_id;

    public function deletePost(){

        $post = Posts::find($this->post_id);
        unlink('assets/imgs/blog/' . $post->image_path);
        $post->delete();
        session()->flash('message', 'Product deleted successfully');
    }

    public function render()
    {
        $posts = Posts::orderBy('created_at', 'DESC')->paginate();
        return view('livewire.admin.admin-posts-component',['posts' => $posts]);
    }
}
