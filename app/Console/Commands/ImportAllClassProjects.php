<?php

namespace App\Console\Commands;

use App\Models\ClassProject;
use App\Services\GoogleSheetsServices;
use Google\Exception;
use Illuminate\Console\Command;

class ImportAllClassProjects extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:class-project {range} {sheetId?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import class projects from Google Spread Sheet';

    /**
     * Execute the console command.
     *
     * @throws Exception
     */
    public function handle()
    {
        $sheetId = $this->argument('sheetId') ?? config('settings.sheets.class_project');

        if (is_null($sheetId)) {
            $this->error('sheet ID is empty. Please input');
            $sheetId = $this->ask('Input class project sheet ID');
        }

        $records = (new GoogleSheetsServices)
            ->readSheet(
                sheetId: $sheetId,
                range: $this->argument('range')
            );

        $insert_data = [];
        $leaders = [];

        // Customize it to fit your own format
        $projectType = ['体験型', '模擬店 (収益あり)', '模擬店 (収益なし)'];

        foreach ($records as $record) {
            $insert_data[] = [
                'school_class_code' => (int) mb_substr($record[7], 0, 5),
                'name' => $record[10],
                'detail' => $record[11],
                'type' => array_search($record[27], $projectType),
                'provide_meals' => $record[28] === '行う',
                'paid_planning' => $record[27] === $projectType[1],
                'infection_control' => $record[18],
                'created_at' => now(),
                'updated_at' => now(),
            ];
            $leaders[] = [
                'school_class_code' => (int) mb_substr($record[7], 0, 5),
                'user_email' => $record[6],
            ];
        }

        ClassProject::insert($insert_data);

        foreach ($leaders as $leader) {
            $project = ClassProject::query()->where('school_class_code', $leader['school_class_code'])->first();


            $project->leaders()->attach($leader['user_email']);
        }

        $this->info('import successfully ✨');
    }
}
