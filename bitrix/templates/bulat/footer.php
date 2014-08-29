<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
</div>
</div>
<footer id="footer">
	<div class="column">
		<a class="small-logo" href="/"><img src="/img/small-logo.png" alt=""/></a>
		<div class="copyright">&copy; Булат Двери <script>document.write((new Date()).getFullYear())</script></div>
	</div>
	<div class="column">
		<h4 class="column-title">Режим работы</h4>
		<div>Будние дни: с 9:00 до 18:00</div>
		<div>Суббота: с 9:00 до 17:00</div>
		<div>Воскресенье - выходной</div>
	</div>
	<div class="column">
		<h4 class="column-title">Сервис и Помощь</h4>
		<ul>
			<li><a href="/how-to-order/">Как сделать заказ</a></li>
			<li><a href="/payment/">Способы оплаты</a></li>
			<li><a href="/return/">Возврат</a></li>
		</ul>
	</div>
	<div class="column">
		<h4 class="column-title">О компании</h4>
		<ul>
			<li><a href="/about/">О нас</a></li>
			<li><a href="/partners/">Партнерам</a></li>
			<li><a href="/contacts/">Контакты</a></li>
		</ul>
	</div>
	<div class="column">
		<h4 class="column-title">Поделись</h4>
		<div class="share">
			<script type="text/javascript">(function() {
				if (window.pluso)if (typeof window.pluso.start == "function") return;
				if (window.ifpluso==undefined) { window.ifpluso = 1;
					var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
					s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
					s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
					var h=d[g]('body')[0];
					h.appendChild(s);
				}})();</script>
			<div class="pluso" data-background="transparent" data-options="small,square,line,horizontal,counter,theme=06" data-services="vkontakte,odnoklassniki,facebook,twitter,moimir"></div>
		</div>
		<div class="phone-block">
			<div class="title">Служба поддержки</div>
			<div class="value">8 (800) 234-18-55</div>
		</div>
	</div>
</footer>

<div id="overlay"></div>

<div id="thanks" class="okna">
	<h3>Товар добавлен в корзину</h3>
	<img src="/img/cart.png">
	<div>
		<a href class="yellow button" id="close">Продолжить покупки</a>
		<a href="/personal/cart/" class="blue button">Перейти в корзину</a>
	</div>
</div>

<div id="auth" class="okna">
	<ul class="tabs">
		<li class="active">Авторизация</li>
		<li>Регистрация</li>
	</ul>
	<img src="/img/close.png" class="close">
	<div class="panes">
		<div class="pane active" ng-controller="authForm">
			<form class="auth-reg" action="" name="userForm" ng-submit="submitForm()">
				<input type="email" placeholder="E-mail"  input-mask="{ mask:'a{1,20}@a{1,10}.a{1,5}' ,greedy: false}"    ng-model="user.email" required>
				<input type="password" placeholder="Пароль" ng-model="user.password" required>
				<input type="submit" value="Войти" class="button blue vhod">
			</form>
		</div>
		<div class="pane" ng-controller="regForm">
			<form class="auth-reg" action="" name="userForm" ng-submit="submitForm()">
				<input type="text" placeholder="Представьтесь" ng-model="user.name" required>
				<input type="phone" placeholder="Телефон"  input-mask="{mask: '+7(999)999-99-99'}" ng-model="user.phone">
				<input type="email" placeholder="E-mail" input-mask="{ mask:'a{1,20}@a{1,10}.a{1,5}' ,greedy: false}"   ng-model="user.email" required>
				<input type="password" placeholder="Пароль" ng-model="user.password" required>
				<input type="password" placeholder="Повотрить пароль" ng-model="user.passwordToo" required>
				<input type="submit" value="Зарегистрироваться" class="button blue">
			</form>
		</div>		
	</div>

</div>


<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = '8B1UHlQNmR';
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);})();</script>
<!-- {/literal} END JIVOSITE CODE -->

﻿<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter25607369 = new Ya.Metrika({id:25607369,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/25607369" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/libs/angular.min.js"></script>
<!--<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/libs/ui-utils.min.js"></script>-->
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/app.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/full.min.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/libs/jquery.inputmask.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH;?>/js/main.js"></script>
<!--nouislider-->
<script src="<?=SITE_TEMPLATE_PATH;?>/js/libs/jquery.nouislider.min.js"></script>
<link href="<?=SITE_TEMPLATE_PATH;?>/css/jquery.nouislider.css" rel="stylesheet">

</body>
</html>