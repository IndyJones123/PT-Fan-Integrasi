<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Books;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteBookGuesTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_guest_cannot_delete_book()
    {
        $book = Books::factory()->create();

        $response = $this->delete(route('books.destroy', $book->id));

        $response->assertStatus(302); // Expecting a redirect to the login page or forbidden status
        $response->assertRedirect('/login'); // Adjust if you use a different login path

        // Verify that the book still exists in the database
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
        ]);
    }
}
