<x-filament::page>
    <form wire:submit="updateBalance">
        {{ $this->form }}

        <div class="mt-6 flex flex-wrap gap-3">
            @foreach ($this->getFormActions() as $action)
                {{ $action }}
            @endforeach
        </div>
    </form>
</x-filament::page>
