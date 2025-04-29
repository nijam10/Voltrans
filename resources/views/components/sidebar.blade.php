{{-- resources/views/components/user-sidebar.blade.php --}}
<div class="p-4 border rounded w-full text-center space-y-4">
    <img src="/images/user.png" class="w-20 h-20 mx-auto rounded-full object-cover" alt="User Profile">
    <h2 class="font-semibold">User Name</h2>
    <button class="bg-green-700 hover:bg-green-800 text-white px-4 py-1 rounded">Profil Anda</button>
    
    <ul class="text-left text-sm space-y-3 pt-4">
        <li class="flex items-center gap-2 text-gray-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor"><path d="..." /></svg>
            Kelola Profil
        </li>
        <li class="flex items-center gap-2 font-bold text-black">
            <svg class="w-4 h-4" fill="none" stroke="currentColor"><path d="..." /></svg>
            Riwayat Pesanan
        </li>
        <li class="flex items-center gap-2 text-gray-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor"><path d="..." /></svg>
            Pengaturan
        </li>
        <li class="flex items-center gap-2 text-gray-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor"><path d="..." /></svg>
            Keluar
        </li>
    </ul>
</div>
