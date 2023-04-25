<?php

declare(strict_types=1);

namespace App\Notification\Application\Command;


use App\Application\Command\CommandHandlerInterface;
use App\Application\Command\CommandInterface;
use App\Notification\Application\Dto\NotificationDto;
use App\Notification\Expander\NotificationDtoExpanderInterface;

final readonly class ChangeNotificationCommandHandler implements CommandHandlerInterface {

    public function __construct(
        private NotificationDtoExpanderInterface $expander
    ){}


    public function supports(CommandInterface $command): bool
    {
        return $command instanceof ChangeNotificationCommand;
    }
    /**
     * @param ChangeNotificationCommand $command
     *
     * @return void
     */
    public function handle(CommandInterface $command): void
    {
        $n = new NotificationDto(null, null);
        $this->expander->expand($n, [
            'id'    => $command->id(),
            'text'   => $command->text
        ]);
        print_r($n);
    }

    public function __invoke(ChangeNotificationCommand $createNotificationCommand): void
    {
        print('okey');
    }
}
