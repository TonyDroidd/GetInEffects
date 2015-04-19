<?php

namespace TDroidd\JoinEffect;
use pocketmine\Player;
use pocketmine\entity\Effect;

   class Main extends PluginBase implements Listener{
	public function onEnable(){
          $this->getLogger()->info("§bJoin§eEffect §aLoaded!");
	public function onDisable(){
	        $this->getLogger()->info("§bJoin§eEffect §aUnloaded");
    }
}
   
    public function onJoin(PlayerJoinEvent $event){
        $p = $event->getPlayer();
            $effect = Effect::getEffect(1); //Effect ID
            $effect->setVisible(false); //Particles
            $effect->setDuration(1200); //Ticks
            $p->addEffect($effect);
        }
