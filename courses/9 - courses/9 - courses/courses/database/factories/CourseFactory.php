<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $levels = ['débutant', 'intermédiaire', 'avancé'];
        $subjects = [
            'Développement Web',
            'Intelligence Artificielle',
            'Marketing Digital',
            'Gestion de Projet',
            'Communication d\'Entreprise',
            'Design Graphique',
            'Analyse de Données',
            'Langues Étrangères',
            'Comptabilité et Finance',
            'Ressources Humaines'
        ];

        // Define API endpoints
        $apis = [
            'dog' => 'https://dog.ceo/api/breeds/image/random',
            'cat' => 'https://api.thecatapi.com/v1/images/search',
            'person' => 'https://randomuser.me/api/?inc=picture',
            'car' => 'https://api.unsplash.com/photos/random?query=car&client_id=0ki1tD5vchlNaiH0st86LSfzBhZeOaX5ZzbrDKGKT4U',
            'house' => 'https://api.unsplash.com/photos/random?query=house&client_id=0ki1tD5vchlNaiH0st86LSfzBhZeOaX5ZzbrDKGKT4U'
        ];

        $defaultImage = 'https://ui-avatars.com/api/?name=Course&background=random&color=fff';
        $imageUrl = $defaultImage;

        // Try to fetch a random image from a random API
        try {
            $selectedApi = array_rand($apis);
            $response = Http::withoutVerifying()->get($apis[$selectedApi]);

            if ($response->successful()) {
                $result = $response->json();
                switch ($selectedApi) {
                    case 'dog':
                        $imageUrl = $result['message'] ?? $defaultImage;
                        break;
                    case 'cat':
                        $imageUrl = $result[0]['url'] ?? $defaultImage;
                        break;
                    case 'person':
                        $imageUrl = $result['results'][0]['picture']['large'] ?? $defaultImage;
                        break;
                    case 'car':
                    case 'house':
                        $imageUrl = $result['urls']['regular'] ?? $defaultImage;
                        break;
                }
            }
        } catch (\Exception $e) {
            // Fallback to default avatar if any error occurs
            $imageUrl = $defaultImage;
        }

        $title = fake()->randomElement($subjects);
        return [
            'teacher_id' => User::factory()->state(['role' => 'teacher']),
            'title' => $title . ' - ' . fake()->words(3, true),
            'description' => '<div class="course-description">' . implode('</p><p>', fake('fr_FR')->paragraphs(2)) . '</p></div>',
            'content' => '<div class="course-content">' . implode('</p><p>', fake('fr_FR')->paragraphs(5)) . '</p></div>',
            'image' => $imageUrl,
            'level' => fake()->randomElement($levels),
            'duration' => fake()->numberBetween(30, 300),
            'is_published' => fake()->boolean(80), // 80% chance of being published
        ];
    }

    /**
     * Indicate that the course is published.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
        ]);
    }
}