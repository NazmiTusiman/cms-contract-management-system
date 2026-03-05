<x-layouts.cms title="{{$pageTitle ?? 'Dashboard'}}">
    <div class="grid grid-cols-3 gap-6">
        
        <div class="bg-white border rounded p-6">
            <div class="text-sm text-gray-500">Jumlah Kontrak</div>
            <div class="text-3x1 font bold mt-2">
                {{ $jumlahKontrak ?? 0 }}
            </div>
        </div>

        <div class="bg-green-50 border rounded p-6">
            <div class="text-sm text-green-500">Nilai Kontrak</div>
            <div class="text-3x1 font bold mt-2">
                RM {{ $nilaiKontrak ?? 0,2 }}
            </div>
        </div>

        <div class="bg-white border rounded p-6">
            <div class="text-sm text-grey-500">Tamat Tempoh</div>
            <div class="text-3x1 font bold mt-2">
                {{$tamatTempoh ?? 0}}
            </div>
        </div>
    </div>

</x-layouts.cms>
