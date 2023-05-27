<?php

namespace App\Console\Commands;

use App\Http\Dto\Admin\CreateAdminDto;
use App\Models\User;
use App\Services\Admin\Interfaces\AdminServiceInterface;
use Illuminate\Console\Command;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create_admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создаем админа';

    /**
     * @var AdminServiceInterface
     */
    private AdminServiceInterface $adminService;

    public function __construct(
        AdminServiceInterface $adminService
    )
    {
        parent::__construct();
        $this->adminService = $adminService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $response = $this->adminService->createAdmin(new CreateAdminDto([
            User::NAME_COLUMN => 'Developer',
            User::EMAIL_COLUMN => 'dev@dev.dev',
            User::IS_ADMIN_COLUMN => true,
            User::PASSWORD_COLUMN => 'developer'
        ]));

        if ($response->isFailed() || $response->getResult() === false) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
