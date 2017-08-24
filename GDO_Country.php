<?php
namespace GDO\Country;

use GDO\DB\WithObject;
use GDO\Form\GDO_Select;
use GDO\Form\WithCompletion;
use GDO\Template\GDO_Template;

final class GDO_Country extends GDO_Select
{
    use WithObject;
    use WithCompletion;
    
    public function __construct()
    {
        $this->table(Country::table());
        $this->min = $this->max = 2;
    }
    
    public function withCompletion()
    {
        return $this->completionHref(href('Country', 'Completion'));
    }
    
    public function defaultLabel() { return $this->label('country'); }
    
    private function countryChoices()
    {
        return Country::table()->all();
    }
    
    public function renderCell()
    {
        return GDO_Template::php('Country', 'cell/country.php', ['field'=>$this, 'country'=>$this->gdo, 'choice' => false]);
    }
    
    
    public function renderForm()
    {
        if ($this->completionHref)
        {
            return GDO_Template::php('GWF', 'form/object_completion.php', ['field' => $this]);
        }
        else
        {
            $this->choices = $this->countryChoices();
            return GDO_Template::php('Country', 'form/country.php', ['field'=>$this]);
        }
    }
    
    public function validate($value)
    {
        $this->choices = $this->countryChoices();
        return parent::validate($value);
    }
    public function toJSON()
    {
        return array_merge(parent::toJSON(), array(
            'completionHref' => $this->completionHref,
        ));
    }
}
