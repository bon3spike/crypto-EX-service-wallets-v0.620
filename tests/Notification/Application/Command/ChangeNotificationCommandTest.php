<?php

namespace App\Test\Notification\Application\Command;

use App\Application\Command\CommandInterface;
use App\Notification\Application\Command\ChangeNotificationCommand;
use App\Repository\NotificationRepository;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ChangeNotificationCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->commandBus = $this::getContainer()->get(CommandInterface::class);
        $this->notificationRepository::getContainer()->get(NotificationRepository::class);
    }

    public function test_change_notification_success():void
    {
        $command = new ChangeNotificationCommand(1,2);
    }

}