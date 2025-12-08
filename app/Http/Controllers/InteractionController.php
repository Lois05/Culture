<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contenu;
use App\Models\Commentaire;
use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InteractionController extends Controller
{
    /**
     * Toggle like sur un contenu
     */
    public function toggleLike($id)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Connectez-vous pour aimer ce contenu'
                ], 401);
            }

            $contenu = Contenu::findOrFail($id);

            // Vérifier si l'utilisateur a déjà liké
            $existingLike = DB::table('likes')
                ->where('user_id', $user->id)
                ->where('contenu_id', $id)
                ->first();

            if ($existingLike) {
                // Retirer le like
                DB::table('likes')
                    ->where('user_id', $user->id)
                    ->where('contenu_id', $id)
                    ->delete();

                $action = 'unliked';
            } else {
                // Ajouter le like
                DB::table('likes')->insert([
                    'user_id' => $user->id,
                    'contenu_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $action = 'liked';
            }

            // Compter les likes
            $likesCount = DB::table('likes')->where('contenu_id', $id)->count();

            return response()->json([
                'success' => true,
                'action' => $action,
                'likes_count' => $likesCount,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle favori sur un contenu
     */
    public function toggleFavorite($id)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Connectez-vous pour ajouter aux favoris'
                ], 401);
            }

            $contenu = Contenu::findOrFail($id);

            // Vérifier si l'utilisateur a déjà mis en favori
            $existingFavorite = DB::table('favoris')
                ->where('user_id', $user->id)
                ->where('contenu_id', $id)
                ->first();

            if ($existingFavorite) {
                // Retirer des favoris
                DB::table('favoris')
                    ->where('user_id', $user->id)
                    ->where('contenu_id', $id)
                    ->delete();

                $action = 'unfavorited';
            } else {
                // Ajouter aux favoris
                DB::table('favoris')->insert([
                    'user_id' => $user->id,
                    'contenu_id' => $id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $action = 'favorited';
            }

            // Compter les favoris
            $favoritesCount = DB::table('favoris')->where('contenu_id', $id)->count();

            return response()->json([
                'success' => true,
                'action' => $action,
                'favorites_count' => $favoritesCount,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Ajouter un commentaire
     */
    public function addComment(Request $request, $id)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Connectez-vous pour commenter'
                ], 401);
            }

            $contenu = Contenu::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'comment_text' => 'required|string|min:3|max:1000',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            // Créer le commentaire
            $commentaire = Commentaire::create([
                'texte' => $request->comment_text,
                'date' => now(),
                'user_id' => $user->id,
                'id_contenu' => $id,
            ]);

            // Charger les relations
            $commentaire->load('utilisateur', 'utilisateur.role');

            // Récupérer le HTML du commentaire
            $html = view('partials.comment-item', ['commentaire' => $commentaire])->render();

            // Compter les commentaires
            $commentsCount = $contenu->commentaires()->count();

            return response()->json([
                'success' => true,
                'message' => 'Commentaire ajouté',
                'comment_html' => $html,
                'comments_count' => $commentsCount,
                'comment' => $commentaire
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle follow sur un auteur
     */
    public function toggleFollow($authorId)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Connectez-vous pour suivre'
                ], 401);
            }

            $author = User::findOrFail($authorId);

            // Empêcher de se suivre soi-même
            if ($user->id == $authorId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vous ne pouvez pas vous suivre vous-même'
                ], 400);
            }

            // Vérifier si l'utilisateur suit déjà
            $existingFollow = DB::table('followers')
                ->where('follower_id', $user->id)
                ->where('following_id', $authorId)
                ->first();

            if ($existingFollow) {
                // Arrêter de suivre
                DB::table('followers')
                    ->where('follower_id', $user->id)
                    ->where('following_id', $authorId)
                    ->delete();

                $action = 'unfollowed';
            } else {
                // Commencer à suivre
                DB::table('followers')->insert([
                    'follower_id' => $user->id,
                    'following_id' => $authorId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $action = 'followed';
            }

            // Compter les followers
            $followersCount = DB::table('followers')
                ->where('following_id', $authorId)
                ->count();

            return response()->json([
                'success' => true,
                'action' => $action,
                'followers_count' => $followersCount,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Récupérer les commentaires d'un contenu
     */
    public function getComments($id)
    {
        try {
            $contenu = Contenu::with([
                'commentaires' => function($query) {
                    $query->with('utilisateur', 'utilisateur.role')
                          ->orderBy('date', 'desc')
                          ->limit(10);
                }
            ])->findOrFail($id);

            $html = view('partials.comments-list', [
                'contenu' => $contenu,
                'commentaires' => $contenu->commentaires
            ])->render();

            return response()->json([
                'success' => true,
                'html' => $html
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Vérifier l'état des interactions de l'utilisateur
     */
    public function checkUserInteractions($id)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'success' => true,
                    'user_has_liked' => false,
                    'user_has_favorited' => false,
                    'user_is_following' => false
                ]);
            }

            $contenu = Contenu::findOrFail($id);

            // Vérifier les likes
            $userHasLiked = DB::table('likes')
                ->where('utilisateur_id', $user->id)
                ->where('contenu_id', $id)
                ->exists();

            // Vérifier les favoris
            $userHasFavorited = DB::table('favoris')
                ->where('utilisateur_id', $user->id)
                ->where('contenu_id', $id)
                ->exists();

            // Vérifier le follow (si l'auteur existe)
            $userIsFollowing = false;
            if ($contenu->auteur) {
                $userIsFollowing = DB::table('followers')
                    ->where('follower_id', $user->id)
                    ->where('following_id', $contenu->auteur->id)
                    ->exists();
            }

            return response()->json([
                'success' => true,
                'user_has_liked' => $userHasLiked,
                'user_has_favorited' => $userHasFavorited,
                'user_is_following' => $userIsFollowing
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Partager un contenu (incrémenter le compteur de partages)
     */
    public function shareContent($id)
    {
        try {
            // Incrémenter le compteur dans la table 'shares'
            DB::table('shares')->updateOrInsert(
                ['contenu_id' => $id],
                ['count' => DB::raw('count + 1'), 'updated_at' => now()]
            );

            // Récupérer le nouveau compteur
            $shareData = DB::table('shares')->where('contenu_id', $id)->first();
            $sharesCount = $shareData ? $shareData->count : 1;

            return response()->json([
                'success' => true,
                'shares_count' => $sharesCount,
                'share_url' => route('front.contenu', $id)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }
}
