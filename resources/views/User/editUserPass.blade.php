<input type="hidden" name="id" value="{{ $pass->id }}">

    <!-- Password -->
    <div class="mt-4">
        <x-label for="password" :value="__('Password')" />
        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <x-label for="password_confirmation" :value="__('Confirm Password')" />
        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
    </div>