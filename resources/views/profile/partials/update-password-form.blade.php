<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6"
          x-data="{
              pw: '',
              get req() {
                  return {
                      len:   this.pw.length >= 8,
                      upper: /[A-Z]/.test(this.pw),
                      lower: /[a-z]/.test(this.pw),
                      num:   /[0-9]/.test(this.pw),
                      sym:   /[^A-Za-z0-9]/.test(this.pw),
                  };
              }
          }">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" x-model="pw" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />

            {{-- Verificador de requisitos de contraseña en tiempo real --}}
            <div class="mt-3 bg-gray-50 border border-gray-200 rounded-lg p-3" x-show="pw.length > 0" x-cloak x-transition>
                <p class="text-[10px] font-black uppercase tracking-wider text-gray-400 mb-2 m-0">Requisitos de seguridad</p>
                <ul class="space-y-1.5 text-xs font-semibold m-0 p-0 list-none">
                    <li class="flex items-center gap-2 transition-colors" :class="req.len ? 'text-emerald-600' : 'text-gray-400'">
                        <i class="fa-solid text-[11px]" :class="req.len ? 'fa-circle-check' : 'fa-circle-xmark'"></i> Mínimo 8 caracteres
                    </li>
                    <li class="flex items-center gap-2 transition-colors" :class="req.upper ? 'text-emerald-600' : 'text-gray-400'">
                        <i class="fa-solid text-[11px]" :class="req.upper ? 'fa-circle-check' : 'fa-circle-xmark'"></i> Al menos una letra mayúscula (A-Z)
                    </li>
                    <li class="flex items-center gap-2 transition-colors" :class="req.lower ? 'text-emerald-600' : 'text-gray-400'">
                        <i class="fa-solid text-[11px]" :class="req.lower ? 'fa-circle-check' : 'fa-circle-xmark'"></i> Al menos una letra minúscula (a-z)
                    </li>
                    <li class="flex items-center gap-2 transition-colors" :class="req.num ? 'text-emerald-600' : 'text-gray-400'">
                        <i class="fa-solid text-[11px]" :class="req.num ? 'fa-circle-check' : 'fa-circle-xmark'"></i> Al menos un número (0-9)
                    </li>
                    <li class="flex items-center gap-2 transition-colors" :class="req.sym ? 'text-emerald-600' : 'text-gray-400'">
                        <i class="fa-solid text-[11px]" :class="req.sym ? 'fa-circle-check' : 'fa-circle-xmark'"></i> Al menos un símbolo (!&#64;#$%...)
                    </li>
                </ul>
            </div>
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
