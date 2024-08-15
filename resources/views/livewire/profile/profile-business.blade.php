<div>
     @if (auth()->user()->role_id === 2)
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
  @else

   {{ $this->form }}

   @endif

    <x-filament-actions::modals />
</div>
