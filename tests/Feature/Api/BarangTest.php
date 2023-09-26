<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Barang;

use App\Models\Produk;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BarangTest extends TestCase
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
    public function it_gets_barangs_list()
    {
        $barangs = Barang::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.barangs.index'));

        $response->assertOk()->assertSee($barangs[0]->kode_barang);
    }

    /**
     * @test
     */
    public function it_stores_the_barang()
    {
        $data = Barang::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.barangs.store'), $data);

        $this->assertDatabaseHas('barangs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_barang()
    {
        $barang = Barang::factory()->create();

        $user = User::factory()->create();
        $produk = Produk::factory()->create();

        $data = [
            'kode_barang' => $this->faker->text(255),
            'nama_barang' => $this->faker->text(255),
            'satuan' => $this->faker->text(255),
            'harga_jual' => $this->faker->randomNumber(2),
            'stock' => $this->faker->text(255),
            'ditarik' => $this->faker->randomNumber(0),
            'user_id' => $user->id,
            'produk_id' => $produk->id,
        ];

        $response = $this->putJson(route('api.barangs.update', $barang), $data);

        $data['id'] = $barang->id;

        $this->assertDatabaseHas('barangs', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_barang()
    {
        $barang = Barang::factory()->create();

        $response = $this->deleteJson(route('api.barangs.destroy', $barang));

        $this->assertModelMissing($barang);

        $response->assertNoContent();
    }
}
