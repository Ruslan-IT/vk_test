$(function(){

    //вывод корзины
    function showCart(cart){
        $('.cart-content').html(cart);
        let  cartQty = $('#modal-cart-gty').text() ? $('#modal-cart-gty').text(): 0; //получаем содержимое
        $('.mini-cart-qty').text(cartQty); //меняем содержимое

    }
    //добавление в корзину
    $('.add-cart').on('click', function (e) {
        let id = $(this).data('id');
        
        $.ajax({
            url: 'cartFunc',
            type: 'GET',
            data: {cart: 'add', id: id},
            dataType: 'json',
            success: function (res) {
                if(res.code == 'ok'){
                    showCart(res.answer);
                }else{
                    alert('error')
                }
            },
            error: function () {
                alert('error');
            }
        });
    });
    //минусуем с корзины
    $('.cart-content').on('click', '.minus', function () {
        let id = $(this).data('minus');
        $.ajax({
            url: 'cartFunc',
            type: 'GET',
            data: {cart: 'minus', id: id},
            dataType: 'json',
            success: function (res) {
                if(res.code == 'ok'){
                    showCart(res.answer);
                }else{
                    alert('error')
                }
            },
            error: function () {
                alert('error');
            }
        });
    });
    //прибавляем в корзине
    $('.cart-content').on('click', '.plus', function () {
        let id = $(this).data('plus');
        $.ajax({
            url: 'cartFunc',
            type: 'GET',
            data: {cart: 'plus', id: id},
            dataType: 'json',
            success: function (res) {
                if(res.code == 'ok'){
                    showCart(res.answer);
                }else{
                    alert('error')
                }
            },
            error: function () {
                alert('error');
            }
        });
    });
    //удаляем с корзины
    $('.cart-content').on('click', '.delete', function () {
        let id = $(this).data('delete');
        $.ajax({
            url: 'cartFunc',
            type: 'GET',
            data: {cart: 'delete', id: id},
            dataType: 'json',
            success: function (res) {
                if(res.code == 'ok'){
                    showCart(res.answer);
                }else{
                    alert('error')
                }
            },
            error: function () {
                alert('error');
            }
        });
    });
    //сохранить в бд
    $('.cart-content').on('click', '.save', function () {
        //let id = $(this).data('delete');
        $.ajax({
            url: 'cartFunc',
            type: 'GET',
            data: {cart: 'save'},
            dataType: 'json',
            success: function (res) {
                if(res.code == 'ok'){
                    location.reload();
                }else{
                    alert('error')
                }
            },
            error: function () {
                alert('error');
            }
        });
    });


    //открыть корзину
    $('#open-cart').on('click', function () {
        $.ajax({
            url: 'cartFunc',
            type: 'GET',
            data: {cart: 'open'},
            success: function(res){
                $('.cart-content').html(res);
            },
            error: function(){
                alert('Error');
            }
        });
    });






});