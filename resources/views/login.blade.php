<!-- Nom -->
<div>
    <x-input-label for="name" :value="__('Nom')" />
    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
    <x-input-error :messages="$errors->get('name')" class="mt-2" />
</div>

<!-- Prénom -->
<div class="mt-4">
    <x-input-label for="prenom" :value="__('Prénom')" />
    <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required />
    <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
</div>

<!-- Sexe -->
<div class="mt-4">
    <x-input-label for="sexe" :value="__('Sexe')" />
    <select id="sexe" name="sexe" class="block mt-1 w-full border-gray-300 rounded-md">
        <option value="M">Masculin</option>
        <option value="F">Féminin</option>
    </select>
    <x-input-error :messages="$errors->get('sexe')" class="mt-2" />
</div>

<!-- Date de naissance -->
<div class="mt-4">
    <x-input-label for="date_naissance" :value="__('Date de naissance')" />
    <x-text-input id="date_naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="old('date_naissance')" required />
    <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
</div>

<!-- Rôle -->
<div class="mt-4">
    <x-input-label for="id_role" :value="__('Rôle')" />
    <select id="id_role" name="id_role" class="block mt-1 w-full border-gray-300 rounded-md">
        <option value="1">Administrateur</option>
        <option value="2">Modérateur</option>
        <option value="3">Contributeur</option>
        <option value="4">Lecteur</option>
    </select>
    <x-input-error :messages="$errors->get('id_role')" class="mt-2" />
</div>

<!-- Langue -->
<div class="mt-4">
    <x-input-label for="id_langue" :value="__('Langue')" />
    <select id="id_langue" name="id_langue" class="block mt-1 w-full border-gray-300 rounded-md">
        <option value="1">Français</option>
        <option value="2">Anglais</option>
        <option value="3">Fon</option>
    </select>
    <x-input-error :messages="$errors->get('id_langue')" class="mt-2" />
</div>

<!-- Email -->
<div class="mt-4">
    <x-input-label for="email" :value="__('Email')" />
    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
    <x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<!-- Mot de passe -->
<div class="mt-4">
    <x-input-label for="password" :value="__('Mot de passe')" />
    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
    <x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<!-- Confirmation mot de passe -->
<div class="mt-4">
    <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>
