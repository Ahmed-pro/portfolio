<?php

namespace Tests\Feature;

use App\Filament\Pages\ManageProfile;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPanelSmokeTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_pages_load_for_an_authenticated_user(): void
    {
        $user = User::first() ?? User::factory()->create();

        $this->actingAs($user);

        $this->get('/admin/manage-profile')->assertOk();
        $this->get('/admin/skills')->assertOk();
        $this->get('/admin/skills/create')->assertOk();
        $this->get('/admin/projects')->assertOk();
        $this->get('/admin/projects/create')->assertOk();
        $this->get('/admin/contact-messages')->assertOk();
    }

    public function test_manage_profile_page_saves_changes(): void
    {
        $user = User::first() ?? User::factory()->create();

        $this->actingAs($user);

        Livewire::test(ManageProfile::class)
            ->set('data.name', 'Updated Name')
            ->set('data.title', 'Updated Title')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertSame('Updated Name', Profile::current()->name);
        $this->assertSame('Updated Title', Profile::current()->title);
    }
}
