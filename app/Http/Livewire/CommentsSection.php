<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

class CommentsSection extends Component
{
    public Post $post;
    public $comment;
    public $successMessage = false;

    public $rules = [
        'comment' => ['required', 'string', 'min:4']
    ];

    public function render()
    {
        return view('livewire.comments-section');
    }

    public function postComment()
    {
        $this->validate();

        Comment::create([
            'post_id' => $this->post->id,
            'username' => "guest",
            'content' => $this->comment,
        ]);

        $this->comment = '';
        $this->post->refresh();

        $this->successMessage = 'Comment was posted!';
    }
}
