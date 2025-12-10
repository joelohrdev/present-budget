<?php

use App\Models\Child;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    #[Computed]
    #[On('child-added')]
    #[On('child-deleted')]
    public function children(): Collection
    {
        return Child::query()->orderBy('name')->get();
    }

    public function delete(int $id): void
    {
        Child::findOrFail($id)->delete();

        $this->dispatch('child-deleted');

        Flux::toast(text: 'Child deleted successfully', variant: 'success');
    }
};
?>

<div x-data="{ show: false, selectedChild: null }" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <livewire:add-user-form-modal/>
    @foreach ($this->children as $child)
        <div
            @click="show = true; selectedChild = {{ Js::from($child) }}"
            class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all cursor-pointer overflow-hidden border border-stone-200 group relative">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <div
                        class="w-14 h-14 rounded-full bg-stone-700 flex items-center justify-center text-white text-xl font-bold shadow-inner">
                        {{ $child->first_letter }}
                    </div>
                    <button
                        wire:click="delete({{ $child->id }})"
                        wire:confirm="Are you sure you want to delete {{ $child->name }}?"
                        class="text-stone-300 hover:text-red-500 p-2 rounded-full hover:bg-red-50 transition-colors -mr-2 -mt-2 opacity-0 group-hover:opacity-100">
                        <svg class="w-4 h-4 hover:cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
                <div class="flex justify-between items-baseline mb-2">
                    <h3 class="text-xl font-bold text-stone-800">{{ $child->name }}</h3>
                    <div class="text-sm font-bold font-mono text-stone-600">
                        ${{ $child->budget }} left
                    </div>
                </div>
                <div class="mb-4">
                    <div class="w-full bg-stone-200 rounded-full h-2 overflow-hidden">
                        <div class="h-full transition-all duration-500 ease-out rounded-full bg-stone-600"
                             style="width: 41.176%;"></div>
                    </div>
                </div>
                <div
                    class="flex justify-between items-center text-xs text-stone-500 border-t border-stone-100 pt-3 mt-2">
                    <span class="flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 12H4M12 20V6m-8 6h16M8 6h8a4 4 0 014 4v2H4v-2a4 4 0 014-4z"></path></svg>
                        4 items
                    </span>
                    <span class="font-mono">
                        $239 / $625
                    </span>
                </div>
            </div>
        </div>
    @endforeach

    <div x-show="show" x-cloak class="fixed inset-0 z-40 bg-stone-100 overflow-y-auto animate-fade-in m-3 rounded-xl shadow-xl">
        <template x-if="selectedChild">
            <div class="bg-white border-b border-stone-200 sticky top-0 z-50">
                <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <button @click="show = ! show" class="p-2 -ml-2 rounded-full text-stone-500 hover:bg-stone-100 transition-colors hover:cursor-pointer">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                        <div>
                            <h2 class="text-2xl font-bold text-stone-800 flex items-center gap-2" x-text="selectedChild.name"></h2>
                            <div class="text-sm text-stone-500 flex gap-3">
                                <span>Budget: $625</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-sm font-bold text-stone-500 uppercase tracking-wide">Spent</div>
                        <div class="text-2xl font-mono font-medium text-stone-800">$245.33</div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
