<?php

namespace Database\Seeders;

use App\Models\Song;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $songs = json_decode(file_get_contents(database_path('seeders/songs.json')), true);
        $this->command->info('Seeding songs...');
        foreach ($songs as $song) {
            Song::query()
                ->firstOrCreate([
                    'slug' => $song['slug'],
                ], [
                    'title' => $song['title'],
                    'song_url' => config('app.url').$song['song_url'],
                    'cover' => $song['cover'],
                    'status' => $song['status'],
                    'duration' => $song['duration'],
                ]);
        }

        $this->command->info('Seeding completed...');
    }
}
