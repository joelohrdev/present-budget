<?php

use App\Models\Child;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public ?int $childId = null;
    public ?Child $child = null;

    public function mount(?int $childId = null): void
    {
        if ($childId) {
            $this->childId = $childId;
            $this->child = Child::findOrFail($childId);
        }
    }

    #[On('item-added')]
    public function total(): float
    {
        if (!$this->child) {
            return 0;
        }

        $spent = $this->child->items()->pluck('cost')->sum();

        return $this->child->budget - $spent;
    }
};
?>

<span>
    {{ $this->total() }}
</span>
