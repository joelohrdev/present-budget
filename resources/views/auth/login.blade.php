<x-guest>
    <div class="bg-white p-8 rounded-xl shadow-lg border border-stone-200 w-full max-w-sm animate-fade-in relative">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-serif font-bold text-stone-800">Welcome</h1>
            <p class="text-stone-500 text-sm mt-2">Enter passcode to access budget</p>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-6 space-y-6">
                <flux:otp name="passcode" class="mx-auto" submit="auto" private length="4" />
                <flux:error name="passcode" />
            </div>
        </form>
    </div>
</x-guest>
