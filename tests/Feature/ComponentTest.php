<?php

namespace Tests\Feature;

use App\User;
use App\Component;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ComponentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_component_has_attributes()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();

        $summary = "First Component";
        $component = $this->create(Component::class, [
            'user_id' => $user->id,
            'summary' => $summary,
            'description' => 'Showing off some code',
            'code' => '<h1>Hello World</h1>',
            'category' => 'Navigation',
            'slug' => Str::slug($summary)
        ]);

        $this->assertDatabaseHas('components', [
            'user_id' => $user->id,
            'summary' => 'First Component',
            'description' => 'Showing off some code',
            'code' => '<h1>Hello World</h1>',
            'category' => 'Navigation',
            'slug' => 'first-component'
        ]);
    }

    /**
     * @test
     */
    public function component_summaries_must_be_unique()
    {

        $user  = $this->signIn();
        $first = $this->create(Component::class, [
            'user_id' => $user->id,
            'summary' => 'First Component',
            'slug' => 'first-component'
        ]);

        $second = $this->raw(Component::class, ['user_id' => 1, 'summary' => 'First Component']);
        $response = $this->post('/components', $second);

        $this->assertCount(1, Component::all());
        $response->assertSessionHasErrors(['summary']);
    }

    /**
     * @test
     */
    public function a_component_can_be_created_from_post_route()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $component = $this->raw(Component::class, ['user_id' => $user->id]);

        $response = $this->post('components', $component);

        $this->assertDatabaseHas('components', [
            'summary' => $component['summary']
        ]);
    }

    /**
     * @test
     */
    public function guests_cannot_create_components()
    {
        $component = $this->raw(Component::class);

        $response = $this->post('components', $component);

        $this->assertCount(0, Component::all());

        $response->assertLocation('/login');
    }

    /**
     * @test
     */
    public function components_can_be_updated_by_their_owner()
    {
        $this->withoutExceptionHandling();

        $user = $this->signIn();
        $component = $this->create(Component::class, ['user_id' => $user->id, 'slug' => 'first-component']);
        $component->summary = 'Updated Summary';
        $response = $this->patch("/components/$component->slug", $component->toArray());

        $this->assertCount(1, Component::all());
        $this->assertDatabaseHas('components', [
            'summary' => $component['summary']
        ]);
    }


    /**
     * @test
     */
    public function non_owners_of_a_component_cannot_update_it()
    {

        $user1 = $this->create(User::class);
        $component = $this->create(Component::class, ['user_id' => $user1->id, 'summary' => 'Created By Owner', 'slug' => 'created-by-owner']);

        $user2 = $this->signIn();
        $component->summary = "Update by stranger";

        $response = $this->actingAs($user2)->patch("/components/$component->slug", $component->toArray());

        $this->assertDatabaseHas('components', ['summary' => 'Created By Owner']);
        $this->assertCount(1, Component::all());
    }
}
