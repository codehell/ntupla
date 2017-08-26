<?php

namespace Tests\Feature;

use Ntupla\User;
use Ntupla\Tuple;
use Tests\TestCase;
use Ntupla\Category;
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
        $category = factory(Category::class)->create();
        $this->actingAs($user)
            ->post('/', [
                'category' => $category->id,
                'selectors' => 'my-selector',
                'message' => 'Este es mi primer elemento.'
            ])->assertStatus(302);

        $this->assertDatabaseHas('tuples', [
            'user_id' => $user->id,
            'category_id' => $category->id,
            'message' => 'Este es mi primer elemento.'
        ]);

        $this->assertDatabaseHas('selectors', [
            'selector' => 'my-selector'
        ]);
    }
}
