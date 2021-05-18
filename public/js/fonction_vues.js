//ajoute une ligne des cases pour l'ajout
$('.add_more').on('click', function () {

    let product = $('.product_id').html();
    let numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
    let tr = '<tr><td class"no"">' + numberofrow + '</td>' +
        '<td><select class="form-control product_id" name="product_id[]">' + product + '</select></td>' +
        '<td><input type="number" name="quantity[]" class="form-control quantity"></td>' +
        '<td><input type="number" name="price[]" class="form-control price"></td>' +
        '<td><input type="number" name="discount[]" class="form-control discount"></td>' +
        '<td><input type="number" name="total_amount[]" class="form-control total_amount"></td>' +
        '<td><a class="btn btn-sm btn-danger delete"><i class="fa fa-times-circle" ></i ></a ></td > ';
    $('.addMoreProduct').append(tr);
});
//supprimer une ligne des cases pour l'ajout

$('.addMoreProduct').delegate('.delete', 'click', function () {

    $(this).parent().parent().remove();

});
//calculer la somme
function TotalAmount() {

    let total = 0;
    $('.total_amount').each(function () {
        let amount = $(this).val() - 0;
        total += amount;
    });
    $('.total').html(total);

}
$('.addMoreProduct').delegate('.product_id', 'change', function () {
    let tr = $(this).parent().parent();
    let price = tr.find('.product_id option:selected').attr('data-price');
    tr.find('.price').val(price);
    let qty = tr.find('.quantity').val() - 0;
    let disc = tr.find('.discount').val() - 0;
    //let price = tr.find('.price').val() - 0;
    let total_amount = (qty * price) - ((qty * price * disc) / 100);
    tr.find('.total_amount').val(total_amount);
    TotalAmount();
});


$('.addMoreProduct').delegate('.quantity,.discount', 'keyup', function () {

    let tr = $(this).parent().parent();
    let qty = tr.find('.quantity').val() - 0;
    let disc = tr.find('.discount').val() - 0;
    let price = tr.find('.price').val() - 0;
    let total_amount = (qty * price) - ((qty * price * disc) / 100);
    tr.find('.total_amount').val(total_amount);
    TotalAmount();

});
//calculer la balance
$('#paid_amount').keyup(function () {
    let total = $('.total').html();
    let total_amount = $(this).val();
    let tot = total_amount -total;
    $('#balance').val(tot).toFixed(2);

});

//ajoute une ligne des cases pour l'ajout
$('.add_more').on('click', function () {

    let monnaie = $('.monnaie_id').html();
    let magasin = $('.magasin_id').html();
    let unite = $('.unite_id').html();
    let fournisseur= $('.fournisseur_id').html();
    let numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
    let tr = '<tr><td class"no"">' + numberofrow + '</td>' +
        '<td><select class="form-control monnaie_id" name="monnaie_id[]">' + monnaie + '</select></td>' +
        '<td><input type="text" name="product_name[]" class="form-control product_name"></td>' +
        '<td><textarea name="description[]" id="description" cols="" rows="" class="form-control description"></textarea></td>' +
        '<td><input type="text" name="brand[]" class="form-control brand"></td>' +
        '<td><input type="number" name="price[]" class="form-control price"></td>' +
        '<td><input type="number" name="quantity[]" class="form-control quantity"></td>' +
        '<td><select class="form-control magasin_id" name="magasin_id[]">' + magasin + '</select></td>' +
        '<td><select class="form-control fournisseur" name="fournisseur[]">' + fournisseur + '</select></td>' +
        '<td><select class="form-control unite" name="unite[]">' + unite + '</select></td>' +
        '<td><input type="number" name="total_amount[]" class="form-control total_amount"></td>' +
        '<td><a class="btn btn-sm btn-danger delete"><i class="fa fa-times-circle" ></i ></a ></td > ';
    $('.addMoreProduct').append(tr);
});
//supprimer une ligne des cases pour l'ajout

$('.addMoreProduct').delegate('.delete', 'click', function () {

    $(this).parent().parent().remove();

});
