<?php

namespace nabe;

use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class main extends PluginBase implements Listener
{
    /** @var Config */
    private $config;

    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->getlogger()->info("atkcancel_silentプラグインのロードに成功しましたy。ver.10-edit by ははっち");
        $this->getlogger()->info("実行test:Pocketmine1.14.0。§c製作者を偽っての配布を禁じます。");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->config = new Config($this->getDataFolder() . "config.yml", Config::YAML ,array(
            "world" => ["world"]
        ));
    }

    public function onEntityDamageByEntity(EntityDamageEvent $event){
        if($event instanceof EntityDamageByEntityEvent){
            $damager = $event->getDamager();
            $hitter = $event->getEntity();
            if ($damager instanceof Player && $hitter instanceof Player) {
                if ($damager->isOp()) return;
                $worlds = $this->config->get("world");
                if (in_array($damager->getLevel()->getName(),$worlds)) {
                    $event->setCancelled();
                    
                }
            }
        }
    }
}