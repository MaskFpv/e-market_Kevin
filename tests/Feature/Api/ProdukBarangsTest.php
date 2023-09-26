<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Produk;
use App\Models\Barang;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProdukBarangsTest extends TestCase
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
    public function it_gets_produk_barangs()
    {
        $produk = Produk::factory()->create();
        $barangs = Barang::factory()
            ->count(2)
            ->create([
                'produk_id' => $produk->id,
            ]);

        $response = $this->getJson(route('api.produks.barangs.index', $produk));

        $response->assertOk()->assertSee($barangs[0]->kode_barang);
    }

    /**
     * @test
     */
    public function it_stores_the_produk_barangs()
    {
        $produk = Produk::factory()->create();
        $data = Barang::factory()
            ->make([
                'produk_id' => $produk->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.produks.barangs.store', $produk),
            $data
        );

        $this->assertDatabaseHas('barangs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $barang = Barang::latest('id')->first();

        $this->assertEquals($produk->id, $barang->produk_id);
    }
}
