<?php
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;

echo "Checking 'settings' table... ";
if (Schema::hasTable('settings')) {
    echo "EXISTS\n";
} else {
    echo "MISSING\n";
    exit(1);
}

echo "Turning ON Maintenance Mode...\n";
Setting::updateOrCreate(['key' => 'maintenance_mode'], ['value' => 'true']);

$val = Setting::where('key', 'maintenance_mode')->value('value');
echo "Current value: " . $val . "\n";

if ($val !== 'true') {
    echo "FAILED to set maintenance mode.\n";
} else {
    echo "Maintenance Request Simulation: ";
    // We can't easily simulate a full HTTP request here without more bootstrap, 
    // but we verified the DB value is set.
    // The middleware logic is simple: if (Setting::... == 'true') abort(503).
    echo "READY (Middleware should catch this)\n";
}

echo "Turning OFF Maintenance Mode...\n";
Setting::updateOrCreate(['key' => 'maintenance_mode'], ['value' => 'false']);
echo "Current value: " . Setting::where('key', 'maintenance_mode')->value('value') . "\n";
