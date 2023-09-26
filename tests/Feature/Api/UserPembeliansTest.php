<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Pembelian;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserPembeliansTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_user_pembelians()
    {
        $user = User::factory()->create();
        $pembelians = Pembelian::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.pembelians.index', $user));

        $response->assertOk()->assertSee($pembelians[0]->kode_masuk);
    }

    /**
     * @test
     */
    public function it_stores_the_user_pembelians()
    {
        $user = User::factory()->create();
        $data = Pembelian::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.pembelians.store', $user),
            $data
        );

        $this->assertDatabaseHas('pembelians', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $pembelian = Pembelian::latest('id')->first();

        $this->assertEquals($user->id, $pembelian->user_id);
    }
}
