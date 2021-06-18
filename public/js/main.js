/*price range*/

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};

/*scroll to top*/

$(document).ready(function(){

    function ajaxSetup() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    let cart = [];

    if(localStorage.getItem('cart') == null){
        localStorage.setItem('cart', JSON.stringify(cart));
    }else {
        cart = JSON.parse(localStorage.getItem('cart'));
    }

    function cartItemRemove(id){
        cart = cart.filter(x => x.id !== Number(id));
        localStorage.setItem('cart', JSON.stringify(cart));
        getCart(cart);
    }

    function getCart(cart) {
        console.log(cart);
        if(cart.length === 0){
            $("#cartTable").find('tbody').html('<tr><td colspan="6">Your cart is empty</td></tr>');
        }else {
            ajaxSetup();
            $.ajax({
                url: '/products/cart/get',
                method: 'post',
                dataType: 'json',
                data: {
                    cart: cart.map(x => x.id)
                },
                success: function (response) {
                    if(response.error !== undefined){
                        console.log(response);
                        return;
                    }
                    localStorage.setItem('products', JSON.stringify(response));
                    let output = '';
                    for(let x of response){
                        output += `
                    <tr>
                        <td class="cart_product">
                            <a href=""><img width="100" src="storage/${x.image.name}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">${x.name}</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">
                            <p>$${x.price}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button" data-id="${x.id}">
                                <input class="cart_quantity_input" type="number" min=1 data-id=${x.id} data-price="${x.price}" name="quantity" value=1 autocomplete="off" size="2">
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">$${x.price}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete cartItemRemove" data-id="${x.id}" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    `;
                    }
                    $("#cartTable").find('tbody').html(output);
                    $(".cartItemRemove").click(function(e){
                        e.preventDefault();
                        cartItemRemove($(this).attr('data-id'));
                    });
                    $(".cart_quantity_input").change(function(){
                        let quantity = Number($(this).val());
                        let id = Number($(this).attr('data-id'));
                        let price = Number($(this).attr('data-price'));
                        for(let x of cart){
                            if(x.id === id){
                                x.quantity = quantity;
                            }
                        }
                        $(this).parent().parent().parent().find(".cart_total_price").text('$' + (quantity * price));
                    });
                }
            });
        }
    }

	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});

    let currentPage = $('#currentPage').val();

	function getProducts(categories, brands, price) {
        ajaxSetup();
	    $.ajax({
           url: '/products/get',
           method: 'post',
           dataType: 'json',
            data: {
               categories: categories,
                brands: brands,
                price: price
            },
           success: function(response) {
               let count = 0;
               let output = ``;
               for(let x of response){
                   count++;
                   output += `
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="storage/${x.images[0].name}" alt="" />
                                    <h2>${x.price}</h2>
                                    <p>${x.name}</p>
                                    <a href="/products/show/${x.id}" class="btn btn-default add-to-cart"><i class="fa fa-folder-open"></i>Open</a>
                                </div>
                                <!--
                                <img src="images/home/new.png" class="new" alt="" />
                                <img src="images/home/sale.png" class="new" alt="" />
                                -->
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                    <li><a href="" class="addToCartBtn" data-id="${x.id}"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
                                </ul>
                            </div>
                        </div>`;
               }
               if(count == 0) {
                   output += '<p>No products</p>';
               }
               $("#products").html(output);
               $(".addToCartBtn").click(function (e) {
                   e.preventDefault();
                   let item = {
                       id: Number($(this).attr('data-id')),
                       quantity: 1
                   }
                   cart.push(item);
                   localStorage.setItem('cart', JSON.stringify(cart));
                   console.log(cart);
               });
           },
            error: function (jqXHR) {
                console.log(jqXHR);
            }
        });
    }

	if(currentPage === 'shop'){

        let price = [0, 600];
        let categories = [];
        let brands = [];

        $('#sl2').slider()
            .on('slideStop', function(ev){
                price = ev.value;
                getProducts(categories, brands, price);
            });

	    $(".categoryCheckbox").click(function (){
            categories = [];
	        $(".categoryCheckbox").each(function () {
                if($(this).prop('checked')){
                    categories.push(Number($(this).val()));
                }
            });
            getProducts(categories, brands, price);
        });
        $(".brandCheckbox").click(function (){
            brands = [];
            $(".brandCheckbox").each(function () {
                if($(this).prop('checked')){
                    brands.push(Number($(this).val()));
                }
            });
            getProducts(categories, brands, price);
        });
	    getProducts(categories, brands, price);
    }

    if(currentPage === 'cart'){
        getCart(cart);
    }

    $("#checkoutBtn").click(function(){
       localStorage.setItem('cart', JSON.stringify(cart));
    });

    let checkoutList = [];

    if(currentPage === 'checkout'){
        ajaxSetup();
        $.ajax({
            url: '/order/checkout_list',
            method: 'post',
            dataType: 'json',
            data: {
                cart: cart
            },
            success: function (response) {
                let total = 0;
                let output = '';
                for(let x of response){
                    checkoutList.push(x);
                    output += `
                        <tr>
                            <td>${x.name}</td>
                            <td>${x.price}</td>
                            <td>${x.quantity}</td>
                            <td>${x.total}</td>
                        </tr>
                    `;
                    total += x.total;
                }
                output += `<tr>
                    <td colspan="4">Total: ${total}</td>
                </tr>`;
                $("#checkoutTable").find('tbody').html(output);
            },
            error: function (jqXHR){
                console.log(jqXHR);
            }
        });

        $(".btn-order").click(function (){

            let items = checkoutList;
            let address = {
                street_and_no: $("#street_and_no").val(),
                zip_code: $("#zip_code").val(),
                city: $("#city").val(),
                phone: $("#phone").val()
            }

            localStorage.setItem('cart', JSON.stringify([]));
            localStorage.setItem('products', JSON.stringify([]));

            ajaxSetup();
            $.ajax({
                url: '/order/place',
                method: 'post',
                dataType: 'json',
                data: {
                    items: items,
                    address: address
                },
                success: function (response){
                    console.log(response);
                },
                error: function (jqXHR){
                    console.log(jqXHR);
                }
            });

        });
    }

    let drawerOut = false;
    $("#changePassCheckbox").click(function(){
       if(!drawerOut){
           $("#changePassDiv").css('display', 'flex');
           drawerOut = true;
       }else {
           $("#changePassDiv").css('display', 'none');
           drawerOut = false;
       }
    });

});
