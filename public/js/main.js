(function ($) {
    "use strict";

    $(document).ready(function($){
      
        // testimonial sliders
        $(".testimonial-sliders").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:1,
                    nav:false
                },
                1000:{
                    items:1,
                    nav:false,
                    loop:true
                }
            }
        });

        // homepage slider
        $(".homepage-slider").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            nav: true,
            dots: false,
            navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
            responsive:{
                0:{
                    items:1,
                    nav:false,
                    loop:true
                },
                600:{
                    items:1,
                    nav:true,
                    loop:true
                },
                1000:{
                    items:1,
                    nav:true,
                    loop:true
                }
            }
        });

        // logo carousel
        $(".logo-carousel-inner").owlCarousel({
            items: 4,
            loop: true,
            autoplay: true,
            margin: 30,
            responsive:{
                0:{
                    items:1,
                    nav:false
                },
                600:{
                    items:3,
                    nav:false
                },
                1000:{
                    items:4,
                    nav:false,
                    loop:true
                }
            }
        });

        // count down
        if($('.time-countdown').length){  
            $('.time-countdown').each(function() {
            var $this = $(this), finalDate = $(this).data('countdown');
            $this.countdown(finalDate, function(event) {
                var $this = $(this).html(event.strftime('' + '<div class="counter-column"><div class="inner"><span class="count">%D</span>Days</div></div> ' + '<div class="counter-column"><div class="inner"><span class="count">%H</span>Hours</div></div>  ' + '<div class="counter-column"><div class="inner"><span class="count">%M</span>Mins</div></div>  ' + '<div class="counter-column"><div class="inner"><span class="count">%S</span>Secs</div></div>'));
            });
         });
        }

        // projects filters isotop
        $(".product-filters li").on('click', function () {
            
            $(".product-filters li").removeClass("active");
            $(this).addClass("active");

            var selector = $(this).attr('data-filter');

            $(".product-lists").isotope({
                filter: selector,
            });
            
        });


        $(".category-filters li input[type=checkbox]").on('click', function () {
            
            if ($(this).prop("checked") == true)
            {
                // $(this).parent().addClass("active");
            }
            else if ($(this).prop("checked") == false)
            {
                // $(this).parent().removeClass("active");
            }

            if ($(this).val() == 0)
            {
                $(".category-filters li").removeClass("active");
                $(".category-filters li input[type=checkbox]").prop("checked", false);
                $(this).prop("checked", true);
                // $(this).parent().addClass("active");
            }
            else
            {
                $("#all_category").parent().removeClass("active");
                $("#all_category").prop("checked", false);
            }
        });

        // isotop inner
        $(".product-lists").isotope();

        // magnific popup
        $('.popup-youtube').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });

        // light box
        $('.image-popup-vertical-fit').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-img-mobile',
            image: {
                verticalFit: true
            }
        });

        // homepage slides animations
        $(".homepage-slider").on("translate.owl.carousel", function(){
            $(".hero-text-tablecell .subtitle").removeClass("animated fadeInUp").css({'opacity': '0'});
            $(".hero-text-tablecell h1").removeClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.3s'});
            $(".hero-btns").removeClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.5s'});
        });

        $(".homepage-slider").on("translated.owl.carousel", function(){
            $(".hero-text-tablecell .subtitle").addClass("animated fadeInUp").css({'opacity': '0'});
            $(".hero-text-tablecell h1").addClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.3s'});
            $(".hero-btns").addClass("animated fadeInUp").css({'opacity': '0', 'animation-delay' : '0.5s'});
        });

       

        // stikcy js
        $("#sticker").sticky({
            topSpacing: 0
        });

        //mean menu
        $('.main-menu').meanmenu({
            meanMenuContainer: '.mobile-menu',
            meanScreenWidth: "992"
        });
        
         // search form
        $(".search-bar-icon").on("click", function(){
            $(".search-area").addClass("search-active");
        });

        $(".close-btn").on("click", function() {
            $(".search-area").removeClass("search-active");
        });

        $(".cart-btn").on("click", function(e) {
            e.preventDefault();
            var product = $(this);
            var product_id = $(this).data("product-id");
            var quantity = $(this).data("quantity");
            var cart_quantity = $('#cart-quantity').val();
            var cart_id = $(this).data("cart");

            if (product_id == 0)
            {
                $('#message-alert').html('Please login to add items to your cart');
                $('#toast-title').html('Log in')
                $('.toast').toast('show');
                $('.cart-count').text('0');
            }
            else if (quantity <= 0 || quantity < cart_quantity)
            {
                $('#message-alert').html('Item out of stock');
                $('#toast-title').html('Out of stock');
                $('.toast').toast('show');
            }
            
            var url = 'ajax/add/' + product_id;
            var path = window.location.pathname;
            if(path.search("/products/") >= 0)
            {
                url = '../ajax/add/' + product_id
            }

                $.ajax({
                    
                    url: url,
                    type:'GET',
                    data: { 
                        product_id: product_id,
                        cart_quantity: cart_quantity,
                        cart_id: cart_id
                    },
                    success: function(data) {
                        if (parseInt(data.flag) == 1)
                        {
                            $(product).html("<i class='fas fa-shopping-cart'></i>Out of Stock");
                            $(product).attr('href', '#');
                            $('#message-alert').html(data.success);
                            $('#toast-title').html(data.title);
                            $('.toast').toast('show');
                        }
                        else if (parseInt(data.flag) == 2)
                        {
                            $('#message-alert').html(data.success);
                            $('#toast-title').html(data.title);
                            $('.toast').toast('show');                            
                        }
                        else
                        {
                            $('#message-alert').html(data.success);
                            $('#toast-title').html(data.title);
                            $('.toast').toast('show');
                            $('.cart-count').text(data.quantity);
                            $('.cart-count').removeClass('d-none');
                        }
                    }
                });
        });

        $(".remove-product").on("click", function(e) {
            e.preventDefault();
            var cart_product_id = $(this).data("cart-product-id");
            var cart_id = $(this).data("cart-id");
            $.ajax({
                url: "ajax/delete/" + cart_product_id,
                type:'GET',
                // data: { cart_product_id: cart_product_id },
                success: function(data) {
                    $('#product-row-' + cart_product_id ).remove();
                    $('#subtotal').text('₹' + data.subtotal);
                    $('#shipping').text('₹' + data.shipping);
                    $('#tax').text('₹' + data.tax);
                    $('#total').text('₹' + data.total);
                    $('#message-alert').html(data.success + ' has been deleted from your cart.');
                    $('#message-alert').attr('class', 'alert alert-danger');
                    if (data.quantity == 0)
                    {
                        $('.cart-count').text(data.quantity);
                        $('.cart-count').addClass('d-none');
                        $('#items').html('<tr><td colspan="6">No items added</td></tr>');
                    }
                    else
                    {
                        $('.cart-count').text(data.quantity);
                        $('.cart-count').removeClass('d-none');
                    }
                    $("#message-alert").fadeTo(2000, 500).fadeOut(500, function() {
                        $("#message-alert").fadeOut(500);
                      });             
                }
            });
        });

        $(".product-quantity > input").on("input", function(e) {
            var quantity = $(this).val();
            var price = $(this).parent().prev().text().replace('₹', '');
            var product_total = quantity * price;
            $(this).parent().next().text('₹' + product_total);
            var products = $(".table-body-row");
            var subtotal = 0;
            $(products).each(function (index, product) {
                product_total = $(product).find('.product-total').text().replace('₹', '');
                subtotal += parseInt(product_total);
            });
            var shipping = $('#shipping').text().replace('₹', '');
            var tax = $('#tax').text().replace('₹', '');
            var total = parseInt(subtotal) + parseInt(shipping) + parseInt(tax);
            $('#subtotal').text('₹' + subtotal);
            $('#shipping').text('₹' + shipping);
            $('#total').text('₹' + total);            
        });

        $("#update-cart").on("click", function(e) {
            e.preventDefault();
            var token = $(this).prev().val();
            var obj = $('tr.table-body-row');
            var cart = [];

            obj.each(function (index, row){
                    cart.push([$(row).data('cart-product-id'), parseInt($(row).find('input').val())]);
            });
            
            var cart_string = JSON.stringify(cart);
            var subtotal = $('#subtotal').text().replace('₹', '');
            var shipping = $('#shipping').text().replace('₹', '');
            var tax = $('#tax').text().replace('₹', '');
            var total = $('#total').text().replace('₹', '');
          
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "ajax/update",
                type: 'POST',
                dataType: 'json',
                data: {
                    "_token": token, 
                    cart_string: cart_string,
                    subtotal: subtotal,
                    shipping: shipping,
                    tax: tax,
                    total: total
                },
                success: function(data) {
                    if (data.flag == 1)
                    {
                        $('#subtotal').text("₹" + data.subtotal);
                        $('#shipping').text("₹" + data.shipping);
                        $('#tax').text("₹" + data.tax);
                        $('#total').text("₹" + data.total);
                        $('#message-alert').html(data.success);
                        $('#message-alert').attr('class', 'alert alert-danger');
                        if (data.quantity == 0)
                        {
                            $('.cart-count').text(data.quantity);
                            $('.cart-count').addClass('d-none');
                            $('#items').html('<tr><td colspan="6">No items added</td></tr>');
                        }
                        else
                        {
                            $('.cart-count').text(data.quantity);
                            $('.cart-count').removeClass('d-none');
                        }
                    }
                    else
                    {
                        obj.each(function (index, row){
                            if (data.cart_totals[index] == 0)
                            {
                                $(row).remove();
                            }
                            else
                            {
                                $(row).find('.product-total').text(data.cart_totals[index]);
                            }
                            $('#subtotal').text("₹" + data.subtotal);
                            $('#shipping').text("₹" + data.shipping);
                            $('#tax').text("₹" + data.tax);
                            $('#total').text("₹" + data.total);
                            $('#message-alert').html(data.success);
                            $('#message-alert').attr('class', 'alert alert-success');
                            if (data.quantity == 0)
                            {
                                $('.cart-count').text(data.quantity);
                                $('.cart-count').addClass('d-none');
                                $('#items').html('<tr><td colspan="6">No items added</td></tr>');
                            }
                            else
                            {
                                $('.cart-count').text(data.quantity);
                                $('.cart-count').removeClass('d-none');
                            }
                        });
                    }
                }
            });
        });

        $("#coupon_btn").on("click", function(e) {
            e.preventDefault();
            var coupon = $('#coupon_code').val();
            var subtotal = $('#subtotal').text().replace('₹', '');
            var shipping = $('#shipping').text().replace('₹', '');
            var tax = $('#tax').text().replace('₹', '');
            var total = $('#total').text().replace('₹', '');
            var token = $(this).parent().siblings().first().val();
            var coupon_state = $(this).val();
            var state;

            if (coupon_state == 'Apply')
            {
                state = 1;
            }
            else if (coupon_state == 'Remove Coupon')
            {
                state = 0;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "ajax/coupon",
                type: 'POST',
                data: {
                    "_token": token,
                    coupon: coupon,
                    state: state
                },
                success: function(data) {
                    if (data.flag == 1 && state == 1)
                    {
                        $('#discount').text("₹" + data.discount);
                        $('#total').text("₹" + data.total);
                        $('#coupon-alert').html(data.success);
                        $('#coupon-alert').attr('class', 'text-success');
                        $('#coupon_btn').val('Remove Coupon');
                    }
                    else if (data.flag == 0 && state == 1)
                    {
                        $('#discount').text('₹0');
                        $('#total').text("₹" + data.total);
                        $('#coupon-alert').html(data.success);
                        $('#coupon-alert').attr('class', 'text-danger');
                        $('#coupon_btn').val('Apply');
                    }
                    else if (data.flag == 0 && state == 1)
                    {
                        $('#discount').text('₹0');
                        $('#total').text("₹" + data.total);
                        $('#coupon-alert').html(data.success);
                        $('#coupon-alert').attr('class', 'text-danger');
                        $('#coupon_btn').val('Apply');
                    }
                    else if (data.flag == 0 && state == 0)
                    {
                        $('#discount').text('₹0');
                        $('#total').text("₹" + data.total);
                        $('#coupon-alert').html(data.success);
                        $('#coupon-alert').attr('class', 'text-danger');
                        $('#coupon_btn').val('Apply');
                        $('#coupon_code').val('');
                    }


                }
            });
        });


        $('.shipping-address-form input:radio').on('click', function(e) {
            if ($(this).val() == 0)
            {
                $('#shipping_address_form').attr('class', 'shipping-address-form');
            }
            else
            {
                $('#shipping_address_form').attr('class', 'shipping-address-form d-none');
            }
        });

        if ($('#same').prop('checked') == true)
        {
            $('.address-form').attr('class', 'address-form d-none');
        }
        else
        {
            $('.address-form').attr('class', 'address-form');
        }

        $('#same').on('click', function(e) {

            if ($('#same').prop('checked') == true)
            {
                $('.address-form').attr('class', 'address-form d-none');
                $("input[name=selected_billing_address][value=" + $('input[name="selected_shipping_address"]:checked').val() + "]").prop('checked', true);
                $('#billing_description').val($('#shipping_description').val()); 
                $('#billing_contact_person').val($('#shipping_contact_person').val()); 
                $('#billing_address1').val($('#shipping_address1').val()); 
                $('#billing_address2').val($('#shipping_address2').val()); 
                $('#billing_landmark').val($('#shipping_landmark').val()); 
                $('#billing_contact_phone').val($('#shipping_contact_phone').val()); 
                $('select[name="billing_city"] option[value="' + $('#shipping_city').val() + '"]').attr("selected","selected");
                $('select[name="billing_district"] option[value="' + $('#shipping_district').val() + '"]').attr("selected","selected");
                $('select[name="billing_state"] option[value="' + $('#shipping_state').val() + '"]').attr("selected","selected");
                $('select[name="billing_country"] option[value="' + $('#shipping_country').val() + '"]').attr("selected","selected");
            }
            else
            {
                $('.address-form').attr('class', 'address-form');
            }

        });


        $('.billing-address-form input:radio').on('click', function(e) {
            if ($(this).val() == 0)
            {
                $('#billing_address_form').attr('class', 'billing-address-form');
            }
            else
            {
                $('#billing_address_form').attr('class', 'billing-address-form d-none');
            }
        });






    });

    jQuery(window).on("load",function(){
        jQuery(".loader").fadeOut(1000);
    });


}(jQuery));