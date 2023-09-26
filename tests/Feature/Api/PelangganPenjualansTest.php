<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Pelanggan;
use App\Models\Penjualan;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PelangganPenjualansTest extends TestCase
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
    public function it_gets_pelanggan_penjualans()
    {
        $pelanggan = Pelanggan::factory()->create();
        $penjualans = Penjualan::factory()
            ->count(2)
            ->create([
                'pelanggan_id' => $pelanggan->id,
            ]);

        $response = $this->getJson(
            route('api.pelanggans.penjualans.index', $pelanggan)
        );

        $response->assertOk()->assertSee($penjualans[0]->no_faktur);
    }

    /**
     * @test
     */
    public function it_stores_the_pelanggan_penjualans()
    {
        $pelanggan = Pelanggan::factory()->create();
        $data = Penjualan::factory()
            ->make([
                'pelanggan_id' => $pelanggan->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.pelanggans.penjualans.store', $pelanggan),
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

        $this->assertEquals($pelanggan->id, $penjualan->pelanggan_id);
    }
}
