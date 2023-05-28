<?php

namespace App\Console\Commands;

use App\Http\Dto\Hr\CreateHrDto;
use App\Http\Enums\UserTypes;
use App\Models\User;
use App\Services\User\Interfaces\UserServiceInterface;
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
     * @var UserServiceInterface
     */
    private UserServiceInterface $userService;

    /**
     * @param UserServiceInterface $adminService
     */
    public function __construct(
        UserServiceInterface $adminService
    )
    {
        parent::__construct();
        $this->userService = $adminService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $response = $this->userService->create(new CreateHrDto([
            User::NAME_COLUMN => 'Developer',
            User::EMAIL_COLUMN => 'dev@dev.dev',
            User::PASSWORD_COLUMN => 'developer',
            User::USER_TYPE_COLUMN => UserTypes::HR_TYPE->value
        ]));

        if ($response->isFailed() || $response->getResult() === false) {
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
