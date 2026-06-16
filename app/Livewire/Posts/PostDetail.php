<?php

namespace App\Livewire\Posts;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class PostDetail extends Component
{
    public ?array $post = null;

    #[On('post-selected')]
    public function showPost(array $post): void
    {
        $this->post = $post;
        $this->dispatch('modal-show', name: 'post-detail');
    }

    public function render(): View
    {
        return view('livewire.posts.post-detail');
    }
}
