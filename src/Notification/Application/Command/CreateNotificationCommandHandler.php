<?php

declare(strict_types=1);

namespace App\Notification\Application\Command;


use App\Application\Command\CommandHandlerInterface;
use App\Application\Command\CommandInterface;
use App\Entity\Notification;
use App\Notification\Application\Dto\NotificationDto;
use App\Notification\Application\Expander\NotificationDtoExpanderInterface;

final readonly class CreateNotificationCommandHandler implements CommandHandlerInterface {

    public function __construct(
        private NotificationDtoExpanderInterface $expander
    ){}


    public function supports(CommandInterface $command): bool
    {
        return $command instanceof CreateNotificationCommand;
    }
    /**
     * @param CreateNotificationCommand $command
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

    public function __invoke(CreateNotificationCommand $createNotificationCommand): void
    {
        #создание сущности и запись в бд
    }
}
