<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Books;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteBookUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_delete_book()
    {
        $user = User::factory()->create();
        $book = Books::factory()->create(['author_id' => $user->id]);
        $this->actingAs($user);

        $response = $this->delete(route('books.destroy', $book->id));

        $response->assertStatus(302); // Expecting a redirect after deletion
        $this->assertDatabaseMissing('books', [
            'id' => $book->id,
        ]);
    }
}
