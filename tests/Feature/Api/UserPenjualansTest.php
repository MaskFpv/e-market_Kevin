<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Penjualan;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserPenjualansTest extends TestCase
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
    public function it_gets_user_penjualans()
    {
        $user = User::factory()->create();
        $penjualans = Penjualan::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.penjualans.index', $user));

        $response->assertOk()->assertSee($penjualans[0]->no_faktur);
    }

    /**
     * @test
     */
    public function it_stores_the_user_penjualans()
    {
        $user = User::factory()->create();
        $data = Penjualan::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.penjualans.store', $user),
            $data
        );

        unset($data['no_faktur']);
        unset($data['tgl_faktur']);
        unset($data['total_bayar']);
        unset($data['pelanggan_id']);
        unset($data['user_id']);

        $this->assertDatabaseHas('penjualans', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $penjualan = Penjualan::latest('id')->first();

        $this->assertEquals($user->id, $penjualan->user_id);
    }
}
