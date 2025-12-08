<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id_commentaire
 * @property string $texte
 * @property int|null $note
 * @property string $date
 * @property int $id_utilisateur
 * @property int $id_contenu
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\Contenu $contenu
 * @property-read \App\Models\User $utilisateur
 * @method static \Database\Factories\CommentaireFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereIdCommentaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereIdContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereIdUtilisateur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereTexte($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Commentaire whereUpdatedAt($value)
 */
	class Commentaire extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \App\Models\User $auteur
 * @property-read \App\Models\User $moderateur
 * @property-read \App\Models\Region $region
 * @property-read \App\Models\Langue $langue
 * @property-read \App\Models\TypeContenu $typeContenu
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Commentaire[] $commentaires
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Media[] $medias
 * @property int $id_contenu
 * @property string $titre
 * @property string|null $texte
 * @property \Illuminate\Support\Carbon $date_creation
 * @property string $statut
 * @property int|null $parent_id
 * @property int $id_region
 * @property int $id_langue
 * @property int|null $id_moderateur
 * @property int $id_type_contenu
 * @property int $id_auteur
 * @property \Illuminate\Support\Carbon|null $date_validation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $commentaires_count
 * @property-read int|null $medias_count
 * @method static \Database\Factories\ContenuFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu whereDateCreation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu whereDateValidation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu whereIdAuteur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu whereIdContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu whereIdLangue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu whereIdModerateur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu whereIdRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu whereIdTypeContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu whereTexte($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu whereTitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contenu whereUpdatedAt($value)
 */
	class Contenu extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_langue
 * @property string $nom_langue
 * @property string|null $code_langue
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\LangueFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue whereCodeLangue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue whereIdLangue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue whereNomLangue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Langue whereUpdatedAt($value)
 */
	class Langue extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_media
 * @property string $chemin
 * @property string|null $description
 * @property int $id_contenu
 * @property int $id_type_media
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Contenu $contenu
 * @property-read \App\Models\TypeMedia $typeMedia
 * @method static \Database\Factories\MediaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereChemin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereIdContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereIdMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereIdTypeMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Media whereUpdatedAt($value)
 */
	class Media extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_parler
 * @property int $id_region
 * @property int $id_langue
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Langue $langue
 * @property-read \App\Models\Region $region
 * @method static \Database\Factories\ParlerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler whereIdLangue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler whereIdParler($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler whereIdRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parler whereUpdatedAt($value)
 */
	class Parler extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_region
 * @property string $nom_region
 * @property string|null $description
 * @property int|null $population
 * @property float|null $superficie
 * @property string|null $localisation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contenu> $contenus
 * @property-read int|null $contenus_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Parler> $parler
 * @property-read int|null $parler_count
 * @method static \Database\Factories\RegionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereIdRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereLocalisation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereNomRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region wherePopulation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereSuperficie($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Region whereUpdatedAt($value)
 */
	class Region extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nom_role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Database\Factories\RoleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereNomRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_type_contenu
 * @property string $nom_contenu
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Contenu> $contenus
 * @property-read int|null $contenus_count
 * @method static \Database\Factories\TypeContenuFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeContenu newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeContenu newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeContenu query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeContenu whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeContenu whereIdTypeContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeContenu whereNomContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeContenu whereUpdatedAt($value)
 */
	class TypeContenu extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id_type_media
 * @property string $nom_media
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Media> $medias
 * @property-read int|null $medias_count
 * @method static \Database\Factories\TypeMediaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeMedia newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeMedia newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeMedia query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeMedia whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeMedia whereIdTypeMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeMedia whereNomMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TypeMedia whereUpdatedAt($value)
 */
	class TypeMedia extends \Eloquent {}
}

namespace App\Models{
/**
 * @property-read \App\Models\Role $role
 * @property-read \App\Models\Langue $langue
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contenu[] $contenus
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Contenu[] $contenusModeres
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Commentaire[] $commentaires
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Media[] $medias
 * @property int $id
 * @property string $name
 * @property string $prenom
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $sexe
 * @property \Illuminate\Support\Carbon|null $date_naissance
 * @property \Illuminate\Support\Carbon $date_inscription
 * @property string $statut
 * @property string|null $photo
 * @property int|null $id_role
 * @property int|null $id_langue
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read int|null $commentaires_count
 * @property-read int|null $contenus_count
 * @property-read int|null $contenus_moderes_count
 * @property-read int|null $medias_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDateInscription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDateNaissance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdLangue($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereIdRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereSexe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

