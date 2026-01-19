<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DatabaseImport extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'db:import 
                            {file : SQL file to import}
                            {--dry-run : Show what would be imported without executing}';

    /**
     * The console command description.
     */
    protected $description = 'Import SQL file into the database';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $file = $this->argument('file');
        $filePath = base_path($file);

        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return Command::FAILURE;
        }

        $this->info("Importing: {$filePath}");
        $this->info("Target database: " . config('database.connections.mysql.database'));
        $this->newLine();

        if (!$this->option('dry-run')) {
            if (!$this->confirm('This will INSERT data into your database. Continue?', true)) {
                $this->info('Cancelled.');
                return Command::SUCCESS;
            }
        }

        $sql = file_get_contents($filePath);
        $statements = $this->parseStatements($sql);

        $this->info("Found " . count($statements) . " statements to execute");
        $this->newLine();

        if ($this->option('dry-run')) {
            $this->warn("DRY RUN - No changes will be made");
            $this->newLine();
            
            foreach (array_slice($statements, 0, 10) as $stmt) {
                $this->line("  " . substr($stmt, 0, 80) . (strlen($stmt) > 80 ? '...' : ''));
            }
            
            if (count($statements) > 10) {
                $this->line("  ... and " . (count($statements) - 10) . " more statements");
            }
            
            return Command::SUCCESS;
        }

        $bar = $this->output->createProgressBar(count($statements));
        $bar->start();

        $success = 0;
        $errors = [];

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        foreach ($statements as $statement) {
            try {
                DB::unprepared($statement);
                $success++;
            } catch (\Exception $e) {
                $errors[] = [
                    'statement' => substr($statement, 0, 100),
                    'error' => $e->getMessage(),
                ];
            }
            $bar->advance();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        $bar->finish();
        $this->newLine(2);

        $this->info("✓ Successfully executed: {$success} statements");

        if (!empty($errors)) {
            $this->warn("✗ Failed: " . count($errors) . " statements");
            $this->newLine();
            
            if ($this->confirm('Show error details?', false)) {
                foreach ($errors as $error) {
                    $this->error("Statement: " . $error['statement'] . "...");
                    $this->line("  Error: " . $error['error']);
                    $this->newLine();
                }
            }
        }

        return Command::SUCCESS;
    }

    /**
     * Parse SQL file into individual statements.
     */
    protected function parseStatements(string $sql): array
    {
        $statements = [];
        $lines = explode("\n", $sql);
        $currentStatement = '';

        foreach ($lines as $line) {
            $trimmed = trim($line);
            
            // Skip comments and empty lines
            if (empty($trimmed) || str_starts_with($trimmed, '--') || str_starts_with($trimmed, '/*')) {
                continue;
            }

            $currentStatement .= $line . "\n";

            // If line ends with semicolon, it's end of statement
            if (str_ends_with($trimmed, ';')) {
                $stmt = trim($currentStatement);
                if (!empty($stmt) && $stmt !== ';') {
                    $statements[] = $stmt;
                }
                $currentStatement = '';
            }
        }

        return $statements;
    }
}
