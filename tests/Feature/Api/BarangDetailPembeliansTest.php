<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Barang;
use App\Models\DetailPembelian;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BarangDetailPembeliansTest extends TestCase
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
    public function it_gets_barang_detail_pembelians()
    {
        $barang = Barang::factory()->create();
        $detailPembelians = DetailPembelian::factory()
            ->count(2)
            ->create([
                'barang_id' => $barang->id,
            ]);

        $response = $this->getJson(
            route('api.barangs.detail-pembelians.index', $barang)
        );

        $response->assertOk()->assertSee($detailPembelians[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_barang_detail_pembelians()
    {
        $barang = Barang::factory()->create();
        $data = DetailPembelian::factory()
            ->make([
                'barang_id' => $barang->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.barangs.detail-pembelians.store', $barang),
            $data
        );

        $this->assertDatabaseHas('detail_pembelians', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $detailPembelian = DetailPembelian::latest('id')->first();

        $this->assertEquals($barang->id, $detailPembelian->barang_id);
    }
}
