<x-guest-layout>
    <div class="w-full min-h-screen flex items-center justify-center bg-white">
        <div class="w-[454px] flex flex-col justify-center items-center gap-7">
            <!-- Header -->
            <div class="w-full flex flex-col gap-2">
                <div class="text-2xl font-bold text-neutral-900 flex  justify-between">Masuk ke <img src="{{ asset('assets/img/Pixelora.png') }}" alt="" srcset="" class="h-8 translate-y-[-4px]"></div>
                <div class="text-base text-neutral-900/70">Masukkan identitas akun anda</div>
            </div>

            <!-- Divider -->
            <div class="w-full h-0 outline outline-2 outline-offset-[-1px] outline-black/10"></div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="w-full flex flex-col gap-6">
                @csrf

                <!-- Username -->
                <div class="flex flex-col gap-3">
                    <label for="username" class="text-base font-medium text-neutral-900">Username</label>
                    <input id="username" type="text" name="username" :value="old('username')" required autofocus
                        class="w-full px-5 py-5 rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 text-black/80 placeholder-black/50"
                        placeholder="Masukkan username">
                    <x-input-error :messages="$errors->get('username')" class="mt-1 text-sm text-red-500" />
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-3">
                    <label for="password" class="text-base font-medium text-neutral-900">Kata sandi</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-5 py-5 rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 text-black/80 placeholder-black/50"
                        placeholder="Masukkan kata sandi">
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-500" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex justify-between items-center">
                    <label class="flex items-center gap-2 text-base text-neutral-900">
                        <input type="checkbox" name="remember"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        Ingat aku
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-base font-semibold text-neutral-900 hover:underline">Lupa password</a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="btn btn-neutral w-full py-6 bg-cyan-600 text-white font-bold text-base rounded-2xl hover:bg-cyan-600 border-none transition">
                    Masuk
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-4 text-base text-stone-900">
                Belum punya akun?
                <a href="{{ route('register') }}" class="font-semibold hover:underline">Buat akun</a>
            </div>
        </div>
    </div>
</x-guest-layout>
