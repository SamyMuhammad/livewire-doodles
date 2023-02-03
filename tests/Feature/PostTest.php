<?php

namespace Tests\Feature;

use App\Http\Livewire\CommentsSection;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * @test
     */
    public function post_data_exists()
    {
        $post = Post::factory()->create();
        $this->get(route('post.show', $post->id))
            ->assertSee($post->title)
            ->assertSee($post->content);

        $this->assertTrue(Storage::disk('public')->exists('/uploads/posts/' . $post->image));
    }

    /**
     * @test
     */
    public function comments_section_livewire_component_exists()
    {
        $post = Post::factory()->create();
        $this->get(route('post.show', $post->id))
            ->assertSeeLivewire('comments-section');
    }

    /**
     * @test
     */
    public function valid_comment_added_successfully()
    {
        $post = Post::factory()->create();
        Livewire::test(CommentsSection::class, ['post' => $post])
            ->set('comment', "This Is A Comment from a test Function")
            ->call('postComment')
            ->assertSee('Comment was posted!')
            ->assertSee('This Is A Comment from a test Function');
    }

    /**
     * @test
     */
    public function comment_validation_works_correctly()
    {
        $post = Post::factory()->create();
        Livewire::test(CommentsSection::class, ['post' => $post])
            ->call('postComment')
            ->assertHasErrors(['comment' => ['required']])
            ->assertSee(__('validation.required', ['attribute' => 'comment']))
            ->set('comment', "Th")
            ->call('postComment')
            ->assertHasErrors(['comment' => ['min']])
            ->assertSee(__('validation.min.string', ['attribute' => 'comment', 'min' => 4]));
    }
}
