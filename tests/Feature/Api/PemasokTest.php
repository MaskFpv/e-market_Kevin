<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Pemasok;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PemasokTest extends TestCase
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
    public function it_gets_pemasoks_list()
    {
        $pemasoks = Pemasok::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.pemasoks.index'));

        $response->assertOk()->assertSee($pemasoks[0]->nama_pemasok);
    }

    /**
     * @test
     */
    public function it_stores_the_pemasok()
    {
        $data = Pemasok::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.pemasoks.store'), $data);

        $this->assertDatabaseHas('pemasoks', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_pemasok()
    {
        $pemasok = Pemasok::factory()->create();

        $data = [
            'nama_pemasok' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.pemasoks.update', $pemasok),
            $data
        );

        $data['id'] = $pemasok->id;

        $this->assertDatabaseHas('pemasoks', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_pemasok()
    {
        $pemasok = Pemasok::factory()->create();

        $response = $this->deleteJson(route('api.pemasoks.destroy', $pemasok));

        $this->assertModelMissing($pemasok);

        $response->assertNoContent();
    }
}
