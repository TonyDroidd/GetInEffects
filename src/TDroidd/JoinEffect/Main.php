<?php

namespace TDroidd\JoinEffect;

use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener {

  public function onEnable() {
    $this->saveDefaultConfig();
    $c = yaml_parse(file_get_contents($this->getDataFolder() . "config.yml"));
    $this->effect = $c["EffectID"];
  }

  public function onJoin(PlayerJoinEvent $event) {
    $p = $event->getPlayer();
    $effect = Effect::getEffect($this->effect);
    $effect->setVisible(false);
    $effect->setDuration(1200);
    $p->addEffect($effect);
  }

}
