<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Media;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class CloudinaryController extends Controller
{
    /**
     * Upload une image pour un média
     */
    public function uploadMedia(Request $request, $id = null)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
            'description' => 'nullable|string|max:255',
            'id_contenu' => 'required|exists:contenus,id_contenu',
            'id_type_media' => 'required|exists:type_medias,id_type_media'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            if ($id) {
                $media = Media::findOrFail($id);
            } else {
                $media = new Media();
                $media->id_contenu = $request->id_contenu;
                $media->id_type_media = $request->id_type_media;
                $media->description = $request->description;
            }

            // Upload vers Cloudinary
            $success = $media->uploadAndAttachImage(
                $request->file('image'),
                $request->description ?? 'media'
            );

            if ($success) {
                $media->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Média uploadé avec succès sur Cloudinary',
                    'media' => $media,
                    'image_url' => $media->image_url,
                    'thumbnail_url' => $media->thumbnail_url
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Échec de l\'upload sur Cloudinary'
                ], 500);
            }

        } catch (\Exception $e) {
            Log::error('Cloudinary upload error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Upload une photo de profil
     */
    public function uploadProfilePhoto(Request $request, $userId)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $user = User::findOrFail($userId);

            // Upload vers Cloudinary
            $success = $user->uploadAndAttachImage(
                $request->file('photo'),
                $user->name . '_' . $user->prenom
            );

            if ($success) {
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Photo de profil uploadée avec succès',
                    'photo_url' => $user->image_url
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Échec de l\'upload de la photo'
                ], 500);
            }

        } catch (\Exception $e) {
            Log::error('Profile photo upload error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Migration des images locales vers Cloudinary
     */
    public function migrateLocalImages(Request $request)
    {
        try {
            $service = app(\App\Services\CloudinaryService::class);

            if (!$service->isConfigured()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cloudinary non configuré'
                ], 400);
            }

            $table = $request->input('table', 'medias');
            $limit = $request->input('limit', 10);

            if ($table === 'medias') {
                $items = Media::where('has_cloudinary', false)
                    ->orWhereNull('has_cloudinary')
                    ->take($limit)
                    ->get();

                $migrated = 0;
                $failed = 0;

                foreach ($items as $media) {
                    if ($media->chemin) {
                        $localPath = public_path('adminlte/img/' . $media->chemin);

                        if (file_exists($localPath)) {
                            $result = $service->migrateLocalImage(
                                $localPath,
                                'medias',
                                $media->id_media
                            );

                            if ($result['success']) {
                                $media->cloudinary_url = $result['url'];
                                $media->cloudinary_public_id = $result['public_id'];
                                $media->has_cloudinary = true;
                                $media->image_thumbnail = str_replace('/upload/', '/upload/c_fill,w_300,h_300,q_auto/', $result['url']);
                                $media->save();
                                $migrated++;
                            } else {
                                $failed++;
                            }
                        }
                    }
                }

                return response()->json([
                    'success' => true,
                    'message' => "Migration terminée",
                    'migrated' => $migrated,
                    'failed' => $failed
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Table non supportée'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
