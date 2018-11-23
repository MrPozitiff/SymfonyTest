var App = App || {};

App.Cart = function () {
    return {
        initButtons: function () {
            $('#product_add_to_cart').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('href'),
                    method: 'POST',
                    data: {productId:$(this).data('product')},
                    complete: function (response) {
                        App.Cart.updateCartInfoWidget(response.responseText);
                    },
                    error: function (response) {
                        console.log(response);
                    }
                });
            });
        },

        removeItem: function (link) {
            $.ajax({
                url: link,
                method: 'DELETE',
                success: function (response) {
                    App.Cart.updateCartInfoWidget(response);
                },
                error: function (response) {
                    console.log(response);
                }
            });
        },

        closePopup: function () {
            $('#cart-pop-up').removeClass('active');
        },

        updateCartInfoWidget: function (response) {
            let count = $(response).eq(0).data('count');
            $('#cart_counter').text(count);
            $('#popup_container').html(response);
            $('#cart-pop-up').addClass('active');
            $('.scrollable').mCustomScrollbar()
        }
    }
}();

App.Security = function () {
    return {
        init: function () {
            this.initLoginForm();
            this.initSingupForm();
        },
        initLoginForm: function () {
            $('#log-form').on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: "POST",
                    data: form.serialize(),
                    success: function (response) {
                        if (response.success && response.location.length > 0) {
                            window.location.assign(response.location);
                        }
                    },
                    error: function (response) {
                        let res = response.responseJSON;
                        console.log(response);
                        if (res.success !== true && res.message.length > 0) {
                            $('#log_message_container').text(res.message);
                            return;
                        }
                    }
                })
            })
        },

        initSingupForm: function () {
            $('#reg-form').on('submit', function (e) {
                e.preventDefault();
                let form = $(this);
                $.ajax({
                    url: form.attr('action'),
                    method: "POST",
                    data: form.serialize(),
                    success: function (response) {
                        if (response.hasOwnProperty('location')) {
                            window.location.assign(response.location);
                        } else {
                            $('#singup').html(response);
                            App.Security.initSingupForm();
                        }
                    },
                    error: function (response) {
                        console.log(response);
                    }
                })
            })
        }
    }
}();
