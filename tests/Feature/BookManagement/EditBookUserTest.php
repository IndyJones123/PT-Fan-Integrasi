<?php

namespace Tests\Feature;

use App\Models\Books;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class EditBookUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an authenticated user can update a book.
     *
     * @return void
     */
    public function test_user_can_update_book()
    {
        // Create a user and a book
        $user = User::factory()->create();
        $book = Books::factory()->create(['author_id' => $user->id]);
        
        // Authenticate the user
        $this->actingAs($user);

        // Make a PUT request to update the book
        $response = $this->put(route('books.update', $book->id), [
            'title' => 'Updated Book Title',
            'description' => 'Updated description.',
            'author_id' => $user->id,
            'rating' => 4,
            'thumbnail' => UploadedFile::fake()->image('updated_thumbnail.jpg'),
        ]);

        // Assert that the response status is 302 (redirect)
        $response->assertStatus(302);

        // Assert that the book was updated in the database
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'Updated Book Title',
            'description' => 'Updated description.',
            'rating' => 4,
        ]);
    }
}
