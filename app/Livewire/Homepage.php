<?php

namespace App\Livewire;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Homepage extends Component
{
    public string $activeCategory = 'all';

    #[Computed]
    public function profile(): Profile
    {
        return Profile::current();
    }

    #[Computed]
    public function skills(): Collection
    {
        return Skill::orderBy('sort_order')
            ->get()
            ->groupBy(fn (Skill $skill) => $skill->category ?: 'Other');
    }

    #[Computed]
    public function categories(): Collection
    {
        return Project::query()
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');
    }

    #[Computed]
    public function projects(): Collection
    {
        return Project::query()
            ->when(
                $this->activeCategory !== 'all',
                fn ($query) => $query->where('category', $this->activeCategory)
            )
            ->orderByDesc('featured')
            ->orderBy('sort_order')
            ->get();
    }

    public function setCategory(string $category): void
    {
        $this->activeCategory = $category;
    }

    public function render()
    {
        return view('livewire.homepage')->layoutData([
            'title' => trim($this->profile->name . ' — ' . $this->profile->title, ' —'),
            'description' => \Illuminate\Support\Str::limit((string) $this->profile->bio, 160),
        ]);
    }
}
