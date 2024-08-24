<?php

declare(strict_types=1);

namespace LFF\ByEvidencias;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use LFF\ByEvidencias\command\LFFCommand;
use pocketmine\event\Listener;
use jojoe77777\SimpleForm;
use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener {

    private static ?Main $instance = null;

    public function onEnable(): void {
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();

        $this->getServer()->getCommandMap()->register("lff", new LFFCommand());
    }

    public static function getInstance(): Main {
        return self::$instance;
    }

    public function getLFFUI(): SimpleForm {
        $form = new SimpleForm(function (Player $player, ?int $data) {
            if ($data === null) {
                return;
            }

            $classes = [
                0 => "Swordsman",
                1 => "Archer",
                2 => "Tank",
                3 => "Miner",
                4 => "Explorer",
                5 => "Builder",
                6 => "Farmer"
            ];

            if (isset($classes[$data])) {
                $selectedClass = $classes[$data];
                $config = $this->getConfig();
                $lffMessage = $config->get("class-message", "{player} is looking for a faction and specializes in: {class}");

                $formMessage = str_replace(
                    ["{player}", "{class}"],
                    [$player->getName(), $selectedClass],
                    $lffMessage
                );

                $this->getServer()->broadcastMessage($formMessage);
            }
        });

        $form->setTitle("§l§dLooking For Faction");
        $form->setContent("§7Select your specialty");
        $form->addButton("§eSwordsman", 0, "textures/items/diamond_sword");
        $form->addButton("§eArcher", 0, "textures/items/bow_standby");
        $form->addButton("§eTank", 0, "textures/items/diamond_chestplate");
        $form->addButton("§eMiner", 0, "textures/ui/haste_effect");
        $form->addButton("§eExplorer", 0, "textures/items/spyglass");
        $form->addButton("§eBuilder", 0, "textures/blocks/brick");
        $form->addButton("§eFarmer", 0, "textures/items/diamond_hoe");

        return $form;
    }
}
