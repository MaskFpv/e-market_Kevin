<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Produk;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProdukTest extends TestCase
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
    public function it_gets_produks_list()
    {
        $produks = Produk::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.produks.index'));

        $response->assertOk()->assertSee($produks[0]->nama_produk);
    }

    /**
     * @test
     */
    public function it_stores_the_produk()
    {
        $data = Produk::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.produks.store'), $data);

        $this->assertDatabaseHas('produks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_produk()
    {
        $produk = Produk::factory()->create();

        $data = [
            'nama_produk' => $this->faker->text(255),
        ];

        $response = $this->putJson(route('api.produks.update', $produk), $data);

        $data['id'] = $produk->id;

        $this->assertDatabaseHas('produks', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_produk()
    {
        $produk = Produk::factory()->create();

        $response = $this->deleteJson(route('api.produks.destroy', $produk));

        $this->assertModelMissing($produk);

        $response->assertNoContent();
    }
}
