<x-layouts.cms title="Pengaturan">

    <div class="bg-white p-8 rounded-lg shadow-sm min-h-screen">
        <div x-data="{showInput:false}" class="mb-10">
            <div class="flex justify-between items-center border-b-2 border-gray-800 pb-2 mb-4">
                <h2 class="text-3xl font-serif">Cawangan</h2>
                <button @click="showInput = !showInput" class="text-4xl font-light hover:text-blue-600">
                    <span x-show="!showInput">+</span>
                    <span x-show="showInput" class="text-2xl"></span>
                </button>
            </div>

            <div x-show="showInput" x-transition class="mb-4">
                <form action="{{route('branch.store')}}" method="POST" class="flex border-2 border-blue-400 rounded overflow-hidden">
                    @csrf
                    <input type="text" name="name" class="flex-1 px-4 py-2 outline-none" placeholder="Tambah Cawangan Baru...">
                    <button type="submit" class="bg-gray-400 text-white px-6 py-2 text-sm hover:bg-gray-600"> Add</button>
                </form>
            </div>

            <ul class="space-y-3">
                @foreach ($cawangan as $b)
                    <li class="flex justify-between group">
                        <span class="text-lg italic text-gray-800">Cawangan {{$c -> name}}</span>
                        <form action="{{route('branch.destroy', $c->id)}}" method="POST">
                            @csrf @method('DELETE')
                            <button class="text-red-400 opacity-0 group-hover:opacity-100 transition">Padam</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

        <div x-data="{ showInput: false}">
            <div class="flex justify-between items-center border-b-2 border-gray-800 pb-2 mb-4">
                <h2 class="text-3xl font-serif">Bahagian</h2>
                <button @click="showInput" class="text-4xl font-light hover:text-blue-600">+</button>
            </div>

            <div x-show="showInput" x-transitiion class="mb-4">
                <form action="{{route('department.store')}}" method="POST" class="flex border-2 border-blue-400 rounded overflow-hidden">
                    @csrf
                    <input type="text" name="name" class="flex-1 px-4 py-2 outline-none" placeholder="Tambah Bahagian Baru...">
                    <button type="submit" class="bg-gray-400 text-white px-6 py-2 text-sm hover:bg-gray-600">Add</button>
                </form>
            </div>

            <ul class="space-y-3">
                @foreach ($bahagian as $d)
                    <li class="flex justify-between group">
                        <span class="text-lg italic text-gray-700">Bahagian {{$d->name}}</span>
                        <form action="{{route('department.destroy', $d->id)}}" method="POST">
                            @csrf @method('DELETE')
                            <button class="text-red-400 opacity-0 group-hover:opacity-100 transition">Padam</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-layouts.cms>