<?php
namespace GDO\Country\Method;
use GDO\Country\Country;
use GDO\Country\GDO_Country;
use GDO\GWF\MethodCompletion;

final class Completion extends MethodCompletion
{
    public function execute()
    {
        $response = [];
        $q = $this->getSearchTerm();
        $cell = GDO_Country::make('c_iso');
        foreach (Country::table()->all() as $iso => $country)
        {
            if ( (!$q) || ($country->getISO() === $q) ||
                (mb_stripos($country->displayName(), $q) !== false) )
            {
                $response[] = array(
                    'id' => $iso,
                    'text' => $country->displayName(),
                    'display' => $cell->gdo($country)->renderCell(),
                );
            }
        }
        die(json_encode($response));
    }
}
