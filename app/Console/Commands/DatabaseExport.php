<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseExport extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'db:export 
                            {--tables= : Comma-separated list of tables to export (default: all)}
                            {--output=database_export.sql : Output filename}';

    /**
     * The console command description.
     */
    protected $description = 'Export database contents as SQL INSERT statements';

    /**
     * Tables to skip (Laravel system tables).
     */
    protected array $skipTables = [
        'migrations',
        'cache',
        'cache_locks',
        'jobs',
        'job_batches',
        'failed_jobs',
        'sessions',
        'password_reset_tokens',
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $outputFile = $this->option('output');
        $tablesOption = $this->option('tables');
        
        // Get tables to export
        if ($tablesOption) {
            $tables = array_map('trim', explode(',', $tablesOption));
        } else {
            $tables = $this->getAllTables();
        }

        $this->info("Exporting database: " . config('database.connections.mysql.database'));
        $this->newLine();

        $sql = $this->generateHeader();
        
        $bar = $this->output->createProgressBar(count($tables));
        $bar->start();

        foreach ($tables as $table) {
            if (in_array($table, $this->skipTables) && !$tablesOption) {
                $bar->advance();
                continue;
            }

            $sql .= $this->exportTable($table);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);

        // Write to file
        $outputPath = base_path($outputFile);
        file_put_contents($outputPath, $sql);

        $this->info("✓ Exported to: {$outputPath}");
        $this->info("  File size: " . $this->formatBytes(filesize($outputPath)));

        return Command::SUCCESS;
    }

    /**
     * Get all tables in the database.
     */
    protected function getAllTables(): array
    {
        $tables = [];
        $result = DB::select('SHOW TABLES');
        $key = 'Tables_in_' . config('database.connections.mysql.database');

        foreach ($result as $row) {
            $tables[] = $row->$key;
        }

        return $tables;
    }

    /**
     * Generate SQL header.
     */
    protected function generateHeader(): string
    {
        $dbName = config('database.connections.mysql.database');
        $date = now()->format('Y-m-d H:i:s');

        return <<<SQL
-- ============================================
-- Database Export: {$dbName}
-- Generated: {$date}
-- ============================================

SET FOREIGN_KEY_CHECKS = 0;


SQL;
    }

    /**
     * Export a single table.
     */
    protected function exportTable(string $table): string
    {
        $rows = DB::table($table)->get();
        
        if ($rows->isEmpty()) {
            return "-- Table `{$table}` is empty\n\n";
        }

        $sql = "-- ----------------------------------------\n";
        $sql .= "-- Table: {$table} ({$rows->count()} rows)\n";
        $sql .= "-- ----------------------------------------\n\n";

        // Get column names
        $columns = array_keys((array) $rows->first());
        $columnList = '`' . implode('`, `', $columns) . '`';

        foreach ($rows as $row) {
            $values = [];
            foreach ((array) $row as $value) {
                if (is_null($value)) {
                    $values[] = 'NULL';
                } elseif (is_numeric($value)) {
                    $values[] = $value;
                } else {
                    $values[] = "'" . addslashes($value) . "'";
                }
            }
            $valueList = implode(', ', $values);
            $sql .= "INSERT INTO `{$table}` ({$columnList}) VALUES ({$valueList});\n";
        }

        $sql .= "\n";

        return $sql;
    }

    /**
     * Format bytes to human readable.
     */
    protected function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }
}
