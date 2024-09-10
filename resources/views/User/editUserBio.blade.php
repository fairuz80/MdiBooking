<input type="hidden" name="id" value="{{$data['id']}}">

<!-- Name -->
<div>
    <x-label for="name" :value="__('Nama')" />

    <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$data['name']}}" required />
</div>

<div class="mt-4">
    <x-label for="ic" :value="__('Kad Pengenalan')" />

    <x-input id="ic" class="block mt-1 w-full" type="text" name="ic" value="{{$data['ic']}}" required />
</div>

<!-- Email Address -->
<div class="mt-4">
    <x-label for="email" :value="__('E-mel')" />

    <x-input id="email" class="block mt-1 w-full" type="text" name="email" value="{{$data['email']}}" required />
</div>

<div class="mt-4">
    <x-label for="jawatan" :value="__('Jawatan')" />

    <x-input id="jawatan" class="block mt-1 w-full" type="text" name="jawatan" value="{{$data['jawatan']}}" required />
</div>

<div class="mt-4">
    <x-label for="bahagian" :value="__('Bahagian')" />

    <x-input id="bahagian" class="block mt-1 w-full" type="text" name="bahagian" value="{{$data['bahagian']}}" required />
</div>

<div class="mt-4">
    <x-label for="ext" :value="__('No. Telefon')" />

    <x-input id="ext" class="block mt-1 w-full" type="text" name="ext" value="{{$data['ext']}}" required />
</div>

<!-- Select Option Rol type -->
<div class="mt-4">
<x-label for="role_id" value="{{ __('Register as:') }}" />
                <select name="role_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                    <option value="admin">Administrator</option>
                    <option value="User">Pengguna</option>
                </select>
    </div>