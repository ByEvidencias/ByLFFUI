<?php

declare(strict_types=1);

namespace LFF\ByEvidencias\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use LFF\ByEvidencias\Main;

class LFFCommand extends Command {

    public function __construct() {
        parent::__construct("lff", "Open the LFF menu", "/lff");
        $this->setPermission("lff.use");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if (!$sender instanceof Player) {
            $sender->sendMessage(TextFormat::RED . "This command can only be executed by players.");
            return false;
        }
        
        if (!$sender->hasPermission("lff.use")) {
            $sender->sendMessage(TextFormat::RED . "You don't have permission to use this command.");
            return false;
        }
        
        $form = Main::getInstance()->getLFFUI();
        $sender->sendForm($form);
        return true;
    }
}
