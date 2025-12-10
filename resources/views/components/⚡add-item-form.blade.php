<?php

use App\Models\Child;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public ?int $childId = null;
    public ?Child $child = null;

    #[Validate(['required', 'string', 'max:255'])]
    public string $name = '';
    #[Validate(['required', 'numeric', 'min:0'])]
    public string $cost = '';

    public function mount(?int $childId = null): void
    {
        if ($childId) {
            $this->childId = $childId;
            $this->child = Child::findOrFail($childId);
        }
    }

    public function create(): void
    {
        if (!$this->child) {
            return;
        }

        $this->validate();

        $this->child->items()->create([
            'name' => $this->name,
            'cost' => $this->cost,
        ]);

        $this->dispatch('item-added');

        $this->reset(['name', 'cost']);

        Flux::toast(text: 'Item added successfully', variant: 'success');
    }
};
?>

<form wire:submit.prevent="create" class="flex gap-3">
    <div class="flex-1">
        <flux:input wire:model="name" placeholder="Item Name"/>
    </div>
    <div class="w-28">
        <flux:input wire:model="cost" placeholder="Price"/>
    </div>
    <flux:button type="submit" variant="primary">Add Item</flux:button>
</form>
