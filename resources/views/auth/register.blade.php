<x-guest-layout>
    <div class="bg-white/90 backdrop-blur-md shadow-2xl rounded-2xl p-8 w-full max-w-xl max-h-[85vh] overflow-y-auto">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-red-700 drop-shadow">Inscription – Culture & Langues du Bénin</h2>
            <p class="text-gray-700 mt-1">Créez votre compte pour accéder à la plateforme</p>
        </div>

        <!-- Affichage des erreurs -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Nom -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-800">Nom</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                       class="mt-1 block w-full rounded-lg border-gray-300 p-3 focus:border-red-500 focus:ring-red-300 focus:ring-2">
            </div>

            <!-- Prénom -->
            <div>
                <label for="prenom" class="block text-sm font-semibold text-gray-800">Prénom</label>
                <input id="prenom" type="text" name="prenom" value="{{ old('prenom') }}" required
                       class="mt-1 block w-full rounded-lg border-gray-300 p-3 focus:border-red-500 focus:ring-red-300 focus:ring-2">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-800">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                       class="mt-1 block w-full rounded-lg border-gray-300 p-3 focus:border-red-500 focus:ring-red-300 focus:ring-2">
            </div>

            <!-- Mot de passe -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-800">Mot de passe</label>
                <input id="password" type="password" name="password" required
                       class="mt-1 block w-full rounded-lg border-gray-300 p-3 focus:border-red-500 focus:ring-red-300 focus:ring-2">
            </div>

            <!-- Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-800">Confirmer le mot de passe</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                       class="mt-1 block w-full rounded-lg border-gray-300 p-3 focus:border-red-500 focus:ring-red-300 focus:ring-2">
            </div>

            <!-- Sexe -->
            <div>
                <label for="sexe" class="block text-sm font-semibold text-gray-800">Sexe</label>
                <select id="sexe" name="sexe" required
                        class="mt-1 block w-full rounded-lg border-gray-300 p-3 focus:border-red-500 focus:ring-red-300 focus:ring-2">
                    <option value="">Sélectionnez</option>
                    <option value="M" {{ old('sexe')=='M' ? 'selected' : '' }}>Masculin</option>
                    <option value="F" {{ old('sexe')=='F' ? 'selected' : '' }}>Féminin</option>
                </select>
            </div>

            <!-- Date de naissance -->
            <div>
                <label for="date_naissance" class="block text-sm font-semibold text-gray-800">Date de naissance</label>
                <input id="date_naissance" type="date" name="date_naissance" value="{{ old('date_naissance') }}" required
                       class="mt-1 block w-full rounded-lg border-gray-300 p-3 focus:border-red-500 focus:ring-red-300 focus:ring-2">
            </div>

            <!-- Photo profil -->
            <div>
                <label for="photo" class="block text-sm font-semibold text-gray-800">Photo de profil</label>
                <input id="photo" type="file" name="photo"
                       class="mt-1 block w-full rounded-lg border-gray-300 p-2 focus:border-red-500 focus:ring-red-300 focus:ring-2">
            </div>

            <!-- Rôle -->
            <div>
                <label for="id_role" class="block text-sm font-semibold text-gray-800">Rôle</label>
                <select id="id_role" name="id_role" required
                        class="mt-1 block w-full rounded-lg border-gray-300 p-3 focus:border-red-500 focus:ring-red-300 focus:ring-2">
                    <option value="">Sélectionnez un rôle</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('id_role')==$role->id ? 'selected' : '' }}>{{ $role->nom_role }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Langue -->
            <div>
                <label for="id_langue" class="block text-sm font-semibold text-gray-800">Langue</label>
                <select id="id_langue" name="id_langue" required
                        class="mt-1 block w-full rounded-lg border-gray-300 p-3 focus:border-red-500 focus:ring-red-300 focus:ring-2">
                    <option value="">Sélectionnez une langue</option>
                    @foreach($langues as $langue)
                        <option value="{{ $langue->id_langue }}" {{ old('id_langue')==$langue->id_langue ? 'selected' : '' }}>{{ $langue->nom_langue }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Bouton -->
            <div class="flex justify-end mt-6">
                <button type="submit"
                        class="py-3 px-6 bg-red-600 hover:bg-red-700 text-white font-bold rounded-lg shadow-lg transition">
                    S’inscrire
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
