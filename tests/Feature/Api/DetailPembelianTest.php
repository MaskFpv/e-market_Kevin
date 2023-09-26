<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\DetailPembelian;

use App\Models\Barang;
use App\Models\Pembelian;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DetailPembelianTest extends TestCase
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
    public function it_gets_detail_pembelians_list()
    {
        $detailPembelians = DetailPembelian::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.detail-pembelians.index'));

        $response->assertOk()->assertSee($detailPembelians[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_detail_pembelian()
    {
        $data = DetailPembelian::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.detail-pembelians.store'),
            $data
        );

        $this->assertDatabaseHas('detail_pembelians', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_detail_pembelian()
    {
        $detailPembelian = DetailPembelian::factory()->create();

        $barang = Barang::factory()->create();
        $pembelian = Pembelian::factory()->create();

        $data = [
            'harga_beli' => $this->faker->randomNumber(2),
            'jumlah' => $this->faker->randomNumber(0),
            'sub_total' => $this->faker->randomNumber(2),
            'barang_id' => $barang->id,
            'pembelian_id' => $pembelian->id,
        ];

        $response = $this->putJson(
            route('api.detail-pembelians.update', $detailPembelian),
            $data
        );

        $data['id'] = $detailPembelian->id;

        $this->assertDatabaseHas('detail_pembelians', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_detail_pembelian()
    {
        $detailPembelian = DetailPembelian::factory()->create();

        $response = $this->deleteJson(
            route('api.detail-pembelians.destroy', $detailPembelian)
        );

        $this->assertModelMissing($detailPembelian);

        $response->assertNoContent();
    }
}
