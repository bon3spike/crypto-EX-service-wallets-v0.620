<?php

declare(strict_types=1);

use App\Service\CQRS\Command;
use App\Service\CQRS\CommandHandler;

final readonly class NotificationCmdHandler implements CommandHandlerInterface {

    public function __construct(
        private PublicationDtoExpanderInterface $expander
    ){}


    public function supports(CommandInterface $command): bool
    {
        return $command instanceof PublicationCmd;
    }
    /**
     * @param PublicationCmd $command
     *
     * @return void
     */
    public function handle(CommandInterface $command): void
    {
        $n = new PublicationDto(null, null, null,null);
        $this->expander->expand($n, [
            'id'    => $command->id(),
            'text'   => $command->text,
            'headline' => $command->headline,
            'img' => $command->img,
        ]);
        print_r($n);
    }
}
