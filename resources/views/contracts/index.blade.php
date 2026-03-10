
<x-layouts.cms title="Senarai Kontrak">
    <div class="bg-white border rounded p-6">
            <div class="flex  justify-end mb-4">
              @php
                  $roleId = (int) (auth()->user()->role_id ?? 0);
              @endphp

              <div x-data="{open:false}" class="flex justify-end mb-4">
              @if (in_array($roleId, [1,2]))
              <button type="button" @click="open=true" class="px-3 py-2 bg-gray-900 text-white rounded text-sm hover:bg-gray-800">
                Tambah Kontrak
              </button>
              @endif

              <!---- Modal ---->
              <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center" @keydown.escape.window="open=false">

                {{--BackDrop--}}
                <div class="absolute inset-0 bg-black/50" @click="open=false"></div>

                {{--Modal Box--}}
                <div class="realtive z-10 bg-white w-full max-w-xl rounded-lg shadow-lg p-6">

                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold"> Tambah Kontrak</h3>
                        <button type="button" class="text-gray-500 hover:text-gray-900" @click="open=false">X</button>
                    </div>

                    <form method="POST" action="{{route('contracts.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium mb-1"> Nama Kontrak</label>
                            <input name="contract_name" type="text" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1"> Nilai Kontrak (RM)</label>
                            <input name="contract_value" type="number" step="0.01" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium mb-1"> Tarikh Mula</label>
                                <input name="start_date" type="date" class="w-full border rounded px-3 py-2" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium mb-1"> Tarikh Tamat</label>
                                <input name="end_date" type="date" class="w-full border rounded px-3 py-2" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Bond (RM)</label>
                            <input name="bond_value" type="number" step="0.01" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Lampiran</label>
                            <input type="file" name="attachment" class="w-full border rounded px-3 py-2" accept=".pdf,.doc,.docx,.xls,.xlsx,.png,.jpg,.jpeg">
                        </div>

                        <div class="flex justify-end gap-2 pt-2">
                            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded hover:bg-gray-800">
                                Simpan
                            </button>
                            <button type="button" @click="open=false" class="px-4 py-2 border rounded">
                                Batal
                            </button>
                        </div>
                    </div>
                </form>
                </div>
              </div>
              </div>      
            </div>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr>
                        <th class="p-3 border-b text-left">No</th>
                        <th class="p-3 border-b text-left">Nama Kontrak</th>
                        <th class="p-3 border-b text-left">Harga</th>
                        <th class="p-3 border-b text-left">Tarikh Mula</th>
                        <th class="p-3 border-b text-left">Tarikh Tamat</th>
                        <th class="p-3 border-b text-left">Status</th>
                        <th class="p-3 border-b text-left">Lampiran</th>
                        <th class="p-3 border-b text-left">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contracts as $i => $c )
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 border-b">{{$i + 1}}</td>
                            <td class="p-3 border-b">{{$c->contract_name ?? '-'}}</td>
                            <td class="p-3 border-b">
                                {{number_format($c->contract_value, 2)}}</td>
                            <td class="p-3 border-b">{{$c->start_date}}</td>
                            <td class="p-3 border-b">{{$c->end_date}}</td>
                            <td class="p-3 border-b">{{$c->status ?? '-'}}</td>
                            <td class="p-3 border-b">{{$c->attachment ?? '-'}}</td>
                            <td class="p-3 border-b">
                                @php
                                    $roleId = (int)(auth()->user()->role_id ?? 0)
                                @endphp

                                <div class="flex items-center gap-3">
                                    {{--Download available for everyone--}}
                                    @if ($c-> attachment)
                                        <a href="{{ asset('storage/'.$c->attachment)}}"
                                            class="text-blue-200 hover:text-blue-600" 
                                            title="Download">
                                        </a>    
                                    @endif
                                </div>
                            </td>
                            </tr>                        
                    @empty
                        <tr>
                            <td class="p-3" colspan="8">Tiada Rekod Kontrak</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.cms>