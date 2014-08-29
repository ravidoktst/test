<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
global $USER;
$req=json_decode(file_get_contents('php://input'),true);
if(!count($req)){
  $req=array();
  $arVar=array('command','id','sect','count');
  foreach($arVar as $varname){
    if($_POST[$varname]){
      $req[$varname]=trim(strip_tags($_POST[$varname]));
    }elseif($_GET[$varname]){
      $req[$varname]=trim(strip_tags($_GET[$varname]));
    }else{$req[$varname]='';}
  }
}
switch($req['command']){

  case'faq':
    if($req['name']&&$req['email']&&$req['tema']&&$req['vopros']&&check_email($req['email'])){

      if (!CModule::IncludeModule('iblock')) {
        return false;
     }

      $el = new CIBlockElement;
      $PROP = array();
      $PROP[53] = $req['name'];
      $PROP[54] = $req['email'];
      $PROP[55] = $req['tema'];
      $PROP[56] = array('VALUE'=>array('TYPE'=>'HTML', 'TEXT'=>$req['vopros']));
      $arLoadProductArray = Array(  
         'MODIFIED_BY' => $USER->GetID(),
         'IBLOCK_SECTION_ID' => false, 
         'IBLOCK_ID' => 8,
         'PROPERTY_VALUES' => $PROP,  
         'NAME' => 'Вопрос от '.$req['name'].' '.date('Y-m-d H:i:s'),  
         'ACTIVE' => 'Y', // активен  
      );

      if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
         echo 'ok';
      } else {
         echo 'Error: '.$el->LAST_ERROR;
      }

    }else{
      echo 'Ошибка email и/или пароля.';
    }
  break;

  case'feedback':
    if($req['name']&&$req['email']&&$req['message']&&check_email($req['email'])){
      $arFields=array(
        'AUTHOR_EMAIL'=>$req['email'],
        'PHONE'=>$req['phone'],
        'AUTHOR'=>$req['name'],
        'TEXT'=>$req['message'],
      );
      CEvent::Send('FEEDBACK_FORM',s1,$arFields,'Y',7);
      echo 'ok';
    }else{
      echo 'Ошибка email и/или пароля.';
    }
  break;

  case'aktion':
    if($req['name']&&$req['email']&&check_email($req['email'])&&$req['email']){
      $arFields=array(
        'AUTHOR_EMAIL'=>$req['email'],
        'PHONE'=>$req['phone'],
        'AUTHOR'=>$req['name'],
        'TEXT'=>$req['koment'],
      );
      CEvent::Send('FEEDBACK_FORM',s1,$arFields,'Y',37);
      echo 'ok';
    }else{
      echo 'Ошибка email и/или пароля.';
    }
  break;

  case'auth':
    if($req['email']&&$req['password']&&check_email($req['email'])){
      $res=$USER->Login(trim($req['email']),trim($req['password']),'Y');
      if($res===true){
        echo 'ok';
      }else{
        echo 'Ошибка email и/или пароля.';
      }
    }else{
      echo 'Ошибка email и/или пароля.';
    }
  break;

  case'reviews':

    if (!CModule::IncludeModule('iblock')) {
          return false;
      }

    if($req['email']&&$req['name']&&check_email($req['email'])&&$req['text']&&$req['title']&&$req['id']){
      if($req['sectid']){
        //если раздел отзыва уже созданн

        $el = new CIBlockElement;
        $PROP = array();
        $PROP[67] = $req['email'];

        $arLoadProductArray = Array(  
           'MODIFIED_BY' => $USER->GetID(),
           'IBLOCK_SECTION_ID' => $req['sectid'], 
           'IBLOCK_ID' => 10, 
           'PROPERTY_VALUES'=> $PROP,
           'NAME' => $req['name'], 
           'DETAIL_TEXT' => $req['text'],
           'ACTIVE' => 'N', // активен  
        );

        if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
           echo 'ok';
        } else {
           echo 'Error: '.$el->LAST_ERROR;
        }

      }else{
        //создаем раздел

        $bs = new CIBlockSection;
        $arFields = Array(
          "ACTIVE" => 'Y',
          "IBLOCK_ID" => 10,
          "NAME" => $req['title'],
          );

        $ID = $bs->Add($arFields);
        $res = ($ID>0);

        if(!$res)
          echo $bs->LAST_ERROR;

        $el = new CIBlockElement;
        $PROP = array();
        $PROP[67] = $req['email'];

        $arLoadProductArray = Array(  
           'MODIFIED_BY' => $USER->GetID(),
           'IBLOCK_SECTION_ID' => $ID, 
           'IBLOCK_ID' => 10, 
           'PROPERTY_VALUES'=> $PROP,
           'NAME' => $req['name'], 
           'DETAIL_TEXT' => $req['text'],
           'ACTIVE' => 'N', // активен  
        );

        if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
          CIBlockElement::SetPropertyValuesEx($req['id'], 5, array('FORUM_TOPIC_ID' => $ID));
          echo 'ok';
        } else {
          echo 'Error: '.$el->LAST_ERROR;
        }

      }

    }else{
      echo 'Ошибка email и/или не заполненны все поля';
    }
  break;

  case'reg':
    if($req['email']&&$req['password']&&check_email($req['email'])&&$req['name']&&$req['passwordToo']){
      if($req['password']==$req['passwordToo']){
          // проверим есть ли пользователь
          $res=$USER->GetByLogin($req['email']);
          if($res->SelectedRowsCount()){
            echo'Пользователь с таким email уже существует.';
          }else{
            $arFields=array(
              "EMAIL"=>$req['email'],
              "LOGIN"=>$req['email'],
            //  "LID"=>"s1",
              "ACTIVE"=> "Y",
              "PASSWORD"=> $req['password'],
              "CONFIRM_PASSWORD"=> $req['passwordToo'],
            );
              $arFields["NAME"]=$req['name'];
            //print_r($arFields);
            $us=new CUser;
            $id=$us->Add($arFields);
            if($id){
              $us->Authorize($id);
              echo 'ok';
            }else{
              echo 'Ошибка создания пользователя. Попробуйте еще раз или обратитесь к администрации сайта.';
            }
          }
        }else{
          echo 'Пароль и подтверждение пароля не совпадают.';
        }
      }else{
          echo 'Заполните все поля.';        
      }

  break;

  case'update':
    if($req['email']&&check_email($req['email'])&&$req['name']&&$req['password']){

      $res=CUser::GetList(($by="personal_country"), ($order="desc"), array('EMAIL'=>trim($req['email'])));
      $ar=$res->GetNext();
      if (($res->SelectedRowsCount()>0) && ($ar['ID']!=$USER->GetID())){
        echo 'Пользователь с данным email уже зарегистрирован.';
      }else{

       $res=$USER->Login($USER->GetLogin(),trim($req['password']),'Y');
        if($res===true){
          $arFields=array(
            'NAME'=>trim($req['name']),
            'PERSONAL_PHONE'=>trim($req['phone']),
            'EMAIL'=>trim($req['email']),
            'LOGIN'=>trim($req['email']),
            'PERSONAL_STREET'=>trim($req['adres']),
          );

          if($req['passwordNew']){

              $arFields['PASSWORD']=$req['passwordNew'];
              $arFields['CONFIRM_PASSWORD']=$req['passwordNew']; 
          }

          $USER->Update($USER->GetID(),$arFields);
          echo 'ok';
        }else{
           echo 'Не верный пароль'; 
        }
      }
    }else{
        echo 'Заполните Имя, Email пароль';        
    }

  break;

  case'clearBasket':
    CModule::IncludeModule('sale');
    CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
    echo 'ok';
  break;

  case'search':
    if($req['value']){

      if (!CModule::IncludeModule('iblock')) {
          return false;
      }

      $el_ob = NULL;
      
      //ограничить выводимых товаров
      $arNavStartParams = array("nTopCount" => 5);

      // СОРТИРОВКА
      $SORT = array("SORT"=>"ASC","NAME"=>"ASC","CATALOG_QUANTITY"=>5);

      $q = trim(str_replace("  ", "", $req['value']));
      $arr_q = explode(" ", $q);

      $arFilter["IBLOCK_ID"] = 5;
      $arFilter["ACTIVE"] = "Y";

      if(count($arr_q)==1){
        $arFilter["NAME"] = "%".$q."%";
      }else{
        $logic_query = array();
        $logic_query["LOGIC"] = "AND";
        foreach ($arr_q as $value){
          //if(strlen($value)<=3){continue;}
          $logic_query[] = array("NAME"=>"%".$value."%");
        }
        $arFilter[] = $logic_query;
      }

      $el_ob = CIBlockElement::GetList(
       $SORT,
       $arFilter,
       false,
       $arNavStartParams,
       array("NAME","ID","PREVIEW_PICTURE","DETAIL_PAGE_URL")
      );

      $searchStr = '';

      if( $el_ob->SelectedRowsCount() > 0 ){
       $sections = array();
       $conut = $el_ob->SelectedRowsCount();
       $i = 0;
       $searchStr.= "<thead>
              <tr><td>Фото</td><td>Наименование</td><td>Цена</td></tr>
            </thead><tbody>";

       while( $el_res = $el_ob->GetNext()){

        $ar_res = CPrice::GetBasePrice($el_res["ID"]);

        $src = ($el_res["PREVIEW_PICTURE"] ? CFile::GetPath($el_res["PREVIEW_PICTURE"]) : '/img/nophoto92.jpg');

        $searchStr.="<tr>
                <td>
                  <div class='image'><img src='".$src."'></div>
                </td>
                <td>
                  <a href='".$el_res["DETAIL_PAGE_URL"]."'>".$el_res["NAME"]."</a>
                </td>
                <td>".CurrencyFormat($ar_res["PRICE"],$ar_res["CURRENCY"])."</td>
              </tr>";
       }
       $searchStr.= "</tbody>";  
      }else{
        $searchStr.= "<thead>
              <tr><td>По данному запросу ни чего не найденно</td></tr></thead>";
      } 

      echo json_encode(array(
        'result'=>'ok',
        'html'=>$searchStr
      ));

    }else{
      echo 'Ошибка сервера';
    }
    
  break;
}
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");