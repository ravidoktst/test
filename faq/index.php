<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("FAQ");

$res = CIBlockElement::GetList(array('ID' => 'DESC'), array('IBLOCK_ID'=>8,'ACTIVE'=>'Y','!PROPERTY_OTVET'=>false), false, false, array('*','PROPERTY_AUTHOR_NAME','PROPERTY_AUTHOR_EMAIL','PROPERTY_TEMA','PROPERTY_VOPROS','PROPERTY_OTVET'));


?>

<div class="vopros-otvet simple-page">
            <h1 class="title">F.A.Q.</h1>
            <ul>
                <?while($item=$res->GetNext()):?>
                <li>
                    <div class="user-name"><?=$item['PROPERTY_AUTHOR_NAME_VALUE']?></div>
                    <div class="vopros"><?=htmlspecialchars($item['PROPERTY_VOPROS_VALUE']['TEXT'])?></div>
                    <div class="otvet">
                        <div class="title">Ответ:</div>
                        <div class="text">
                            <?=htmlspecialchars($item['PROPERTY_OTVET_VALUE']['TEXT'])?>
                        </div>
                    </div>
                </li>
                <?endwhile;?>
            </ul>



            <div class="feedback-form horizontal" ng-controller="faqForm">
                <h3 class="form-title">Задать вопрос</h3>
                <form action="" ng-submit="submitForm()" name="userForm">
                    <input type="text" placeholder="Представьтесь" ng-model="user.name" required/>
                    <input type="email" placeholder="E-mail" ng-model="user.email" input-mask="{ mask:'a{1,20}@a{1,10}.a{1,5}' ,greedy: false}" required/>
                    <input type="text" placeholder="Тема" ng-model="user.tema" required/>
                    <textarea placeholder="Вопрос" ng-model="user.vopros" required></textarea>
                    <input class="button blue" type="submit" value="Отправить"/>
                </form>
            </div>

        </div>


    </div>
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>