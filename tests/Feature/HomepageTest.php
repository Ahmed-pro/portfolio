<?php

namespace Tests\Feature;

use App\Models\Profile;
use App\Models\Project;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Livewire\Livewire;
use Tests\TestCase;

class HomepageTest extends TestCase
{
    use DatabaseTransactions;

    public function test_homepage_loads_and_shows_profile_content(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee(Profile::current()->name);
    }

    public function test_portfolio_category_filter_updates_results(): void
    {
        Project::query()->delete();

        Project::create(['title' => 'Web One', 'category' => 'Web', 'sort_order' => 1]);
        Project::create(['title' => 'Mobile One', 'category' => 'Mobile', 'sort_order' => 2]);

        Livewire::test(\App\Livewire\Homepage::class)
            ->assertSee('Web One')
            ->assertSee('Mobile One')
            ->call('setCategory', 'Mobile')
            ->assertSee('Mobile One')
            ->assertDontSee('Web One');
    }

    public function test_contact_form_stores_message_and_blocks_honeypot(): void
    {
        Livewire::test(\App\Livewire\ContactForm::class)
            ->set('name', 'John Doe')
            ->set('email', 'john@example.com')
            ->set('subject', 'Hello')
            ->set('message', 'This is a test message.')
            ->call('submit')
            ->assertSet('sent', true);

        $this->assertDatabaseHas('contact_messages', [
            'email' => 'john@example.com',
        ]);

        Livewire::test(\App\Livewire\ContactForm::class)
            ->set('name', 'Bot')
            ->set('email', 'bot@example.com')
            ->set('message', 'Spam message.')
            ->set('company', 'I am a bot')
            ->call('submit')
            ->assertSet('sent', true);

        $this->assertDatabaseMissing('contact_messages', [
            'email' => 'bot@example.com',
        ]);
    }
}
