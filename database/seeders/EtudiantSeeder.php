<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Etudiant;
use App\Models\Ville;
use App\Models\User;

class EtudiantSeeder extends Seeder
{
    /**
     * Exécute les opérations de remplissage.
     */
    public function run(): void
    {
        // Récupérer tous les IDs de villes disponibles
        $villeIds = Ville::pluck('id');

        // Créer un utilisateur de démonstration s'il n'existe pas
        $demoUser = User::firstOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'Utilisateur Démo',
                'password' => bcrypt('password')
            ]
        );

        // Récupérer les utilisateurs existants user1 et user2
        $user1 = User::where('email', 'user1@example.com')->first();
        $user2 = User::where('email', 'user2@example.com')->first();

        // Vérification : tous les utilisateurs doivent exister
        if (!$demoUser || !$user1 || !$user2) {
            $this->command->error("Un ou plusieurs utilisateurs n'ont pas été trouvés.");
            return;
        }

        // Créer les étudiants uniquement si l'utilisateur n'en a pas encore
        if ($demoUser->etudiants()->count() === 0) {
            Etudiant::factory()->count(100)->create([
                'user_id' => $demoUser->id,
            ])->each(function ($etudiant) use ($villeIds) {
                $etudiant->ville_id = $villeIds->random();
                $etudiant->save();
            });
        }

        if ($user1->etudiants()->count() === 0) {
            Etudiant::factory()->count(40)->create([
                'user_id' => $user1->id,
            ])->each(function ($etudiant) use ($villeIds) {
                $etudiant->ville_id = $villeIds->random();
                $etudiant->save();
            });
        }

        if ($user2->etudiants()->count() === 0) {
            Etudiant::factory()->count(30)->create([
                'user_id' => $user2->id,
            ])->each(function ($etudiant) use ($villeIds) {
                $etudiant->ville_id = $villeIds->random();
                $etudiant->save();
            });
        }

        // Message de confirmation dans la console
        $this->command->info('Les étudiants ont été créés uniquement pour les utilisateurs qui n’en avaient pas déjà.');
    }
}
