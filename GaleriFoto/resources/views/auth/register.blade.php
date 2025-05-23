<x-guest-layout>
    <div class="w-full min-h-screen flex items-center justify-center bg-white">
        <div class="w-[454px] flex flex-col justify-center items-center gap-7">
            <!-- Header -->
            <div class="w-full flex flex-col gap-2">
                <div class="text-2xl font-bold text-neutral-900">Buat akun Galeri Foto</div>
                <div class="text-base text-neutral-900/70">Masukkan informasi akun</div>
            </div>

            <!-- Divider -->
            <div class="w-full h-0 outline outline-2 outline-offset-[-1px] outline-black/10"></div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="w-full flex flex-col gap-6">
                @csrf

                <!-- Username -->
                <div class="flex flex-col gap-3">
                    <label for="username" class="text-base font-medium text-neutral-900">Username</label>
                    <input id="username" type="text" name="username" :value="old('username')" required autofocus
                        class="w-full px-5 py-5 rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 text-black/80 placeholder-black/50"
                        placeholder="Masukkan username">
                    <x-input-error :messages="$errors->get('username')" class="mt-1 text-sm text-red-500" />
                </div>


                <!-- Email -->
                <!-- <div class="flex flex-col gap-3">
                    <label for="email" class="text-base font-medium text-neutral-900">Email</label>
                    <input id="email" type="email" name="email" :value="old('email')" required
                        class="w-full px-5 py-5 rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 text-black/80 placeholder-black/50"
                        placeholder="Masukkan email">
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-sm text-red-500" />
                </div> -->

                <!-- Password -->
                <div class="flex flex-col gap-3">
                    <label for="password" class="text-base font-medium text-neutral-900">Kata sandi</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-5 py-5 rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 text-black/80 placeholder-black/50"
                        placeholder="Masukkan kata sandi">
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-sm text-red-500" />
                </div>

                <!-- Confirm Password -->
                <div class="flex flex-col gap-3">
                    <label for="password_confirmation" class="text-base font-medium text-neutral-900">Konfirmasi kata sandi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full px-5 py-5 rounded-2xl outline outline-1 outline-offset-[-1px] outline-black/10 text-black/80 placeholder-black/50"
                        placeholder="Masukkan lagi kata sandi">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-sm text-red-500" />
                </div>

                <!-- Register Button -->
                <button type="submit"
                    class="btn btn-neutral w-full py-6 bg-neutral-900 text-white font-bold text-base rounded-2xl hover:bg-neutral-800 transition">
                    Daftar
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-4 text-base text-neutral-900">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-semibold hover:underline">Masuk</a>
            </div>
        </div>
    </div>
</x-guest-layout>