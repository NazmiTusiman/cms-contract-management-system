<x-layouts.cms class="cms" title="Pengguna">
    <div class="bg-white border rounded p-6">
        <h2 class="text-lg font-semibold">Senarai Pengguna</h2>
    </div>

    <div x-data="{open: false}" class="bg-white border rounded p-6">
        <div class="flex justify-end mb-4">
            @php
                $roleId = (int)(auth()->user()->role_id ?? 0);
            @endphp

            @if ($roleId == 1)
                <button @click="open=true" class="px-3 py-2 bg-gray-900 text-white rounded text-sm hover:bg-gray-800">
                    + Pengguna
                </button>
            @endif

            <div x-show="open" x-cloak class="fixed inset-0 z-50 flex item-center justify-center">
                <div class="fixed inset-0 bg-black/50" @click="open=false"></div>
                <div class="relative bg-white w-full max-w-xl rounded-lg shadow-lg p-6">

                    <div class="flex justify-between item-center mb-4">
                        <h3 class="text-lg font-semibold">Tambah Pengguna</h3>
                        <button @click="open=false" class="text-gray-500 hover:text-gray-900">X</button>
                    </div>

                    <form method="POST" action="{{route('users.store')}}">
                    @csrf

                    <div class="space-y-4">
                        
                        <div>
                            <label class="block text-sm mb-1">Nama</label>
                            <input  name="full_name" type="text" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">Nama Pengguna</label>
                            <input  name="username" type="text" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">No.Tel</label>
                            <input  name="phone" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">NRIC</label>
                            <input  name="mykad" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block text-sm mb-1">Emel</label>
                            <input  name="email" type="email" class="w-full border rounded px-3 py-2" required>
                        </div>
                        

                        <div>
                            <label class="block text-sm mb-1">Role</label>
                            <select name="role_id" class="w-full border rounded px-3 py-2">
                                <option value="1">Super Admin</option>
                                <option value="2">Admin</option>
                                <option value="3">User</option>
                            </select>
                        </div>

                        <div class="flex justify-end gap-2 pt-2">
                            <button type="submit"
                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-800">
                                Simpan
                            </button>

                            <button type="button"
                            @click="open=false"
                            class="px-4 py-2 bg-red-500 border rounded hover:bg-red-800">
                            Batal
                        </button>
                        </div>

                        

                    </div>
                    </form>
                </div>
            </div>
        </div>
    
        @if (session('error'))
            <div class="bg-red-100 border text-black-200 px-4 py-3 rounded mb-1">
                {{session('error')}}    
            </div>        
        @endif

        @if (session('success'))
        <div class="bg-red-100 border text-black-200 px-4 py-3 rounded mb-1">
            {{session('success')}}    
        </div>            
        @endif

    <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead>
                <tr>
                    <th class="p-3 border-b text-left">No</th>
                    <th class="p-3 border-b text-left">Nama</th>
                    <th class="p-3 border-b text-left">NRIC</th>
                    <th class="p-3 border-b text-left">Emel</th>
                    <th class="p-3 border-b text-left">Jawatan</th>
                    <th class="p-3 border-b text-left">Status</th>
                    <th class="p-3 border-b text-left">No.Tel</th>
                    <th class="p-3 border-b text-left">Tindakan</th>
                </tr>
            </thead>

            <tbody>
                @forelse ( $users as $i => $u )
                    @php
                        $roleName = match((int) $u->role_id) {
                            1 => 'SuperAdmin',
                            2 => 'Admin',
                            default => 'User',
                        }
                    @endphp

                    <tr>
                        <td class="p-3 border-b">{{$i + 1}}</td>
                        <td class="p-3 border-b">{{$u->full_name ?? $u->username ?? '-'}}</td>
                        <td class="p-3 border-b">{{$u->mykad ?? '-'}}</td>
                        <td class="p-3 border-b">{{$u->email ?? '-'}}</td>
                        <td class="p-3 border-b">{{$roleName}}</td>
                        <td class="p-3 border-b">
                            <span class="px-2 py-1 rounded text-xs border {{$u->status === 'active' ? 'bg-green-100 text-black-200 border-black-300' : 'bg-red-100 text-white-200 border-white-200'}}">
                                {{$u->status ?? '-'}}
                            </span>
                        </td>
                        <td class="p-3 border-b">+60 {{$u->phone ?? '-'}}</td>
                        <td class="p-3 border-b text-center">
                            @php
                                $roleId = (int)(auth()->user()->role_id ?? 0);
                            @endphp

                            @if($roleId == 1)
                                <form method="POST" action="{{route('user.toggle-status', $u->id)}}">
                                    @csrf

                                    <button type="submit"
                                    class="bg-green-200 px-3 py-1 text-xs border rounded
                                    {{$u->status === 'active' ? 'bg-green-500' : 'bg-red-500'}}" >
                                    
                                    @if($u->status === 'active')
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                            fill="none" 
                                            viewBox="0 0 24 24" 
                                            stroke-width="1.5" 
                                            stroke="currentColor" 
                                            class="size-6">
                                        <path stroke-linecap="round" 
                                            stroke-linejoin="round" 
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        fill="none" viewBox="0 0 24 24" 
                                        stroke-width="1.5" 
                                        stroke="currentColor" 
                                        class="size-6">
                                        <path stroke-linecap="round" 
                                            stroke-linejoin="round" 
                                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    @endif

                                    </button>
                                </form>
                            @endif

                            @if ($roleId == 1 && $u->id != Auth::id())
                                <form method="POST" action="{{route('users.destroy', $u->id)}}" onsubmit="return confirm('Padam Pengguna ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="bg-red-50 border rounded p-2 flex justify-center hover:bg-red-100" title="Padam">
                                                <svg xlmns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox=" 0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="w-4 h-4 text-red-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.166L18.16 19.673A2.25 2.25 0 0 1 15.916 21H8.084a2.25 2.25 0 0 1-2.244-1.327L4.772 5.79m14.456 0A48.108 48.108 0 0 0 15.75 5.25m-6.75 0a48.11 48.11 0 0 1-3.478.54m7.5-2.25h-3a1.125 1.125 0 0 0-1.125 1.125V5.25h5.25v-.585A1.125 1.125 0 0 0 13.5 3.75Z"/>
                                                </svg>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-3" colspan="7">Tiada Rekod Pengguna</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    </div>
</x-layouts.cms>