<div class="p-4 bg-white h-full">
    <h2 class="text-xl font-bold mb-4">Menu Étudiant</h2>
    <ul class="space-y-2">
        <!-- Tableau de bord -->
        <li>
            <a href="{{ route('dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-gray-200">
                Tableau de bord
            </a>
        </li>

        <!-- Messages -->
        <li>
            <a href="{{ route('messages.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-200">
                Messages
            </a>
        </li>

        <!-- Drive -->
        <li>
            <a href="{{ route('drive.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-200">
                Drive
            </a>
        </li>

        <!-- Emploi du temps -->
        <li>
            <a href="{{ route('emploi_du_temps.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-200">
                Emploi du temps
            </a>
        </li>

        <!-- Cahier de texte -->
        <li>
            <a href="{{ route('cahier_de_texte.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-200">
                Cahier de texte
            </a>
        </li>

        <!-- Mes Notes -->
        <li>
            <a href="{{ route('mes_notes.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-200">
                Mes Notes
            </a>
        </li>
    </ul>
</div>
