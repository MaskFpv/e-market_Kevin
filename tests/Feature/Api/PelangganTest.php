<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Pelanggan;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PelangganTest extends TestCase
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
    public function it_gets_pelanggans_list()
    {
        $pelanggans = Pelanggan::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.pelanggans.index'));

        $response->assertOk()->assertSee($pelanggans[0]->kode_pelanggan);
    }

    /**
     * @test
     */
    public function it_stores_the_pelanggan()
    {
        $data = Pelanggan::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.pelanggans.store'), $data);

        $this->assertDatabaseHas('pelanggans', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_pelanggan()
    {
        $pelanggan = Pelanggan::factory()->create();

        $data = [
            'kode_pelanggan' => $this->faker->text(255),
            'nama' => $this->faker->text(255),
            'alamat' => $this->faker->text(255),
            'no_telp' => $this->faker->text(255),
            'email' => $this->faker->email,
        ];

        $response = $this->putJson(
            route('api.pelanggans.update', $pelanggan),
            $data
        );

        $data['id'] = $pelanggan->id;

        $this->assertDatabaseHas('pelanggans', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_pelanggan()
    {
        $pelanggan = Pelanggan::factory()->create();

        $response = $this->deleteJson(
            route('api.pelanggans.destroy', $pelanggan)
        );

        $this->assertModelMissing($pelanggan);

        $response->assertNoContent();
    }
}
