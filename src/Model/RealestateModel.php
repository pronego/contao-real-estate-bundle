<?php

namespace SeptemberWerbeagentur\ContaoRealEstateBundle\Model;

use Contao\Model;

class RealestateModel extends Model
{
    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_realestate';

    public static function findPublished()
    {
		$t = static::$strTable;
		
		$arrColumns[] = "$t.published=?";
		return static::findBy($arrColumns, array(1), array());
    }
}