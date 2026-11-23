<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PendingRegistration;

class DeleteExpiredPendingRegistrations extends Command
{
    protected $signature = 'registrations:clean-expired';

    protected $description = 'Elimina los registros pendientes de verificación que hayan caducado';

    public function handle(): int
    {
        $deleted = PendingRegistration::where(
            'expires_at',
            '<',
            now()
        )->delete();

        $this->info("Registros pendientes eliminados: {$deleted}");

        return self::SUCCESS;
    }
}