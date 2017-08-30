<?php

namespace Tests\Feature;

use Ntupla\Selector;
use Ntupla\User;
use Ntupla\Tuple;
use Tests\TestCase;
use Ntupla\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TuplesTest extends TestCase
{
    use RefreshDatabase;

    /**
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

        $this->actingAs($user)
            ->get('/')
            ->assertSee('Primer elemento')
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
            'selectable' => 1,
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
        $tuple = Tuple::first();
        $selector = Selector::first();
        $this->assertDatabaseHas('selector_tuple', [
            'tuple_id' => $tuple->id,
            'selector_id' => $selector->id
        ]);
    }

    /**
     * @test
     */
    public function userCanSearchSelectableTuples()
    {
        $category = factory(Category::class)->create([
            'predetermined' => 1,
        ]);

        $tuple = factory(Tuple::class)->create([
            'category_id' => $category->id,
            'message' => 'Un elemento seleccionable',
        ]);

        $tuple->selectableStore('my-select');

        $user = $tuple->user;

        $this->actingAs($user)
            ->get('/')
            ->assertSee('Un elemento seleccionable')
            ->assertSuccessful();
    }
}
