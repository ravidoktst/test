$(document).ready(function(){

	//верхний слайдер на главной

	var mainSlider = $(".main-slider ul").bxSlider({
		useCSS: false,
		auto:true,
		pause:7000,
		speed:500,
		pager:true,
		controls:true
	});

	var sertificatesSlider = $(".sertificates ul").bxSlider({
		auto: true,
		useCSS: false,
		controls:true,
		maxSlides:6,
		minSlides:6,
		moveSlides: 1,
		slideWidth:140,
		slideMargin: 25
	});

	var itemDetailSlider = $(".item-detail .bxslider").bxSlider({
		useCSS: false,
		infiniteLoop:false,
		controls:false,
		pagerCustom: '#bx-pager',
		maxSlides:3,
		minSlides:3
	});

	//аккордеон вопрос-ответ
		$(".vopros-otvet li").on('click', function(e){
			var target = $(this),
			content = $('.otvet',target),
			other = target.parent().find("li.open").not(target);


			if(!target.hasClass('open')){
				target.addClass('open');
				other.removeClass('open');
				$('.otvet',other).slideUp(270, 'swing');
				content.slideDown(400, function(){});

			}else{
				content.slideUp(350, function(){
					$(this).parent().removeClass('open');
				});
			}
		});

	//переключение табов
	$('.tabs li').on('click', function(){

		var tab = $(this),
				index = tab.index(),
				tabs = tab.parents('.tabs'),
				panes = tabs.siblings('.panes');

		//активизируем таб
		tab.siblings('li').removeClass('active').end().addClass('active');

		//активизируем соответствующую панель
		panes.find('.pane').removeClass('active');
		panes.find('.pane').eq(index).addClass('active');

	});

	  //высплывающие окна
    $('.popup').popup({
        type: 'overlay',
        horizontal:'center',
        transition: 'all 0.2s',
	      opentransitionend: function(button){
		      $('.popup .field:eq(0)').find('input').focus();
	      }
    });

    $('.popup .closer').on('click',function(){
        $('.popup').popup('hide');
    });


	//fancybox галлерея
	$("a[rel='fancybox']").fancybox();


	//картa
	if($('#map').length){

		ymaps.ready(init);

		var Map,
			coordinates = [$('#map').data('x'), $('#map').data('y')],
		       markerData = {
			        iconImageHref: '/img/map-marker.png',
			        iconImageSize: [37, 48],
			        iconImageOffset: [-15, -58]
		    };

	    function init() {

		    //Чебоксары
		    Map = new ymaps.Map("map", {
			    center: coordinates,
			    zoom: 17
		    });

		    var objectMarker = new ymaps.Placemark(coordinates, {}, markerData );
		    Map.geoObjects.add(objectMarker);
		    Map.controls.add('zoomControl', { top: 100, right: 15 });
			}
	}

	$('#overlay,#thanks #close,#auth .close').click(function(){
		$('#overlay,#thanks,#auth').fadeOut();
	});

	$('#header span.vhod').click(function(){
		$('#overlay,#auth').fadeIn();
	});

	$('.right-side,.round-header, .item-detail').delegate('#btnAdd','click',function(){    
		$('#overlay,#thanks').fadeIn();                     
        $.ajax({
            type: "GET",
            url: $(this).attr("href"),
            dataType: "html",
            success: function(out) {
               $(".top-cart .value").text($(".top-cart .value", out).text());
               $(".top-cart").attr('href',$(".top-cart", out).attr('href'));
            },

        });
		return false; 
	});

	var interval = setInterval(
		function() {
    		if ($('.top-cart .value').text()!='0') {
    			$('.top-cart').removeClass('nohover');
    			//clearInterval(interval);
    		}else{
    			$('.top-cart').addClass('nohover');
    		}
		}
		,1000);
/*
    $('input[name="phone"]').inputmask("+7(999)-999-99-99");
    $('input[name="email"]').inputmask({ "mask":"a{1,20}@a{1,10}.a{1,5}" ,"greedy": false});*/
});