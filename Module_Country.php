<?php
namespace GDO\Country;
use GDO\Core\Module;
class Module_Country extends Module
{
    public $module_priority = 3;
    
    public function getClasses() { return ['GDO\Country\Country']; }
    public function onInstall() { CountryData::onInstall(); }
    public function onLoadLanguage() { $this->loadLanguage('lang/country'); }
}
