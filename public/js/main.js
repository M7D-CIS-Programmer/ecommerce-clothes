
(function ($) {
    "use strict";

    /*[ Load page ]
    ===========================================================*/
    $(".animsition").animsition({
        inClass: 'fade-in',
        outClass: 'fade-out',
        inDuration: 1500,
        outDuration: 800,
        linkElement: '.animsition-link',
        loading: true,
        loadingParentElement: 'html',
        loadingClass: 'animsition-loading-1',
        loadingInner: '<div class="loader05"></div>',
        timeout: false,
        timeoutCountdown: 5000,
        onLoadEvent: true,
        browser: ['animation-duration', '-webkit-animation-duration'],
        overlay: false,
        overlayClass: 'animsition-overlay-slide',
        overlayParentElement: 'html',
        transition: function (url) { window.location.href = url; }
    });

    /*[ Back to top ]
    ===========================================================*/
    var windowH = $(window).height() / 2;

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display', 'flex');
        } else {
            $("#myBtn").css('display', 'none');
        }
    });

    $('#myBtn').on("click", function () {
        $('html, body').animate({ scrollTop: 0 }, 300);
    });


    /*==================================================================
    [ Fixed Header ]*/
    var headerDesktop = $('.container-menu-desktop');
    var wrapMenu = $('.wrap-menu-desktop');

    if ($('.top-bar').length > 0) {
        var posWrapHeader = $('.top-bar').height();
    }
    else {
        var posWrapHeader = 0;
    }


    if ($(window).scrollTop() > posWrapHeader) {
        $(headerDesktop).addClass('fix-menu-desktop');
        $(wrapMenu).css('top', 0);
    }
    else {
        $(headerDesktop).removeClass('fix-menu-desktop');
        $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
    }

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > posWrapHeader) {
            $(headerDesktop).addClass('fix-menu-desktop');
            $(wrapMenu).css('top', 0);
        }
        else {
            $(headerDesktop).removeClass('fix-menu-desktop');
            $(wrapMenu).css('top', posWrapHeader - $(this).scrollTop());
        }
    });


    /*==================================================================
    [ Menu mobile ]*/
    $('.btn-show-menu-mobile').on('click', function () {
        $(this).toggleClass('is-active');
        $('.menu-mobile').slideToggle();
    });

    var arrowMainMenu = $('.arrow-main-menu-m');

    for (var i = 0; i < arrowMainMenu.length; i++) {
        $(arrowMainMenu[i]).on('click', function () {
            $(this).parent().find('.sub-menu-m').slideToggle();
            $(this).toggleClass('turn-arrow-main-menu-m');
        })
    }

    $(window).resize(function () {
        if ($(window).width() >= 992) {
            if ($('.menu-mobile').css('display') == 'block') {
                $('.menu-mobile').css('display', 'none');
                $('.btn-show-menu-mobile').toggleClass('is-active');
            }

            $('.sub-menu-m').each(function () {
                if ($(this).css('display') == 'block') {
                    console.log('hello');
                    $(this).css('display', 'none');
                    $(arrowMainMenu).removeClass('turn-arrow-main-menu-m');
                }
            });

        }
    });


    /*==================================================================
    [ Show / hide modal search ]*/
    $('.js-show-modal-search').on('click', function () {
        $('.modal-search-header').addClass('show-modal-search');
        $(this).css('opacity', '0');
    });

    $('.js-hide-modal-search').on('click', function () {
        $('.modal-search-header').removeClass('show-modal-search');
        $('.js-show-modal-search').css('opacity', '1');
    });

    $('.container-search-header').on('click', function (e) {
        e.stopPropagation();
    });


    /*==================================================================
    [ Isotope ]*/
    var $topeContainer = $('.isotope-grid');
    var $filter = $('.filter-tope-group');

    // filter items on button click
    $filter.each(function () {
        $filter.on('click', 'button', function () {
            var filterValue = $(this).attr('data-filter');
            $topeContainer.isotope({ filter: filterValue });
        });

    });

    // init Isotope
    $(window).on('load', function () {
        var $grid = $topeContainer.each(function () {
            $(this).isotope({
                itemSelector: '.isotope-item',
                layoutMode: 'fitRows',
                percentPosition: true,
                animationEngine: 'best-available',
                masonry: {
                    columnWidth: '.isotope-item'
                }
            });
        });
    });

    var isotopeButton = $('.filter-tope-group button');

    $(isotopeButton).each(function () {
        $(this).on('click', function () {
            for (var i = 0; i < isotopeButton.length; i++) {
                $(isotopeButton[i]).removeClass('how-active1');
            }

            $(this).addClass('how-active1');
        });
    });

    /*==================================================================
    [ Filter / Search product ]*/
    $('.js-show-filter').on('click', function () {
        $(this).toggleClass('show-filter');
        $('.panel-filter').slideToggle(400);

        if ($('.js-show-search').hasClass('show-search')) {
            $('.js-show-search').removeClass('show-search');
            $('.panel-search').slideUp(400);
        }
    });

    $('.js-show-search').on('click', function () {
        $(this).toggleClass('show-search');
        $('.panel-search').slideToggle(400);

        if ($('.js-show-filter').hasClass('show-filter')) {
            $('.js-show-filter').removeClass('show-filter');
            $('.panel-filter').slideUp(400);
        }
    });




    /*==================================================================
    [ Cart ]*/
    $('.js-show-cart').on('click', function () {
        $('.js-panel-cart').addClass('show-header-cart');
    });

    $('.js-hide-cart').on('click', function () {
        $('.js-panel-cart').removeClass('show-header-cart');
    });

    /*==================================================================
    [ Cart ]*/
    $('.js-show-sidebar').on('click', function () {
        $('.js-sidebar').addClass('show-sidebar');
    });

    $('.js-hide-sidebar').on('click', function () {
        $('.js-sidebar').removeClass('show-sidebar');
    });

    /*==================================================================
    [ +/- num product ]*/
    $('.btn-num-product-down').on('click', function () {
        var input = $(this).siblings('input.num-product'); // إيجاد الـ input المرتبط
        var numProduct = Number(input.val());

        if (numProduct > 1) { // التأكد أن الكمية لا تنقص إلى أقل من 1
            input.val(numProduct - 1);
        }
    });


    $('.btn-num-product-up').on('click', function () {
        var numProduct = Number($(this).prev().val());
        $(this).prev().val(numProduct + 1);
    });

    /*==================================================================
    [ Rating ]*/
    $('.wrap-rating').each(function () {
        var item = $(this).find('.item-rating');
        var rated = -1;
        var input = $(this).find('input');
        $(input).val(0);

        $(item).on('mouseenter', function () {
            var index = item.index(this);
            var i = 0;
            for (i = 0; i <= index; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for (var j = i; j < item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });

        $(item).on('click', function () {
            var index = item.index(this);
            rated = index;
            $(input).val(index + 1);
        });

        $(this).on('mouseleave', function () {
            var i = 0;
            for (i = 0; i <= rated; i++) {
                $(item[i]).removeClass('zmdi-star-outline');
                $(item[i]).addClass('zmdi-star');
            }

            for (var j = i; j < item.length; j++) {
                $(item[j]).addClass('zmdi-star-outline');
                $(item[j]).removeClass('zmdi-star');
            }
        });
    });

    /*==================================================================
    [ Show modal1 ]*/

    // $('.js-show-modal1').on('click',function(e){
    //     e.preventDefault();
    //     $('.js-modal1').addClass('show-modal1');
    // });
    // $('.js-hide-modal1').on('click',function(){
    //     $('.js-modal1').removeClass('show-modal1');
    // });




    $(document).ready(function () {
        $('.js-show-modal1').on('click', function (e) {
            e.preventDefault();

            let id = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');
            let description = $(this).data('description');
            let imgSrc = $(this).data('img');

            $('.js-modal-id').val(id);
            $('.js-modal-name').text(name);
            $('.js-modal-price').text('$' + price);
            $('.js-modal-desc').text(description);
            $('.js-modal-img').attr('src', imgSrc);

            // استبدال :id في الرابط بـ id الحقيقي
            let urlTemplate = $('#quick-view-link').data('url');
            let finalUrl = urlTemplate.replace(':id', id);

            // تحديث الرابط النهائي
            $('#quick-view-link').attr('href', finalUrl);

            $('.js-modal1').addClass('show-modal1');
        });

        $('.js-hide-modal1').on('click', function () {
            $('.js-modal1').removeClass('show-modal1');
        });
    });





    $(document).ready(function () {
        let selectedProductId = null; // متغير لتخزين ID المنتج عند فتح Quick View

        // عند الضغط على Quick View، خزّن بيانات المنتج في المودال
        $('.js-show-modal1').on('click', function (e) {
            e.preventDefault();

            // 🛑 إعادة ضبط القيم الافتراضية عند فتح المودال
            $('#modal-product-id').val('');
            $('.js-modal-name').text('');
            $('.js-modal-price').text('');
            $('.js-modal-desc').text('');
            $('.js-modal-img').attr('src', '');
            $("select[name='size']").prop('selectedIndex', 0);
            $("select[name='color']").prop('selectedIndex', 0);
            $("#quantity").val(1);

            // ✅ جلب البيانات الجديدة للمنتج
            selectedProductId = $(this).data('id');
            let name = $(this).data('name');
            let price = $(this).data('price');
            let description = $(this).data('description');
            let imgSrc = $(this).data('img');

            // ✅ تحديث بيانات المودال
            $('#modal-product-id').val(selectedProductId);
            $('.js-modal-name').text(name);
            $('.js-modal-price').text('$' + price);
            $('.js-modal-desc').text(description);
            $('.js-modal-img').attr('src', imgSrc);

            $('.js-modal1').addClass('show-modal1');
        });

        // عند الضغط على زر "Add To Cart"
        $("#addToCartForm").submit(function (event) {
            event.preventDefault(); // منع إعادة تحميل الصفحة

            // إعادة ضبط الرسائل والأنماط قبل التحقق
            $('.error-message').remove();  // إزالة الرسائل السابقة
            $('select, input').removeClass('is-invalid');  // إزالة أي رسائل خطأ سابقة

            let valid = true; // متغير لاحتساب ما إذا كانت البيانات صحيحة

            let formData = $(this).serialize(); // جلب البيانات من النموذج
            let actionUrl = $(this).attr('action');

            // التحقق من اختيار الحجم
            if ($("select[name='size']").val() === null || $("select[name='size']").val() === "") {
                valid = false;
                $("select[name='size']").addClass('is-invalid'); // تمييز الحقل بالخطأ
                $("select[name='size']").after('<div class="error-message text-danger"> Please Select Size </div>'); // إضافة رسالة الخطأ
            }

            // التحقق من اختيار اللون
            if ($("select[name='color']").val() === null || $("select[name='color']").val() === "") {
                valid = false;
                $("select[name='color']").addClass('is-invalid'); // تمييز الحقل بالخطأ
                $("select[name='color']").after('<div class="error-message text-danger"> Please Select Color </div>'); // إضافة رسالة الخطأ
            }

            // التحقق من الكمية
            let qty = parseInt($("#quantity").val());
            if (qty < 1 || isNaN(qty)) {
                valid = false;
                $("#quantity").addClass('is-invalid'); // تمييز الحقل بالخطأ
                $("#quantity").after('<div class="error-message text-danger">يرجى إدخال كمية صحيحة</div>'); // إضافة رسالة الخطأ
            }

            if (!valid) {
                return; // إذا كانت هناك أخطاء في المدخلات، لا يتم إرسال النموذج
            }

            // إرسال البيانات باستخدام Ajax فقط إذا كانت البيانات صحيحة
            $.ajax({
                url: actionUrl,
                type: "GET",  // يمكنك تغييره إلى "POST" إذا كنت تستخدم `@csrf`
                data: formData,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'تمت الإضافة!',
                            text: 'تمت إضافة المنتج إلى السلة بنجاح.',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'حسنًا'
                        });

                        $('.js-modal1').removeClass('show-modal1'); // إغلاق المودال بعد الإضافة
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'خطأ!',
                        text: 'حدث خطأ، حاول مرة أخرى.',
                        confirmButtonColor: '#dc3545',
                        confirmButtonText: 'موافق'
                    });
                }
            });
        });

        // زيادة أو تقليل الكمية
        $("#increase").click(function () {
            let qty = parseInt($("#quantity").val());
            $("#quantity").val(qty + 1);
        });

        $("#decrease").click(function () {
            let qty = parseInt($("#quantity").val());
            if (qty > 1) {
                $("#quantity").val(qty - 1);
            }
        });
    });


    /*==================================================================*/
    // إعدادات CSRF Token لـ AJAX
    // هذا مهم لحماية الطلبات POST في Laravel
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // التعامل مع إضافة وإزالة المنتجات من المفضلة
    $('.btn-addwish-b2').on('click', function (e) {
        e.preventDefault();

        let heart = $(this);
        let productId = heart.data('id');

        // منع الضغط المتكرر
        if (heart.data('loading')) return;
        heart.data('loading', true);

        $.ajax({
            url: `/favorite/toggle/${productId}`, // إرسال الـ ID في الرابط
            method: 'GET',
            success: function (response) {
                if (response.status === 'added') {
                    heart.addClass('js-addedwish-b2');
                } else if (response.status === 'removed') {
                    heart.removeClass('js-addedwish-b2');
                }


            },
            error: function () {
                swal("حدث خطأ!", "يرجى المحاولة لاحقاً", "error");
            },
            complete: function () {
                heart.data('loading', false);
            }
        });
    });




    


})(jQuery);