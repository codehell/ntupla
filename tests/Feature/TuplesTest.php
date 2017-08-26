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
        $category = factory(Category::class)->create([
            'predetermined' => 1,
        ]);
        $tuple = factory(Tuple::class)->create([
            'category_id' => $category->id,
            'message' => 'Primer elemento',
        ]);
        factory(Tuple::class)->create([
            'message' => 'Segundo elemento',
        ]);
        $user = $tuple->user;
        $tuples = $category->tuples;
        $this->actingAs($user)
            ->get('/')
            ->assertViewHas('tuples', $tuples)
            ->assertSuccessful();
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
                'selectors' => 'my-selector my-second-selector',
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

        $this->assertDatabaseHas('selectors', [
            'selector' => 'my-second-selector'
        ]);
    }
}
