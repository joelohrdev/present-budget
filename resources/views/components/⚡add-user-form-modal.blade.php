<?php

use App\Models\Child;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';
    #[Validate(['required', 'numeric', 'min:0'])]
    public string $limit = '';

    public function create(): void
    {
        $this->validate();

        Child::create([
            'name' => $this->name,
            'budget' => $this->limit,
        ]);

        $this->reset(['name', 'limit']);

        $this->modal('add-user-form')->close();

        $this->dispatch('child-added');

        Flux::toast(text: 'Child added successfully', variant: 'success');
    }
};
?>

<div class="w-full">
    <flux:modal.trigger name="add-user-form">
        <button
            class="w-full group flex flex-col items-center justify-center min-h-[220px] bg-white rounded-xl border-2 border-dashed border-stone-300 hover:border-stone-500 hover:bg-stone-50 transition-all duration-200 shadow-sm">
            <div
                class="w-12 h-12 bg-stone-100 rounded-full flex items-center justify-center mb-3 group-hover:bg-stone-200 transition-colors">
                <svg class="w-6 h-6 text-stone-400 group-hover:text-stone-600" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
        </button>
    </flux:modal.trigger>

    <flux:modal name="add-user-form" class="md:w-96">
        <form wire:submit="create" class="space-y-6">
            <div>
                <flux:heading size="lg">New Budget Profile</flux:heading>
            </div>
            <flux:field>
                <flux:label>Name</flux:label>
                <flux:input wire:model="name" placeholder="Name"/>
                <flux:error name="name"/>
            </flux:field>
            <flux:field>
                <flux:label>Budget Limit</flux:label>
                <flux:input.group>
                    <flux:input.group.prefix>
                        <flux:icon.dollar-sign class="size-4"/>
                    </flux:input.group.prefix>
                    <flux:input mask:dynamic="$money($input)" wire:model="limit"/>
                    <flux:error name="limit"/>
                </flux:input.group>
            </flux:field>
            <div class="flex gap-x-3">
                <flux:spacer/>
                <flux:button @click="$flux.modal('add-user-form').close()" variant="ghost">Cancel</flux:button>
                <flux:button type="submit" variant="primary">Create Profile</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
