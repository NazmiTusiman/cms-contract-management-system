<x-guest-layout>
    <div x-data="{ type: '{{ old('type', 'internal') }}', selectedBranch:''}">
         <h2 class="mb-6 text-2xl font-semibold text-center">Permohonan Daftar Pengguna</h2>

        <form method="POST" action="{{route('registration-request.store')}}" class="space-y-4">
            @csrf

            <div>
                <x-input-label for="full_name" :value="__('Nama Penuh')"/>
                <x-text-input type="text" name="full_name" id="full_name" class="block mt-1 w-full" :value="old('full_name')" required/>
                <x-input-error :messages="$errors->get('full_name')" class="mt-2"/>
            </div>

            <div>
                <x-input-label for="username" :value="__('Nama Pengguna')"/>
                <x-text-input type="text" name="username" id="username" class="block mt-1 w-full" :value="old('username')" required/>
                <x-input-error :messages="$errors->get('username')" class="mt-2"/>
            </div>

            <div>
                <x-input-label for="mykad" :value="__('No. MyKad')"/>
                <x-text-input name="mykad" id="mykad" class="block mt-1 w-full" :value="old('mykad')" required/>
                <x-input-error :messages="$errors->get('mykad')" class="mt-2"/>
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')"/>
                <x-text-input type="email" name="email" id="email" class="block mt-1 w-full" :value="old('email')" required/>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <div>
                <x-input-label for="num_phone" :value="__('No. Tel')"/>
                <x-text-input name="num_phone" id="num_phone" class="block mt-1 w-full" :value="old('num_phone')" required/>
                <x-input-error :messages="$errors->get('num_phone')" class="mt-2"/>
            </div>

            <div class="mt-4">
                <x-input-label :value="__('Jenis Pengguna')"/>
                <select name="type" x-model="type" class="block mt-1 w-full rounded-md border-gray-300">
                    <option value="internal">Internal </option>
                    <option value="external">External </option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2"/>
            </div>
            
            {{--Internal Function--}}

            <div x-show="type === 'internal'" x-cloak>
                <div class="mt-4">
                    <x-input-label :value="__('Cawangan')"/>
                    <select name="branch_id" @change="selectedBranch = $event.target.options[$event.target.selectedIndex].dataset.name"
                        class="block mt-1 w-full rounded-md border-gray-500" require>
                        <option value="">Pilih Cawangan</option>
                        @foreach ($branches as $b)
                            <option value="{{ $b->branch_id }}" data-name="{{$b->branch_name}}">
                                {{$b->branch_name}}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('branch_id')" class="mt-2"/>               
                </div>
            </div>

            <div class="mt-4" x-show="selectedBranch === 'JABATAN INSOLVENSI IBU PEJABAT'" x-cloak>
                <x-input-label :value="__('Bahagian')"/>
                <select name="division_id" class="block mt-1 w-full rounded-md border-gray-300" >
                    <option value="">Pilih Bahagian</option>
                    @foreach ($departments as $d)
                        <option value="{{$d->division_id}}">
                            {{$d->division_name}}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('division_id')" class="mt-2"/>
            </div>

            <div>
                <x-input-label for="remarks" :value="__('Catatan')"/>
                <textarea name="remarks" id="remarks" rows="3" class="block mt-1 w-full rounded-md border-gray-300">{{old('remarks')}}</textarea>
                <x-input-error :messages="$errors->get('remarks')" class="mt-2"/>
            </div>

            <div class="flex items-center justify-between mt-6">
                <a href="{{route('login')}}" class="text-sm text-gray-600 hover:text-gray-900">
                    Kembali ke Log Masuk
                </a>

                <x-primary-button>
                    Hantar Permohonan
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>