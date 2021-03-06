<?
IncludeModuleLangFile(__FILE__);

class CAllExtra
{
	protected static $arExtraCache = array();

	public static function ClearCache()
	{
		self::$arExtraCache = array();
	}

	function GetByID($ID)
	{
		global $DB;

		$ID = intval($ID);
		if (0 >= $ID)
			return false;

		if (isset(self::$arExtraCache[$ID]))
		{
			return self::$arExtraCache[$ID];
		}
		else
		{
			$strSql = "SELECT ID, NAME, PERCENTAGE FROM b_catalog_extra WHERE ID = ".$ID;
			$db_res = $DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__);
			if ($res = $db_res->Fetch())
			{
				return $res;
			}
		}
		return false;
	}

	function SelectBox($sFieldName, $sValue, $sDefaultValue = "", $JavaChangeFunc = "", $sAdditionalParams = "")
	{
		if (empty(self::$arExtraCache))
		{
			$rsExtras = CExtra::GetList(
				array("NAME" => "ASC")
			);
			while ($arExtra = $rsExtras->Fetch())
			{
				$arExtra['ID'] = intval($arExtra['ID']);
				self::$arExtraCache[$arExtra['ID']] = $arExtra;
				if (defined('CATALOG_GLOBAL_VARS') && 'Y' == CATALOG_GLOBAL_VARS)
				{
					global $MAIN_EXTRA_LIST_CACHE;
					$MAIN_EXTRA_LIST_CACHE = self::$arExtraCache;
				}
			}
		}
		$s = '<select name="'.$sFieldName.'"';
		if (!empty($JavaChangeFunc))
			$s .= ' onchange="'.$JavaChangeFunc.'"';
		if (!empty($sAdditionalParams))
			$s .= ' '.$sAdditionalParams.' ';
		$s .= '>';
		$sValue = intval($sValue);
		$boolFound = isset(self::$arExtraCache[$sValue]);
		if (!empty($sDefaultValue))
			$s .= '<option value="0"'.($boolFound ? '' : ' selected').'>'.htmlspecialcharsex($sDefaultValue).'</option>';

		foreach (self::$arExtraCache as &$arExtra)
		{
			$s .= '<option value="'.$arExtra['ID'].'"'.($arExtra['ID'] == $sValue ? ' selected' : '').'>'.htmlspecialcharsex($arExtra['NAME']).' ('.htmlspecialcharsex($arExtra['PERCENTAGE']).'%)</option>';
		}
		if (isset($arExtra))
			unset($arExtra);
		return $s.'</select>';
	}

	function Update($ID, $arFields)
	{
		global $DB;

		$ID = intval($ID);
		if (0 >= $ID)
			return false;
		if (!CExtra::CheckFields('UPDATE', $arFields, $ID))
			return false;

		$strUpdate = $DB->PrepareUpdate("b_catalog_extra", $arFields);
		if (!empty($strUpdate))
		{
			$strSql = "UPDATE b_catalog_extra SET ".$strUpdate." WHERE ID = ".$ID;
			$DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__);

			if (isset($arFields['RECALCULATE']) && 'Y' == $arFields['RECALCULATE'])
			{
				CPrice::ReCalculate('EXTRA', $ID, $arFields['PERCENTAGE']);
			}
			CExtra::ClearCache();
		}
		return true;
	}

	function Delete($ID)
	{
		global $DB;
		$ID = intval($ID);
		if (0 >= $ID)
			return false;
		$DB->Query("UPDATE b_catalog_price SET EXTRA_ID = NULL WHERE EXTRA_ID = ".$ID);
		CExtra::ClearCache();
		return $DB->Query("DELETE FROM b_catalog_extra WHERE ID = ".$ID, true);
	}

	function CheckFields($strAction, &$arFields, $ID = 0)
	{
		global $APPLICATION;

		$arMsg = array();
		$boolResult = true;

		$strAction = strtoupper($strAction);

		$ID = intval($ID);
		if ('UPDATE' == $strAction && 0 >= $ID)
		{
			$arMsg[] = array('id' => 'ID', 'text' => GetMessage('CAT_EXTRA_ERR_UPDATE_NOT_ID'));
			$boolResult = false;
		}
		if (array_key_exists('ID', $arFields))
		{
			unset($arFields['ID']);
		}

		if ('ADD' == $strAction)
		{
			if (!array_key_exists('NAME', $arFields))
			{
				$arMsg[] = array('id' => 'NAME', 'text' => GetMessage('CAT_EXTRA_ERROR_NONAME'));
				$boolResult = false;
			}
			if (!array_key_exists('PERCENTAGE', $arFields))
			{
				$arMsg[] = array('id' => 'PERCENTAGE', 'text' => GetMessage('CAT_EXTRA_ERROR_NOPERCENTAGE'));
				$boolResult = false;
			}
		}

		if ($boolResult)
		{
			if (array_key_exists('NAME', $arFields))
			{
				$arFields["NAME"] = trim($arFields["NAME"]);
				if ('' == $arFields["NAME"])
				{
					$arMsg[] = array('id' => 'NAME', 'text' => GetMessage('CAT_EXTRA_ERROR_NONAME'));
					$boolResult = false;
				}
			}
			if (array_key_exists('PERCENTAGE', $arFields))
			{
				$arFields["PERCENTAGE"] = trim($arFields["PERCENTAGE"]);
				if ('' == $arFields["PERCENTAGE"])
				{
					$arMsg[] = array('id' => 'PERCENTAGE', 'text' => GetMessage('CAT_EXTRA_ERROR_NOPERCENTAGE'));
					$boolResult = false;
				}
				else
				{
					$arFields["PERCENTAGE"] = doubleval($arFields["PERCENTAGE"]);
				}
			}
		}

		if (!$boolResult)
		{
			$obError = new CAdminException($arMsg);
			$APPLICATION->ResetException();
			$APPLICATION->ThrowException($obError);
		}
		return $boolResult;
	}

/*
* @deprecated deprecated since catalog 12.5.6
*/
	function PrepareInsert(&$arFields, &$intID)
	{
		return false;
	}
}
?>