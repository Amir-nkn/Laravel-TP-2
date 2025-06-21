<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Fabrique pour générer des utilisateurs fictifs dans la base de données.
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Mot de passe utilisé pour tous les utilisateurs générés.
     * Il est stocké une seule fois pour éviter plusieurs hashages.
     */
    protected static ?string $password;

    /**
     * Définir l'état par défaut du modèle User.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Génère un nom complet aléatoire
            'name' => fake()->name(),

            // Génère une adresse email unique et sécurisée
            'email' => fake()->unique()->safeEmail(),

            // Marque l'email comme vérifié à la date actuelle
            'email_verified_at' => now(),

            // Hash du mot de passe "password" utilisé pour tous les utilisateurs
            'password' => static::$password ??= Hash::make('password'),

            // Génère un token de session aléatoire
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indique que l'email de l'utilisateur n'est pas vérifié.
     *
     * @return static
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
