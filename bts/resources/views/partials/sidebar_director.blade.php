<div class="p-4 bg-gray-100 min-h-screen">
    <h2 class="font-bold mb-4 text-lg">Director Menu</h2>
    <ul class="space-y-2">
        <li>
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-200">
                Tableau de bord
            </a>
        </li>
        <li>
            <a href="{{ route('chat.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">
                Messages
            </a>
        </li>

        <li>
            <a href="{{ route('drive.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">
                Drive
            </a>
        </li>
        <li>
            <a href="{{ route('cahier_de_texte.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">
                Cahier de texte
            </a>
        </li>
        <li>
            <a href="{{ route('livret.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">
                Livret
            </a>
        </li>
        <li>
            <a href="{{ route('administration.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">
                Administration
            </a>
        </li>
        <li>
            <a href="{{ route('planning.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">
                Planning
            </a>
        </li>
    </ul>
</div>
