<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

error_reporting(E_ALL);

ini_set("display_errors", 1);

$db_list = CIBlockSection::GetList(array(), array('IBLOCK_ID'=>5, 'ACTIVE'=>'Y', 'DEPTH_LEVEL'=>1), true);

while($section = $db_list->GetNext()){

    $res=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>5,'INCLUDE_SUBSECTIONS'=>'Y','ACTIVE'=>'Y','SECTION_ID'=>$section['ID']),false,false,array());
    while($ar=$res->GetNext()){
       
        //$r=CCatalogProduct::GetByIDEx($ar['ID']);

        new dBug($ar);
        
       // $url=str_replace('#PATH#', $p, $r['DETAIL_PAGE_URL']);
    }
}

?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>