<?
$MESS ['SEC_OTP_ACCESS_DENIED'] = "Управление параметрами одноразовых паролей недоступно.";
$MESS ['SEC_OTP_SWITCH_ON'] = "Включить составной пароль";
$MESS ['SEC_OTP_SECRET_KEY'] = "Секретный ключ (предоставляется индивидуально для каждого устройства)";
$MESS ['SEC_OTP_INIT'] = "Инициализация";
$MESS ['SEC_OTP_PASS1'] = "Первое значение пароля на устройстве (нажать и записать с экрана дисплея)";
$MESS ['SEC_OTP_PASS2'] = "Следующее значение пароля на устройстве (нажать еще раз и записать с экрана дисплея)";
$MESS ['SEC_OTP_NOTE'] = "<h3 style=\"clear:both\"><br>Одноразовый пароль</h3>
<img src=\"/bitrix/images/security/etoken_pass.png\" align=\"left\" style=\"margin-right:10px;\">
Система <a href=\"http://ru.wikipedia.org/wiki/%D0%9E%D0%B4%D0%BD%D0%BE%D1%80%D0%B0%D0%B7%D0%BE%D0%B2%D1%8B%D0%B9_%D0%BF%D0%B0%D1%80%D0%BE%D0%BB%D1%8C\">одноразовых паролей</a> дополняет стандартную систему авторизации и позволяет значительно усилить систему безопасности интернет-проекта. Для включения системы необходимо использовать аппаратное устройство (например, <a href=\"http://www.aladdin-rd.ru/catalog/etoken/pass/\">Aladdin eToken PASS</a>) или использовать соответствующее программное обеспечение, реализующее <a href=\"http://www.1c-bitrix.ru/products/cms/security/otp.php\">OTP</a>. Система одноразовых паролей рекомендуется к использованию администраторам сайтов для повышения уровня безопасности.
<h3 style=\"clear:both\"><br>Как пользоваться</h3>
<img src=\"/bitrix/images/security/ru_pass_form.png\" align=\"left\" style=\"margin-right:10px;\">
При включении системы одноразового пароля, этот пользователь сможет авторизоваться только с использованием своего имени (login) и составного пароля, состоящего из пароля и одноразового пароля устройства (6 цифр). Одноразовый пароль (см. <font style=\"color:red\">2</font> на рисунке) вводится в поле \"Пароль\" стандартной формы авторизации на
сайте сразу после обычного пароля (см. <font style=\"color:red\">1</font> на рисунке) без пробелов.<br>
Расширенная аутентификация с одноразовым паролем начнет работать после ввода
секретного ключа и двух <b>последовательно сгенерированных одноразовых
паролей</b>, полученных с устройства.
<h3 style=\"clear:both\"><br>Инициализация</h3>
При инициализации или повторной синхронизации устройства с пользователем необходимо заполнить два <b>последовательно сгенерированных одноразовых пароля</b>, полученных с устройства.
<h3 style=\"clear:both\"><br>Описание</h3>
Система авторизации с использованием одноразовых паролей (One-Time Password - OTP) разработана в рамках инициативы <a href=\"http://www.openauthentication.org/\">OATH</a>.<br>
Реализация основана на алгоритме HMAC и хэш-функции SHA-1. Для расчета значения OTP принимаются два входных параметра - секретный ключ (начальное значение для генератора) и текущее значение счетчика (количество необходимых циклов генерации). Начальное значение хранится как в самом устройстве, так и на сайте после инициализации устройства. Счетчик в устройстве увеличивается при каждой генерации OTP, на сервере - при каждой удачной аутентификации по OTP.<br>
Партия устройств OTP поставляется с зашифрованным файлом, содержащим начальные значения (секретные ключи) для всех устройств партии, связанного с серийным номером устройства (печатается на корпусе устройства).<br>
В случае нарушения синхронизации счетчика генерации в устройстве и на сервере, её можно легко восстановить - привести значение на сервере в соответствие значению, хранящемуся в устройстве. Для этого администратор системы или сам пользователь (при наличии соответствующих разрешений) должен сгенерировать два последовательных значения одноразовых паролей (OTP) и ввести их в форму на сайте.";
?>