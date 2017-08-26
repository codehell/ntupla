<?php

namespace Tests\Feature;

use Ntupla\Tuple;
use Ntupla\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TuplesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     * @test
     */
    public function userCanViewTuples()
    {
        $tuple = factory(Tuple::class)->create([
            'message' => 'Primer elemento'
        ]);
        $user = $tuple->user;
        $tuples = Tuple::all();
        $this->actingAs($user)
            ->get('/', [
            ])->assertViewHas('tuples', $tuples);
    }

    /**
     * @return void
     * @test
     */
    public function userCanPublblishATuple()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->post('/', [
                'selector' => 'new',
                'message' => 'Este es mi primer elemento.'
            ])->assertStatus(200);
    }
}
