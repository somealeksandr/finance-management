<?php

namespace Tests\Feature;

use App\Enums\TransactionType;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TransactionApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function it_creates_a_transaction(): void
    {
        $data = [
            'user_id' => $this->user->id,
            'amount' => 100,
            'type' => TransactionType::DEPOSIT,
            'description' => 'Test deposit',
        ];

        $response = $this->postJson('/api/transactions', $data);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'user' => [
                        'id' => $this->user->id,
                        'name' => $this->user->name,
                    ],
                    'amount' => 100,
                    'type' => 'deposit',
                    'description' => 'Test deposit',
                ]
            ]);

        $this->assertDatabaseHas('transactions', $data);
    }

    /** @test */
    public function it_retrieves_transactions_with_filters()
    {
        Transaction::factory()->count(5)->create(['user_id' => $this->user->id, 'type' => TransactionType::DEPOSIT]);
        Transaction::factory()->count(5)->create(['user_id' => $this->user->id, 'type' => TransactionType::WITHDRAWAL]);

        $response = $this->getJson('/api/transactions?type=deposit');

        $response->assertStatus(200)
            ->assertJsonCount(5, 'data');
    }

    /** @test */
    public function it_retrieves_user_balance()
    {
        Transaction::factory()->create([
            'user_id' => $this->user->id,
            'amount' => 200,
            'type' => TransactionType::DEPOSIT,
        ]);

        Transaction::factory()->create([
            'user_id' => $this->user->id,
            'amount' => 50,
            'type' => TransactionType::WITHDRAWAL,
        ]);

        $response = $this->getJson("/api/users/{$this->user->id}/balance");

        $response->assertStatus(200)
            ->assertJson([
                'balance' => 150,
            ]);
    }
}
