<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Requête validée pour la création et la mise à jour d'un projet.
 * Messages d'erreur en français.
 */
class ProjectRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Règles de validation (store et update).
     *
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        $titreRule = $this->route('project')
            ? ['sometimes', 'required', 'string', 'max:255']
            : ['required', 'string', 'max:255'];

        return [
            'titre' => $titreRule,
            'description' => ['nullable', 'string', 'max:5000'],
            'lien_github' => ['nullable', 'string', 'url', 'max:500'],
            'lien_demo' => ['nullable', 'string', 'url', 'max:500'],
            'image' => ['nullable', 'image', 'max:2048'],
            'images' => ['nullable', 'array', 'max:12'],
            'images.*' => ['image', 'max:2048'],
            'date_debut' => ['nullable', 'date'],
            'date_fin' => ['nullable', 'date', 'after_or_equal:date_debut'],
            'skill_ids' => ['nullable', 'array'],
            'skill_ids.*' => ['integer', Rule::exists('competences', 'id')],
            'skill_names' => ['nullable', 'array'],
            'skill_names.*' => ['string', 'max:255'],
        ];
    }

    /**
     * Messages de validation personnalisés (français).
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'titre.required' => 'Le titre du projet est obligatoire.',
            'titre.max' => 'Le titre ne peut pas dépasser :max caractères.',
            'description.max' => 'La description ne peut pas dépasser :max caractères.',
            'lien_github.url' => 'Le lien GitHub doit être une URL valide.',
            'lien_github.max' => 'Le lien GitHub ne peut pas dépasser :max caractères.',
            'lien_demo.url' => 'Le lien de la démo doit être une URL valide.',
            'lien_demo.max' => 'Le lien de la démo ne peut pas dépasser :max caractères.',
            'image.image' => 'L\'image du projet doit être un fichier image (JPEG, PNG, GIF, WebP).',
            'image.max' => 'L\'image ne peut pas dépasser :max Ko.',
            'images.max' => 'Vous ne pouvez pas ajouter plus de :max images à la galerie.',
            'images.*.image' => 'Chaque fichier de la galerie doit être une image (JPEG, PNG, GIF, WebP).',
            'images.*.max' => 'Chaque image de la galerie ne peut pas dépasser :max Ko.',
            'date_debut.date' => 'La date de début doit être une date valide.',
            'date_fin.date' => 'La date de fin doit être une date valide.',
            'date_fin.after_or_equal' => 'La date de fin doit être postérieure ou égale à la date de début.',
            'skill_ids.*.exists' => 'Une ou plusieurs compétences sélectionnées sont invalides.',
        ];
    }

    /**
     * Attributs pour les messages (libellés des champs).
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'titre' => 'titre du projet',
            'description' => 'description',
            'lien_github' => 'lien GitHub',
            'lien_demo' => 'lien de la démo',
            'image' => 'image du projet',
            'images' => 'galerie d\'images',
            'date_debut' => 'date de début',
            'date_fin' => 'date de fin',
            'skill_ids' => 'compétences',
            'skill_names' => 'noms des compétences',
        ];
    }
}
