<?php

namespace App\Console\Commands;

use App\Http\Dto\Hr\CreateHrDto;
use App\Http\Enums\UserTypes;
use App\Models\User;
use App\Services\Hr\Interfaces\HrServiceInterface;
use Illuminate\Console\Command;

class CreateAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:create_hr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создаем отдел кадров';

    /**
     * @var HrServiceInterface
     */
    private HrServiceInterface $adminService;

    public function __construct(
        HrServiceInterface $adminService
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
        $response = $this->adminService->createAdmin(new CreateHrDto([
            User::NAME_COLUMN => 'Developer',
            User::EMAIL_COLUMN => 'dev@dev.dev',
            User::PASSWORD_COLUMN => 'developer',
            User::USER_TYPE_COLUMN => UserTypes::HR_TYPE
        ]));

        if ($response->isFailed() || $response->getResult() === false) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
