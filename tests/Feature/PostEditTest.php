<?php

namespace Tests\Feature;

use App\Http\Livewire\PostEdit;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class PostEditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function post_edit_page_contains_post_edit_livewire_component()
    {
        $post = Post::factory()->create();

        $this->get(route('post.edit', $post))
            ->assertSeeLivewire('post-edit');
    }

    /** @test */
    public function post_edit_form_works()
    {
        $post = Post::factory()->create();

        $this->get(route('post.edit', $post));

        Livewire::test(PostEdit::class, ['post' => $post])
            ->set('title', 'Title After Update')
            ->set('content', 'Content After Update')
            ->call('submitForm')
            ->assertSee('Post was updated!');

        $post->refresh();

        $this->assertEquals($post->title, 'Title After Update');
        $this->assertEquals($post->content, 'Content After Update');
    }

    /** @test */
    public function post_edit_form_with_photo_upload_works_with_images()
    {
        $post = Post::factory()->create();
        Storage::fake('public');
        $photo = UploadedFile::fake()->image('photo.jpg');

        $this->get(route('post.edit', $post));

        Livewire::test(PostEdit::class, ['post' => $post])
            ->set('title', 'Title After Update')
            ->set('content', 'Content After Update')
            ->set('photo', $photo)
            ->call('submitForm')
            ->assertSee('Post was updated!');

        $post->refresh();

        Storage::disk('public')->assertExists(str_replace('storage/', '', $post->photo));
    }

    /** @test */
    public function post_edit_form_with_photo_upload_not_working_with_no_images()
    {
        $post = Post::factory()->create(['photo' => null]);
        Storage::fake('public');
        $doc = UploadedFile::fake()->create('doc.pdf', 1024);

        $this->get(route('post.edit', $post));

        Livewire::test(PostEdit::class, ['post' => $post])
            ->set('title', 'Title After Update')
            ->set('content', 'Content After Update')
            ->set('photo', $doc)
            ->call('submitForm')
            ->assertDontSee('Post was updated!')
            ->assertHasErrors(['photo' => 'image']);

        $post->refresh();

        $this->assertNull($post->photo);
        // Storage::disk('public')->assertMissing($post->photo);
    }
}
