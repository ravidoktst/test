<?
set_time_limit(0);
ini_set('max_execution_time', 0);

ini_set("display_errors", 1);

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule("iblock");

$fd=fopen($_SERVER['DOCUMENT_ROOT'].'/sitemap.xml','w+');
$file="<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
$date=date('c',time());
@mkdir($_SERVER['DOCUMENT_ROOT'].'/sitemap');
$ibl = array(5,7,9);
foreach($ibl as $item){
	if($item==5){

  		$db_list = CIBlockSection::GetList(array(), array('IBLOCK_ID'=>$item, 'ACTIVE'=>'Y', 'DEPTH_LEVEL'=>1), true);
		while($section = $db_list->GetNext()){
			$file.='<sitemap><lastmod>'.$date.'</lastmod><loc>http://'.$_SERVER['SERVER_NAME'].'/sitemap/'.$section['CODE'].'.xml</loc></sitemap>';
			$fdRegion=fopen($_SERVER['DOCUMENT_ROOT'].'/sitemap/'.$section['CODE'].'.xml','w+');
			$fileRegion='<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
			// market
			$res=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>$item,'INCLUDE_SUBSECTIONS'=>'Y','ACTIVE'=>'Y','SECTION_ID'=>$section['ID']),false,false,array());
			while($ar=$res->GetNext()){

				$fileRegion.='<url><loc>http://'.$_SERVER['SERVER_NAME'].$ar['DETAIL_PAGE_URL'].'</loc><priority>0.6</priority><changefreq>weekly</changefreq></url>';

			}
			fwrite($fdRegion,$fileRegion.'</urlset>');
			fclose($fdRegion);

		}

	}else{

	$file.='<sitemap><lastmod>'.$date.'</lastmod><loc>http://'.$_SERVER['SERVER_NAME'].'/sitemap/'.$item.'.xml</loc></sitemap>';
	$fdRegion=fopen($_SERVER['DOCUMENT_ROOT'].'/sitemap/'.$item.'.xml','w+');
	$fileRegion='<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	// market
	$res=CIBlockElement::GetList(array(),array('IBLOCK_ID'=>$item,'INCLUDE_SUBSECTIONS'=>'Y','ACTIVE'=>'Y'),false,false,array());
	while($ar=$res->GetNext()){
		$fileRegion.='<url><loc>http://'.$_SERVER['SERVER_NAME'].$ar['DETAIL_PAGE_URL'].'</loc><priority>0.6</priority><changefreq>weekly</changefreq></url>';
	}
	fwrite($fdRegion,$fileRegion.'</urlset>');
	fclose($fdRegion);

}
}
fwrite($fd,$file.'</sitemapindex>');
fclose($fd);
?>