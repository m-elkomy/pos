$(document).ready(function(){
    $('.add-product-btn').on('click',function(e){
        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $.number($(this).data('price'),2);
        $(this).removeClass('btn-success').addClass('btn-default disabled');
        var htm = `<tr>
                    <td>${name}</td>
                    <input type="hidden" name="products[]" value="${id}">
                    <td><input type="number" data-price="${price}" class="form-control input-sm product-quantity" name="quantities[]" min="1" value="1"></td>
                    <td class="product-price">${price}</td>
                    <td><button class="btn btn-danger remove-product-btn" data-id="${id}"><i class="fa fa-trash"></i> </button></td></tr>`
        $('.order-list').append(htm);
        calculate_total();
    });

    $('body').on('click','.disabled',function (e){
        e.preventDefault();
    })

    $('body').on('click','.remove-product-btn',function (e){
        e.preventDefault();
        var id = $(this).data('id');
        $(this).closest('tr').remove();
        $('#product-'+id).removeClass('btn-default disabled').addClass('btn-success');
        calculate_total();

    });
    $('body').on('keyup change','.product-quantity',function (){
        var quantity = Number($(this).val());
        // var price = $(this).data('price');
        var price = parseFloat($(this).data('price').replace(/,/g,''));

        $(this).closest('tr').find('.product-price').html($.number(quantity * price,2));
        calculate_total();

    });



    $('.order-products').on('click',function (e){
        e.preventDefault();
        var url = $(this).data('url');
        var method = $(this).data('method');
        $.ajax({
            url:url,
            method:method,
            success:function(data){

                $('#order-product-list').empty()
                $('#order-product-list').append(data)
            }
        })

    })

    $(document).on('click','.print-btn',function(){
        $('.print-area').printThis();
    });
});

function calculate_total(){
    var price = 0;

    $('.order-list .product-price').each(function(index){
        price+=parseFloat($(this).html().replace(/,/g,''));
    });
    $('.total').html($.number(price,2));


    if(price > 0){
        $('#add-order-form-btn').removeClass('disabled');
    }else{
        $('#add-order-form-btn').addClass('disabled');
    }
}
