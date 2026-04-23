<x-layouts.cms title="Permohonan Daftar Pengguna">
    <div x-data="{ open:false, selected:null }">
        <table class="min-w-full text-sm">
        <thead>
            <tr>
                <th class="p-3 border-b">Nama</th>
                <th class="p-3 border-b">Emel</th>
                <th class="p-3 border-b">Status</th>
                <th class="p-3 border-b">Tindakan</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach ($requests as $r)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border-b">{{$r->full_name}}</td>
                    <td class="p-3 border-b">{{$r->email}}</td>
                    <td class="p-3 border-b">{{ucfirst($r->type)}}</td>
                    <td class="p-3 border-b text-center">
                        <button @click="open=true; selected={{$r}}" class="px-3 py-1 bg-blue-500 text-white rounded text-xs">
                            Lihat
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>

        <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center" x-cloak>
            <div class="absolute inset-0 bg-black/50" @click="open=false"></div>

            <div class="bg-white rounded-lg p-6 w-full max-w-lg relative">
                <h3 class="text-lg font-semibold mb-4">Maklumat Permohonan</h3>
                
                <template x-if="selected">
                    <div class="space-y-2 text-sm">
                        <p><strong>Nama:</strong><span x-text="selected.full_name"></span></p>
                        <p><strong>Nama Panggilan:</strong><span x-text="selected.username"></span></p>
                        <p><strong>MyKad:</strong><span x-text="selected.mykad"></span></p>
                        <p><strong>Emel:</strong><span x-text="selected.email"></span></p>
                        <p><strong>No.Tel:</strong><span x-text="selected.num_phone"></span></p>
                        <p><strong>Jenis:</strong><span x-text="selected.type"></span></p>

                        <p><strong>Catatan:</strong><span x-text="selected.remarks"></span></p>
                    </div>
                </template>

                <div class="mt-4">
                    <form method="POST" action="'/registration-request/' + selected.request_id + '/approve'">
                    @csrf

                    <label class="text-sm">Assign Role</label>
                    <select name="role_id" class="w-full border-rounded px-3 py-2">
                        <option value="1">Super Admin</option>
                        <option value="2"> Admin </option>
                        <option value="3"> User </option>
                    </select>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" @click="open=false" class="px-3 py-2 border-rounded">
                            Tutup
                        </button>

                        <button type="submit" class="px-3 py-2 bg-green-600 text-white rounded">
                            Lulus
                        </button>
                    </div>
                    </form>

                    <form method="POST" action="'/registration-request/' + selected.request_id + '/reject' " class="mt-2">
                    @csrf

                    <button type="submit" class="w-full px-3 py-2 bg-red-500 text-white rounded">
                        Tolak
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layouts.cms>