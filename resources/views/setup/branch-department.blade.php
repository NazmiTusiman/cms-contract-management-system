<x-layouts.cms title="Pengaturan">

    <div class="bg-white p-8 rounded-lg shadow-sm min-h-screen">

        <div x-data="{showInput:false}" class="mb-10">
            <div class="flex justify-between items-center border-b-2 border-gray-800 pb-2 mb-4">
                <h2 class="text-3xl font-serif">Cawangan</h2>
                <button type="button" @click="showInput =!showInput" class="text-4xl font-light hover:text-blue-600">
                    <span x-show="!showInput">+</span>
                    <span x-show="showInput">-</span>
                </button>
            </div>
            
            <div x-show="showInput" x-transition class="mb-4">
                <form action="{{route('branch.store')}}" method="POST" class="flex border-2 border-blue-400 rounded overflow-hidden">
                    @csrf
                    <input type="text" name="branch_name" class="flex px-4 py-2 outline-none" placeholder="Tambah Cawangan Baru...">
                    <button type="submit" class="bg-green-400 text-black px-6 py-2 text-sm hover:bg-gray-600">
                        Add
                    </button>
                </form>
            </div>

            <ul class="space-y-3">
                @forelse ($branch as $b)
                    <li class="flex justify-between items-center group">
                        <span class="text-lg italic text-gray-800">
                            {{$b -> branch_name}}
                        </span>

                        <form action="{{ route('branch.destroy', $b->branch_id)}}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 opacity-0 group-hover:opacity-100 transition">
                                Padam
                            </button>
                        </form>
                    </li>
                @empty
                    <li class="text-gray-500 italic">Tiada Cawangan</li>
                @endforelse
            </ul>
        </div>

        <div x-data="{showInput:false}">
            <div class="flex justify-between items-center border-b-2 border-gray-800 pb-2 mb-4">
                <h2 class="text-3xl font-serif">Bahagian</h2>
                <button type="button" @click="showInput =!showInput" class="text-4xl font-light hover:text-blue-600">
                    <span x-show="!showInput">+</span>
                    <span x-show="showInput">-</span>
                </button>
            </div>

            <div x-show="showInput" x-transition class="mb-4">
                <form action="{{route('department.store')}}" method="POST" class="space-y-3 border-2 border-blue-400 rounded p-4">
                    @csrf
                    <input type="text" name="division_name" class="w-full px-4 py-2 border rounded outline-none" placeholder="Tambah Bahagian Baru...">
                    <select name="branch_name" class="w-full px-4 py-2 border rounded outline-none">
                        <option value="">Pilih Cawangan</option>
                        @foreach ($branch as $b)
                        <option value="{{$b->branch_name}}">{{$b->branch_name}}></option>
                        @endforeach
                    </select>

                    <button type="submit" class="bg-gray-400 text-white px-6 py-6 text-sm hover:bg-gray-600 rounded">
                        Add
                    </button>
                </form>
            </div>

            <ul class="space-y-3">
                @forelse ($departments as $d)
                    <li class="flex justify-between items-center group">
                        <span class="text-lg italic text-gray-700">
                            {{$d->division_name}}
                            @if(!empty($d->branch_name))
                                <span class="text-sm text-gray-500">({{$d->branch_name}})</span>
                            @endif
                        </span>

                        <form action="{{ route('department.destroy', $d->division_id)}}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 opacity-0 group-hover:opacity-100 transition">
                                Padam
                            </button>
                        </form>
                    </li>
                @empty
                    <li class="text-gray-500 italic">Tiada Bahagian</li>
                @endforelse
            </ul>
        </div>

    </div>
</x-layouts.cms>