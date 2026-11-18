@csrf

@if (isset($suti))
    @method('PUT')
@endif

<div class="space-y-5">
    <div>
        <label for="nev" class="block text-white mb-2">Név</label>
        <input type="text"
               id="nev"
               name="nev"
               value="{{ old('nev', $suti->nev ?? '') }}"
               maxlength="255"
               required
               class="w-full rounded bg-white text-gray-900 border-gray-600">

        @error('nev')
            <p class="text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="tipus" class="block text-white mb-2">Típus</label>
        <input type="text"
               id="tipus"
               name="tipus"
               value="{{ old('tipus', $suti->tipus ?? '') }}"
               maxlength="255"
               required
               class="w-full rounded bg-white text-gray-900 border-gray-600">

        @error('tipus')
            <p class="text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="dijazott" class="block text-white mb-2">Díjazott</label>
        <select id="dijazott"
                name="dijazott"
                class="w-full rounded bg-white text-gray-900 border-gray-600">
            <option value="0" @selected(old('dijazott', $suti->dijazott ?? 0) == 0)>
                Nem
            </option>
            <option value="1" @selected(old('dijazott', $suti->dijazott ?? 0) == 1)>
                Igen
            </option>
        </select>

        @error('dijazott')
            <p class="text-red-400 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center gap-4">
        <button type="submit"
                class="bg-teal-600 hover:bg-teal-500 text-white font-semibold py-2 px-4 rounded">
            Mentés
        </button>

        <a href="{{ route('sutik.index') }}" class="text-gray-300 hover:text-white">
            Mégse
        </a>
    </div>
</div>