<x-layouts.cms class="cms" title="Pengguna">
    <div class="bg-white border rounded p-6">
        <h2 class="text-lg font-semibold">Senarai Pengguna</h2>
    </div>

    <div x-data="{open=false}" class="bg-white border rounded p-6">
        <div class="flex justify-end mb-4">
            @php
                $roleId = (int)(auth()->user()->role_id ?? 0);
            @endphp

            @if ($roleId == 1)
                <button @click="open=true" class="px-3 py-2 bg-gray-900 text-white rounded text-sm hover:bg-gray-800">
                    + Pengguna
                </button>
            @endif
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
                            <span class="px-2 py-1 rounded text-xs border">
                                {{$u->status ?? '-'}}
                            </span>
                        </td>
                        <td class="p-3 border-b">{{$u->phone ?? '-'}}</td>
                    </tr>
                @empty
                    <tr>
                        <td class="p-3" colspan="7">Tiada Rekod Pengguna</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</x-layouts.cms>