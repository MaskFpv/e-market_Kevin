<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Pembelian;

use App\Models\Pemasok;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PembelianTest extends TestCase
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
    public function it_gets_pembelians_list()
    {
        $pembelians = Pembelian::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.pembelians.index'));

        $response->assertOk()->assertSee($pembelians[0]->kode_masuk);
    }

    /**
     * @test
     */
    public function it_stores_the_pembelian()
    {
        $data = Pembelian::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.pembelians.store'), $data);

        $this->assertDatabaseHas('pembelians', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_pembelian()
    {
        $pembelian = Pembelian::factory()->create();

        $user = User::factory()->create();
        $pemasok = Pemasok::factory()->create();

        $data = [
            'kode_masuk' => $this->faker->text(255),
            'tanggal_masuk' => $this->faker->date,
            'total' => $this->faker->randomNumber(2),
            'user_id' => $user->id,
            'pemasok_id' => $pemasok->id,
        ];

        $response = $this->putJson(
            route('api.pembelians.update', $pembelian),
            $data
        );

        $data['id'] = $pembelian->id;

        $this->assertDatabaseHas('pembelians', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_pembelian()
    {
        $pembelian = Pembelian::factory()->create();

        $response = $this->deleteJson(
            route('api.pembelians.destroy', $pembelian)
        );

        $this->assertModelMissing($pembelian);

        $response->assertNoContent();
    }
}
