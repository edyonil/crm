<div class="overflow-hidden px-1">
    <!-- component -->
    <x-slot name="header">
        Empresa
    </x-slot>


    @if($isOpen)
    <x-jet-dialog-modal wire:model="isOpen">
        <x-slot name="title">Empresa</x-slot>
        <x-slot name="content">
            <form>
                @include('livewire.company.form-add')
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                {{ __('Nevermind') }}
            </x-jet-secondary-button>
            @if(is_null($selectedId))
            <x-jet-button class="ml-2" dusk="confirm-password-button" wire:click="save" wire:loading.attr="disabled">
                Salvar
            </x-jet-button>
            @else
            <x-jet-button class="ml-2" dusk="confirm-password-button" wire:click="update" wire:loading.attr="disabled">
                Atualizar
            </x-jet-button>
            @endif
        </x-slot>
    </x-jet-dialog-modal>
    @endif

    <x-jet-dialog-modal wire:model="isOpenDelete">
        <x-slot name="title">Excluir</x-slot>
        <x-slot name="content">
            <p>Tem certeza que deseja excluir a empresa {{$company->name ?? ''}}</p>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="closeModalDelete" wire:loading.attr="disabled">
                Cancelar
            </x-jet-secondary-button>
            <x-jet-button class="ml-2" dusk="confirm-password-button" wire:click="destroy({{$company->id ?? ''}})" wire:loading.attr="disabled">
                Excluir
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>


    {{-- Tabela com conteúdos --}}
    <div class="flex flex-row justify-between mb-4">
        <div class="my-2 flex sm:flex-row flex-col">
            <div class="block relative">
                <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                        <path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                        </path>
                    </svg>
                </span>
                <input wire:model="search" placeholder="Search" style="height:42px" class="appearance-none rounded border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
            </div>
        </div>
        <a wire:click="create()" type="button" class="flex items-center justify-between cursor-pointer px-4 py-2 mb-2 mt-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Adicionar
        </a>
    </div>
    <div class="w-full mb-8 rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">
                            Empresa
                        </th>
                        <th class="px-4 py-3">
                            Cadastrado em
                        </th>
                        <th class="px-4 py-3">
                            Status
                        </th>
                        <th class="px-4 py-3 w-0.5"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach($data as $key => $row)

                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">

                            <div class="flex items-center text-sm">
                                <!-- Avatar with inset shadow -->
                                <div
                                    class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                                >
                                    <img
                                    class="object-cover w-full h-full rounded-full"
                                    src="/storage/{{$row->image_path}}"
                                    alt=""
                                    loading="lazy"
                                    />
                                    <div
                                    class="absolute inset-0 rounded-full shadow-inner"
                                    aria-hidden="true"
                                    ></div>
                                </div>
                                <div>
                                    <p class="font-semibold"> {{$row->name}}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                    Responsavel: {{$row->role}}
                                    </p>
                                </div>
                                </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{$row->createdAtBr}}
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span class="relative inline-block px-3 py-1 font-semibold {{$row->status ? 'text-green-900' : 'text-red-900'}} leading-tight">
                                <span aria-hidden class="absolute inset-0  {{$row->status ? 'bg-green-200' : ' bg-red-200'}}  opacity-50 rounded-full"></span>
                                <span class="relative">{{$row->status == true ? 'Ativo' : 'Inativo'}}</span>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                        <div class="flex">
                              <a wire:click="edit({{ $row->id }})" class="cursor-pointer">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                              </a>
                              <a wire:click.client="delete({{ $row->id }})" class="cursor-pointer">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </a>

                                        <a wire:click.client="activeOrInactive({{ $row->id }})" class="cursor-pointer">
                                            @if(!$row->status)
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            @else
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            @endif
                                            
                                        </a>
                                        
                                        <a href="{{ route('company-view', ['company' => $row]) }}" class="cursor-pointer">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>
                                        </div>
                            
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $data->links('pagination',['is_livewire' => true]) }}
    </div>
</div>

<script>
</script>

