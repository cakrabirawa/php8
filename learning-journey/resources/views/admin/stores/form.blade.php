<div class="space-y-4">

    <div>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <label class="block mb-1 font-medium">Store ID</label>
        <input type="number" name="id" class="border rounded w-full px-3 py-2"
            value="{{ $store->id ?? old('id') }}">
    </div>

    <div>
        <label class="block mb-1 font-medium">Division</label>
        <select name="region_id" class="border rounded w-full px-3 py-2">
            <option value="">Select Division</option>
            @foreach($regions as $reg)
                <option value="{{ $reg->id }}"
                    {{ isset($store) && $store->region_id == $reg->id ? 'selected' : '' }}>
                    {{ $reg->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block mb-1 font-medium">Store Name</label>
        <input type="text" name="name" class="border rounded w-full px-3 py-2"
            value="{{ $store->name ?? old('name') }}">
    </div>

</div>
