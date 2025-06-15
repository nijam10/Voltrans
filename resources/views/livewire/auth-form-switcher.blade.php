<div x-data="{ showLogin: @entangle('showLogin') }" class="flex min-h-screen bg-gradient-to-b from-[#4C956C] to-[#2C6E6D] overflow-hidden">
    <div class="hidden lg:block lg:w-1/2 bg-cover bg-center transition-transform duration-700 ease-in-out"
         style="background-image: url('/images/login-photo.jpg');"
         :class="{'translate-x-full': !showLogin}">
    </div>

    <div class="w-full lg:w-1/2 flex flex-col justify-center px-6 py-8 md:px-8 transition-transform duration-700 ease-in-out"
         :class="{'-translate-x-full': !showLogin}">
        <div class="flex justify-center mx-auto mb-6">
            <img class="w-auto h-20" src="{{ asset('images/voltrans-logo.png') }}" alt="Voltrans Logo">
        </div>

        <template x-if="showLogin">
            <div x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform -translate-x-10" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform -translate-x-10" class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-semibold text-center text-gray-600 mb-4">Selamat Datang</h2>
                <p class="text-sm text-center text-gray-600 mb-6">Silahkan login untuk melanjutkan</p>

                <form wire:submit.prevent="login">
                    @csrf
                    <div class="mb-4">
                        <label for="loginEmail" class="block mb-2 text-sm font-medium text-gray-600">Alamat Email</label>
                        <input id="loginEmail" wire:model.defer="loginEmail" type="email" required autofocus
                               class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg focus:border-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none" />
                        @error('loginEmail') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="loginPassword" class="block mb-2 text-sm font-medium text-gray-600">Password</label>
                        <input id="loginPassword" wire:model.defer="loginPassword" type="password" required
                               class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg focus:border-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none" />
                        @error('loginPassword') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-gray-800 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50">
                        Sign In
                    </button>
                </form>

                <p class="mt-6 text-xs text-center text-gray-500">
                    Belum punya akun? 
                    <button wire:click="toggleForm" class="text-green-900 font-semibold hover:underline focus:outline-none">Daftar disini</button>
                </p>
            </div>
        </template>

        <template x-if="!showLogin">
            <div x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 transform translate-x-10" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform translate-x-10" class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-semibold text-center text-gray-600 mb-4">Selamat Datang</h2>
                <p class="text-sm text-center text-gray-600 mb-6">Silahkan daftar untuk melanjutkan</p>

                <form wire:submit.prevent="register">
                    @csrf
                    <div class="mb-4">
                        <label for="registerName" class="block mb-2 text-sm font-medium text-gray-600">Nama Lengkap</label>
                        <input id="registerName" wire:model.defer="registerName" type="text" required autofocus
                               class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg focus:border-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none" />
                        @error('registerName') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="registerEmail" class="block mb-2 text-sm font-medium text-gray-600">Alamat Email</label>
                        <input id="registerEmail" wire:model.defer="registerEmail" type="email" required
                               class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg focus:border-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none" />
                        @error('registerEmail') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="registerPassword" class="block mb-2 text-sm font-medium text-gray-600">Password</label>
                        <input id="registerPassword" wire:model.defer="registerPassword" type="password" required
                               class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg focus:border-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none" />
                        @error('registerPassword') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label for="registerPasswordConfirmation" class="block mb-2 text-sm font-medium text-gray-600">Konfirmasi Password</label>
                        <input id="registerPasswordConfirmation" wire:model.defer="registerPasswordConfirmation" type="password" required
                               class="block w-full px-4 py-2 text-gray-700 bg-white border rounded-lg focus:border-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-40 focus:outline-none" />
                        @error('registerPasswordConfirmation') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full px-6 py-3 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-gray-800 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring focus:ring-gray-300 focus:ring-opacity-50">
                        Daftar
                    </button>
                </form>

                <p class="mt-6 text-xs text-center text-gray-500">
                    Sudah punya akun? 
                    <button wire:click="toggleForm" class="text-green-900 font-semibold hover:underline focus:outline-none">Masuk disini</button>
                </p>
            </div>
        </template>
    </div>
</div>
