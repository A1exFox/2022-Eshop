$(function () {

    // Cart

    function showCart(cart) {
        $('#cart-modal .modal_cart_content').html(cart)
        const myModalEl = document.querySelector('#cart-modal')
        const modal = bootstrap.Modal.getOrCreateInstance(myModalEl)
        modal.show()

        const qty = $('.cart-qty').text()
        if (qty) {
            $('.count-items').text(qty)
        } else {
            $('.count-items').text('0')
        }
    }

    $('#get-cart').on('click', function (e) {
        e.preventDefault()
        $.ajax({
            url: 'cart/show',
            type: 'GET',
            success: function (res) {
                showCart(res)
            },
            error: function () {
                alert('Error')
            }
        })
    })

    $('#cart-modal .modal_cart_content').on('click', '.del-item', function (e) {
        e.preventDefault()
        const id = $(this).data('id');
        $.ajax({
            url: 'cart/delete',
            type: 'GET',
            data: { id },
            success: function (res) {
                showCart(res)
            },
            error: function () {
                alert("Error")
            }
        })
    })

    $('#cart-modal .modal_cart_content').on('click', '#clear-cart', function () {
        $.ajax({
            url: 'cart/clear',
            type: 'GET',
            success: function (res) {
                showCart(res)
            },
            error: function () {
                alert('Error')
            },
        })
    })

    $('.add-to-cart').on('click', function (e) {
        e.preventDefault()
        const id = $(this).data('id')
        const qty = $('#input-quantity').val() ? $('#input-quantity').val() : 1;
        const $this = $(this)

        $.ajax({
            url: 'cart/add',
            type: 'GET',
            data: { id, qty },
            success: function (res) {
                showCart(res);
                console.log($this.find('i'))
                $this.find('i')
                    .removeClass('fa-shopping-cart')
                    .addClass('fa-luggage-cart')
            },
            error: function () {
                alert('Error')
            }
        })
    })
    // End Cart

    $('#input-sort').on('change', function () {
        let sortOption = ''
        if ($(this).val() != 'sort=default') {
            sortOption = '?' + $(this).val()
        }
        window.location = PATH + window.location.pathname + sortOption
    })

    $('.open-search').click(function (e) {
        e.preventDefault();
        $('#search').addClass('active');
    });
    $('.close-search').click(function () {
        $('#search').removeClass('active');
    });

    $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
            $('#top').fadeIn();
        } else {
            $('#top').fadeOut();
        }
    });

    $('#top').click(function () {
        $('body, html').animate({ scrollTop: 0 }, 700);
    });

    $('.sidebar-toggler .btn').click(function () {
        $('.sidebar-toggle').slideToggle();
    });

    $('.thumbnails').magnificPopup({
        type: 'image',
        delegate: 'a',
        gallery: {
            enabled: true
        },
        removalDelay: 500,
        callbacks: {
            beforeOpen: function () {
                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                this.st.mainClass = this.st.el.attr('data-effect');
            }
        }
    });

    $('#languages button').on('click', function () {
        const lang_code = $(this).data('langcode');
        window.location = PATH + '/language/change?lang=' + lang_code
    })

    $('.product-card').on('click', '.add-to-wishlist', function (e) {
        e.preventDefault()
        const id = $(this).data('id')
        const $this = $(this)
        $.ajax({
            url: 'wishlist/add',
            type: 'GET',
            data: { id },
            success: function (res) {
                res = JSON.parse(res)
                console.log(res);
            },
            error: function () {
                alert('Error')
            }
        })
    })

});