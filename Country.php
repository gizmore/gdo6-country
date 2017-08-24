<?php
namespace GDO\Country;
use GDO\DB\Cache;
use GDO\DB\GDO;
use GDO\Template\GDO_Template;
use GDO\Type\GDO_Char;
use GDO\Type\GDO_Int;
/**
 * Country table/entity.
 * @author gizmore
 */
final class Country extends GDO
{
	public function memCached() { return false; }
	
	public function gdoColumns()
	{
		return array(
		    GDO_Char::make('c_iso')->label('id')->size(2)->ascii()->caseS()->primary(),
		    GDO_Int::make('c_population')->initial('0')->unsigned(),
		    GDO_Char::make('c_phonecode')->ascii()->size(2),
		);
	}
	
	public function getISO() { return $this->getVar('c_iso'); }
	public function displayName() { return t('country_'.$this->getISO()); }

	/**
	 * Get a country by ID or return a stub object with name "Unknown".
	 * @param int $id
	 * @return Country
	 */
	public static function getByISOOrUnknown(string $iso=null)
	{
	    
	    if ( ($iso === null) || (!($country = self::getById($iso))) )
		{
			$country = self::blank(['c_iso'=>'zz']);
		}
		return $country;
	}
	
	/**
	 * @return self[]
	 */
	public function all()
	{
		if (!($cache = Cache::get('gwf_country')))
		{
			$cache = self::table()->select('*')->exec()->fetchAllArray2dObject();
			Cache::set('gwf_country', $cache);
		}
		return $cache;
	}

	public function renderCell()
	{
	    return GDO_Template::php('Country', 'cell/country.php', ['field'=>$this, 'country' => $this, 'choice' => false]);
	}

	public function renderChoice()
	{
	    return GDO_Template::php('Country', 'cell/country.php', ['field'=>$this, 'country' => $this, 'choice' => true]);
	}
}
