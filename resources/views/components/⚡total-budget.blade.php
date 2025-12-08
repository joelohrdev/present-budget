<?php

use App\Models\Child;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    #[Computed]
    #[On('child-added')]
    #[On('child-deleted')]
    public function totalBudget()
    {
        return Child::pluck('budget')->sum();
    }

};
?>

<div>
    <div
        class="flex gap-8 bg-stone-800/50 p-4 rounded-xl border border-stone-700/50 flex-1 md:flex-none justify-between md:justify-start">
        <div>
            <div class="text-xs font-bold text-stone-400 uppercase tracking-wider mb-1">Total Budget</div>
            <div class="text-2xl font-medium font-mono">${{ $this->totalBudget() }}</div>
        </div>
        <div class="w-px bg-stone-700"></div>
        <div>
            <div class="text-xs font-bold text-stone-400 uppercase tracking-wider mb-1">Spent</div>
            <div class="text-2xl font-medium font-mono">$838</div>
        </div>
        <div class="w-px bg-stone-700"></div>
        <div>
            <div class="text-xs font-bold text-stone-400 uppercase tracking-wider mb-1">Remaining</div>
            <div class="text-2xl font-medium font-mono text-emerald-400">${{ $this->totalBudget() }}</div>
        </div>
    </div>
</div>
