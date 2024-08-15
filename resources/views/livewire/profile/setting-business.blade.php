<div>
    <form wire:submit="save">
        {{ $this->form }}

        <div  style="padding-top: 15px;"></div>

        <x-filament::button
           type="submit"
           color="primary"
           outlined
          
        >
            Actualizar
        </x-filament::button>
    </form>

    <x-filament-actions::modals />
</div>
