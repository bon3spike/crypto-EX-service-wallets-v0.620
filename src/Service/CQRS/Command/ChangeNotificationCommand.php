<?php

use App\Service\CQRS\Command;

final readonly class ChangeNotificationCommand implements Command
{
    public string $id;
    private string $text;

    public function __construct(string $id, string $text)
    {
        $this->id = $id;
        $this->text = $text;
    }

    public function id(): string
    {
        return $this->_id;
    }

    public function text(): string
    {
        return $this->text;
    }
}