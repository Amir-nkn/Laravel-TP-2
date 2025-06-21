<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Fabrique pour générer des données fictives pour le modèle Etudiant.
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Etudiant>
 */
class EtudiantFactory extends Factory
{
    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Génère un nom aléatoire
            'nom' => $this->faker->name(),

            // Génère une adresse aléatoire
            'adresse' => $this->faker->address(),

            // Génère un numéro de téléphone réaliste
            'telephone' => $this->faker->phoneNumber(),

            // Génère une adresse email unique et sécurisée
            'email' => $this->faker->unique()->safeEmail(),

            // Génère une date de naissance aléatoire
            'date_naissance' => $this->faker->date(),

            // Associe une ville existante aléatoire (ID entre 1 et 15)
            'ville_id' => rand(1, 15),
        ];
    }
}
