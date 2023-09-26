<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Pemasok;
use App\Models\Pembelian;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PemasokPembeliansTest extends TestCase
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
    public function it_gets_pemasok_pembelians()
    {
        $pemasok = Pemasok::factory()->create();
        $pembelians = Pembelian::factory()
            ->count(2)
            ->create([
                'pemasok_id' => $pemasok->id,
            ]);

        $response = $this->getJson(
            route('api.pemasoks.pembelians.index', $pemasok)
        );

        $response->assertOk()->assertSee($pembelians[0]->kode_masuk);
    }

    /**
     * @test
     */
    public function it_stores_the_pemasok_pembelians()
    {
        $pemasok = Pemasok::factory()->create();
        $data = Pembelian::factory()
            ->make([
                'pemasok_id' => $pemasok->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.pemasoks.pembelians.store', $pemasok),
            $data
        );

        $this->assertDatabaseHas('pembelians', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $pembelian = Pembelian::latest('id')->first();

        $this->assertEquals($pemasok->id, $pembelian->pemasok_id);
    }
}
