<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostShow extends Component
{
    public $post;
    public function mount($post)
    {
        $this->post = Post::query()->find($post);
    }
    public function render()
    {
        return view('livewire.post-show')->extends('layouts.app');
    }

    public function getTotalPostsProperty()
    {
        return Post::query()->count();
    }
}
