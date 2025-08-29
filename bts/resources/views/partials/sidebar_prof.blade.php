<div class="p-4 bg-gray-100 min-h-screen">
    <h2 class="font-bold mb-4 text-lg">Prof Menu</h2>
    <ul class="space-y-2">
        <li>
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-200">Tableau de bord</a>
        </li>
        <li>
            <a href="{{ route('chat.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">
                Messages
            </a>
        </li>

        <li>
            <a href="{{ route('drive.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">Drive</a>
        </li>
        <li>
            <a href="{{ route('emploi_du_temps.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">Emploi du temps</a>
        </li>
        <li>
            <a href="{{ route('notes.index') }}" class="block px-3 py-2 rounded hover:bg-gray-200">Notes des étudiants</a>
        </li>
        <li>
            <a href="{{ route('ajouter_devoir.create') }}" class="block px-3 py-2 rounded hover:bg-gray-200">Ajouter un devoir</a>
        </li>
    </ul>
</div>
