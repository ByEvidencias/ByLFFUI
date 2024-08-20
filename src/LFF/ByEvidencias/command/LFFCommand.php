<?php

declare(strict_types=1);

namespace LFF\ByEvidencias\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use LFF\ByEvidencias\Main;

class LFFCommand extends Command {

    private Main $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("lff", "Open the LFF menu", "/lff");
        $this->setPermission("lff.use");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if ($sender instanceof Player) {
            $this->plugin->getLFFUI($sender);
            return true;
        } else {
            $sender->sendMessage("This command can only be executed by players.");
            return false;
        }
    }
}
