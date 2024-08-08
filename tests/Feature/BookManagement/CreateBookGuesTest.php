<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\Books;
use App\Models\User;

class CreateBookGuesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_guest_cannot_create_book()
    {
        $response = $this->post(route('books.store'), [
            'title' => 'New Book Title',
            'description' => 'This is a book description.',
            'author_id' => 1, // This is arbitrary as guests should not be able to create books
            'rating' => 5,
            'thumbnail' => UploadedFile::fake()->image('thumbnail.jpg'),
        ]);

        $response->assertStatus(302); // Expecting a redirect to the login page or forbidden status
        $response->assertRedirect('/login'); // Adjust if you use a different login path
    }
}
