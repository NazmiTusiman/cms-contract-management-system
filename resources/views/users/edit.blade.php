<x-layouts.cms title="Kontrak">
    <div class="bg-white border rounded p-6 max-w-3xl">
        <form method="POST" action="{{ route('contracts.update', $contract->contact_id)}}" enctype="multipart/form-data">
            @csrf

            <div class="space-4">
                <div>
                    <label  for="block text-sm mb-1">Nama Kontrak</label>
                    <input  name="contract_name" type="text" value="{{$contract->contract_name}}"
                            class="w-full border rounded px-3 py-2">
                </div>
            </div>
        </form>
    </div>

</x-layouts.cms>