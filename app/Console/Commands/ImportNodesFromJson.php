<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Node;
use Illuminate\Support\Facades\File;

class ImportNodesFromJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = base_path('datasource/messaging.json');

        if (!File::exists($filePath)) {
            $this->error("File not found: $filePath");
            return 1;
        }

        $json = File::get($filePath);
        $data = json_decode($json, true);

        if (!isset($data['data']['msps']['edges'])) {
            $this->error("Invalid JSON structure.");
            return 1;
        }

        $edges = $data['data']['msps']['edges'];
        $imported = 0;

        foreach ($edges as $edge) {
            $nodeData = $edge['node'];
            $externalId = $nodeData['id'];

            if (Node::where('external_id', $externalId)->exists()) {
                $this->line("Skipping existing node: $externalId");
                continue;
            }

            Node::create([
                'external_id' => $externalId,
                'name' => $nodeData['name'] ?? null,
                'company_website' => $nodeData['company_website'] ?? null,
                'description' => $nodeData['description'] ?? null,
                'is_badged' => $nodeData['is_badged'] ?? false,
                'profile_picture_uri' => $nodeData['msp_profile_picture']['image']['uri'] ?? null,
                'countries' => $nodeData['countries'] ?? [],
                'industries' => $nodeData['industries'] ?? [],
                'focus_areas' => $nodeData['focus_areas'] ?? [],
                'facebook_platforms' => $nodeData['facebook_platforms'] ?? [],
                'language_tags' => $nodeData['language_tags'] ?? [],
                'service_models' => $nodeData['service_models'] ?? [],
                'solution_types' => $nodeData['solution_types'] ?? [],
                'solution_subtypes' => $nodeData['solution_subtypes'] ?? [],
                'diverse_owned_identities' => $nodeData['diverse_owned_identities'] ?? [],
            ]);

            $imported++;
            $this->info("Imported node: {$nodeData['name']}");
        }

        $this->info("✅ $imported new node(s) imported successfully.");

        return 0;
    }
}
