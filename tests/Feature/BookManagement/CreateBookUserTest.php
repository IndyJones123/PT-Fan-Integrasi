<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\Books;
use App\Models\User;

class CreateBookUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_book()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->post(route('books.store'), [ // Make sure the route name matches
            'title' => 'New Book Title',
            'description' => 'This is a book description.',
            'author_id' => $user->id,
            'rating' => 5,
            'thumbnail' => UploadedFile::fake()->image('thumbnail.jpg'), // Use a fake image
        ]);

        $response->assertStatus(302); // Expecting a redirect after creation
        $this->assertDatabaseHas('books', [
            'title' => 'New Book Title',
        ]);
    }
}
