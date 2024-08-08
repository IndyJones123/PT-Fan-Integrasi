<?php

namespace Tests\Feature;

use App\Models\Books;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;


class EditBookGuesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_guest_cannot_update_book()
    {
        $book = Books::factory()->create();

        $response = $this->put(route('books.update', $book->id), [
            'title' => 'Updated Book Title',
            'description' => 'Updated description.',
            'author_id' => $book->author_id, // Shouldn't be relevant for guests
            'rating' => 4,
            'thumbnail' => UploadedFile::fake()->image('updated_thumbnail.jpg'),
        ]);

        $response->assertStatus(302); // Expecting a redirect to the login page or forbidden status
        $response->assertRedirect('/login'); // Adjust if you use a different login path
    }
}
