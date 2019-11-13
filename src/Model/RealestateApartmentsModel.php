<?php

namespace SeptemberWerbeagentur\ContaoRealEstateBundle\Model;

use Contao\Model;

class RealestateApartmentsModel extends Model
{
    /**
     * Table name
     * @var string
     */
    protected static $strTable = 'tl_realestate_apartments';

    public static function findAllByPid(int $pid) {
        $t = static::$strTable;
        $arrColumns = array("$t.pid=?");

        return static::findBy($arrColumns, array($pid), array());
    }
	
    public static function findPublishedByPid(int $pid) {
        $t = static::$strTable;
        $arrColumns = array("$t.pid=?");
		$arrColumns[] = "$t.published=?";

        return static::findBy($arrColumns, array($pid, 1), array());
    }
	
	public static function findPublishedByIdOrAlias($varId, array $arrOptions=array()){
		$isAlias = !is_numeric($varId);

		// Try to load from the registry
		if (!$isAlias && empty($arrOptions))
		{
			$objModel = \Model\Registry::getInstance()->fetch(static::$strTable, $varId);

			if ($objModel !== null)
			{
				return $objModel;
			}
		}

		$t = static::$strTable;

		$arrOptions = array_merge
		(
			array
			(
				'limit'  => 1,
				'column' => array($isAlias ? "$t.alias=?" : "$t.id=?", "$t.visible", "$t.published"),
				'value'  => array($varId, 1, 1),
				'return' => 'Model'
			),
			

			$arrOptions
		);
		

		return static::find($arrOptions);
	}

    public static function findAddressByPid(int $pid)
    {
    }
}