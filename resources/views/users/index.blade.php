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
                        <td class="p-3 border-b">+ 60 {{$u->phone ?? '-'}}</td>
                        <td class="p-3 border-b text-center">
                            @php
                                $roleId = (int)(auth()->user()->role_id ?? 0);
                            @endphp

                            @if($roleId == 1)
                                <form method="POST" action="{{route('user.toggle-status', $u->id)}}">
                                    @csrf

                                    <button type="submit"
                                    class="bg-green-200 px-3 py-1 text-xs border rounded" 
                                    {{$u->status === 'active' ? 'bg-red-500' : 'bg-green-500 text-white'}}>
                                    
                                    {{$u->status ==='active' ? 'Deactivate' : 'Activate'}}

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