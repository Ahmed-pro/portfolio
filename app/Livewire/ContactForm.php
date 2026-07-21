<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactForm extends Component
{
    #[Validate('required|string|max:100')]
    public string $name = '';

    #[Validate('required|email|max:255')]
    public string $email = '';

    #[Validate('nullable|string|max:150')]
    public string $subject = '';

    #[Validate('required|string|max:2000')]
    public string $message = '';

    // Honeypot: hidden from real visitors via CSS, bots tend to fill every field.
    public string $company = '';

    public bool $sent = false;

    public function submit(): void
    {
        $this->validate();

        if (filled($this->company)) {
            $this->resetForm();
            $this->sent = true;

            return;
        }

        $key = 'contact-form:' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $this->addError('message', __('Too many messages sent from your address. Please try again later.'));

            return;
        }

        RateLimiter::hit($key, 300);

        ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        $this->resetForm();
        $this->sent = true;
    }

    protected function resetForm(): void
    {
        $this->reset(['name', 'email', 'subject', 'message', 'company']);
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
