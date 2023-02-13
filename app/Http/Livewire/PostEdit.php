<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class PostEdit extends Component
{
    use WithFileUploads;
    public Post $post;
    public $title;
    public $content;
    public $photo;
    public $tempUrl;
    protected $rules = [
        'title' => ['required', 'string', 'min:4', 'max:255'],
        'content' => ['required', 'string', 'min:4'],
        'photo' => ['nullable', 'image', 'max:5120'],
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
    }

    public function updatedPhoto()
    {
        try {
            $this->tempUrl = $this->photo->temporaryUrl();
        } catch (\Throwable $th) {
            $this->tempUrl = '';
        }
        $this->validate();
    }

    public function submitForm()
    {
        $data = $this->validate();

        if ($data['photo']) {
            $data['photo'] = 'storage/'.$this->photo->store('uploads/posts', 'public');
        } else {
            unset($data['photo']);
        }

        $this->post->update($data);
        session()->flash('post_updated', 'Post was updated!');
    }
    public function render()
    {
        return view('livewire.post-edit');
    }
}
