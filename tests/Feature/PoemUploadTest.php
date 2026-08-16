<?php

namespace Tests\Feature;

use App\Models\Poem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PoemUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_poem_with_uploaded_cover_image(): void
    {
        Storage::fake('public');

        $admin = User::factory()->create([
            'role'              => 'admin',
            'email_verified_at' => now(),
        ]);

        $response = $this->actingAs($admin)->post('/admin/poems', [
            'user_id'           => $admin->id,
            'title'             => 'Test Poem Upload',
            'excerpt'           => 'A teaser line for the card.',
            'body'              => 'Some body text that is long enough to pass the validation rule. Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'status'            => 'published',
            'is_featured'       => true,
            'cover_image_file'  => UploadedFile::fake()->createWithContent(
                'cover.jpg',
                file_get_contents(public_path('assets/images/couple.jpg')),
                'image/jpeg'
            ),
        ]);

        $response->assertRedirect(route('admin.poems.index'));

        $poem = Poem::where('title', 'Test Poem Upload')->first();

        $this->assertNotNull($poem);
        $this->assertStringStartsWith('poems/', $poem->cover_image);
        $this->assertTrue($poem->is_featured);
        Storage::disk('public')->assertExists($poem->cover_image);

        // public detail page must render the uploaded image URL
        $page = $this->get('/poems/' . $poem->slug);
        $page->assertOk();
        $page->assertSee('storage/' . $poem->cover_image, false);

        // admin form pages render the upload input
        $this->get('/admin/poems/create')->assertOk()->assertSee('cover_image_file');
        $this->get('/admin/poems/' . $poem->id . '/edit')->assertOk()->assertSee('cover_image_file');
    }
}