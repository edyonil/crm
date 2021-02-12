<div>
    <div class="py-12">
        <div class="">
            <div class="overflow-hidden">

                @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
                @endif
                @csrf

                <div>
                    <x-jet-label for="name" value="Nome da empresa" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" wire:model.defer="name" :value="old('name')" required autofocus />
                    <x-jet-input-error for="name" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="role" value="Responsável" />
                    <x-jet-input id="role" class="block mt-1 w-full" type="text" wire:model.defer="role" :value="old('role')" required autofocus />
                    <x-jet-input-error for="role" class="mt-2" />
                </div>



                <div x-data="{imagePreview: null}" @ class="col-span-6 sm:col-span-4 mt-4">
                    <!-- Profile Photo File Input -->
                    <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        imagePreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />
                    <div wire:loading wire:target="photo">Uploading...</div>

                    <x-jet-label for="photo" value="{{ __('Photo') }}" />

                    <!-- Current Profile Photo -->
                    <div class="mt-2" x-show="!imagePreview">
                        @if(!is_null($this->imagePath))
                            <img src="/storage/{{ $this->imagePath }}" class="rounded-full h-20 w-20 object-cover">
                        @endif
                    </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="imagePreview">
                    <span class="block rounded-full w-20 h-20" x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + imagePreview + '\');'">
                    </span>
                </div>
                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>


                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        </div>
    </div>
</div>
</div>

