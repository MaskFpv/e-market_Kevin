<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Barang;
use App\Models\DetailPenjualan;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BarangDetailPenjualansTest extends TestCase
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
    public function it_gets_barang_detail_penjualans()
    {
        $barang = Barang::factory()->create();
        $detailPenjualans = DetailPenjualan::factory()
            ->count(2)
            ->create([
                'barang_id' => $barang->id,
            ]);

        $response = $this->getJson(
            route('api.barangs.detail-penjualans.index', $barang)
        );

        $response->assertOk()->assertSee($detailPenjualans[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_barang_detail_penjualans()
    {
        $barang = Barang::factory()->create();
        $data = DetailPenjualan::factory()
            ->make([
                'barang_id' => $barang->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.barangs.detail-penjualans.store', $barang),
            $data
        );

        unset($data['barang_id']);
        unset($data['penjualan_id']);
        unset($data['harga_jual']);
        unset($data['jumlah']);
        unset($data['sub_total']);

        $this->assertDatabaseHas('detail_penjualans', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $detailPenjualan = DetailPenjualan::latest('id')->first();

        $this->assertEquals($barang->id, $detailPenjualan->barang_id);
    }
}
