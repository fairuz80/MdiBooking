

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Nama')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Katalaluan')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Sah Katalaluan')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="mt-4">
                <x-label for="ic" :value="__('Kad Pengenalan')" />

                <x-input id="ic" class="block mt-1 w-full" type="text" name="ic" :value="old('ic')" required />
            </div>

            <div class="mt-4">
                <x-label for="jawatan" :value="__('Jawatan')" />

                <x-input id="jawatan" class="block mt-1 w-full" type="text" name="jawatan" :value="old('jawatan')" required />
            </div>
            
            <div class="mt-4">
                <x-label for="bahagian" :value="__('Bahagian')" />

                <x-input id="bahagian" class="block mt-1 w-full" type="text" name="bahagian" :value="old('bahagian')" required />
            </div>

            <div class="mt-4">
                <x-label for="ext" :value="__('No. Telefon')" />

                <x-input id="ext" class="block mt-1 w-full" type="text" name="ext" :value="old('ext')" required />
            </div>

            <!-- Select Option Rol type -->
            <div class="mt-4">
            <x-label for="role_id" value="{{ __('Register as:') }}" />
                            <select name="role_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                <option value="admin">Administrator</option>
                                <option value="User">Pengguna</option>
                            </select>
                </div>