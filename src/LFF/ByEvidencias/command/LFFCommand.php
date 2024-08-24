<?php

declare(strict_types=1);

namespace LFF\ByEvidencias\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use LFF\ByEvidencias\Main;

class LFFCommand extends Command {

    public function __construct() {
        parent::__construct("lff", "Open the LFF menu", "/lff");
        $this->setPermission("lff.use");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if ($sender instanceof Player) {
            $form = Main::getInstance()->getLFFUI();
            $sender->sendForm($form);
            return true;
        } else {
            $sender->sendMessage("This command can only be executed by players.");
            return false;
        }
    }
}
