<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Barang;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserBarangsTest extends TestCase
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
    public function it_gets_user_barangs()
    {
        $user = User::factory()->create();
        $barangs = Barang::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.barangs.index', $user));

        $response->assertOk()->assertSee($barangs[0]->kode_barang);
    }

    /**
     * @test
     */
    public function it_stores_the_user_barangs()
    {
        $user = User::factory()->create();
        $data = Barang::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.barangs.store', $user),
            $data
        );

        $this->assertDatabaseHas('barangs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $barang = Barang::latest('id')->first();

        $this->assertEquals($user->id, $barang->user_id);
    }
}
