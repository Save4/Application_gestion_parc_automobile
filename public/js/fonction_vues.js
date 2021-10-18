//autocharge du modele
/*$('.addMarque').delegate('#marque_id', 'change', function () {
    let tr = $(this).parent().parent();
    let modele_id = tr.find('#marque_id option:selected').attr('data-marque');
    tr.find('#modele_id').val(modele_id);
});*/

$(document).ready(function () {
    $('#marque_id').on('change', function () {

        let marque_id = $(this).val();
        $.get(route + '/vehicules/chargeMarque', { marque_id: marque_id }, function (data) {
            $('#modele_id').html(data);
        });

    });
});
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
    let tot = total_amount - total;
    $('#balance').val(tot).toFixed(2);

});

//ajoute une ligne des cases pour l'ajout
$('.add_more').on('click', function () {

    let monnaie = $('.monnaie_id').html();
    let magasin = $('.magasin_id').html();
    let unite = $('.unite_id').html();
    let fournisseur = $('.fournisseur_id').html();
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

//ajoute une ligne des cases pour l'ajout
$('.add_more').on('click', function () {

    let piece = $('.piece_id').html();
    let vehicule = $('.vehicule_id').html();
    let numberofrow = ($('.addreparation tr').length - 0) + 1;
    let tr = '<tr><td class"no"">' + numberofrow + '</td>' +
        '<td><select class="form-control vehicule_id" name="vehicule_id[]">' +
        '<option value="">Choisir plaque</option>@foreach ($vehicules as $vehicule)' +
        '<option value="{{ $vehicule->id }}">' + vehicule + '</option>@endforeach</select></td>' +
        '<td><select class="form-control piece_id" name="piece_id[]">' + piece + '</select></td>' +
        '<td><input type="number" name="nombre[]" class="form-control nombre"></td>' +
        '<td><input type="number" name="prix_piece[]" class="form-control prix_piece"></td>' +
        '<td><input type="number" name="prix_toto_piece[]" class="form-control prix_toto_piece"></td>' +
        '<td><input type="text" name="type_panne[]" class="form-control type_panne"></td>' +
        '<td><input type="number" name="main_oeuvre[]" class="form-control main_oeuvre"></td>' +
        '<td><input type="number" name="toto_conso[]" class="form-control toto_conso"></td>' +
        '<td><a class="btn btn-sm btn-danger delete"><i class="fa fa-times-circle" ></i ></a ></td > ';
    $('.addreparation').append(tr);
});


//supprimer une ligne des cases pour l'ajout

$('.addreparation').delegate('.delete', 'click', function () {

    $(this).parent().parent().remove();

});


//calculer la somme
function TotalAmount() {

    let total = 0;
    $('.toto_conso').each(function () {
        let amount = $(this).val() - 0;
        total += amount;
    });
    $('.total').html(total + "FraBu");

}

$('.addreparation').delegate('.piece_id', 'change', function () {
    let tr = $(this).parent().parent();
    let prix_piece = tr.find('.piece_id option:selected').attr('data-price');
    tr.find('.prix_piece').val(prix_piece);
    let nombre = tr.find('.nombre').val() - 0;
    let prixTotoPiece = (nombre * prix_piece);
    tr.find('.prix_toto_piece').val(prixTotoPiece);
    let main_oeuvre = tr.find('.main_oeuvre').val() - 0;
    let total = (prixTotoPiece + main_oeuvre);
    tr.find('.toto_conso').val(total);
    TotalAmount();
});

$('.addreparation').delegate('.nombre,.main_oeuvre', 'keyup', function () {

    let tr = $(this).parent().parent();
    let nombre = tr.find('.nombre').val() - 0;
    let prix_piece = tr.find('.prix_piece').val() - 0;
    let prixTotoPiece = (nombre * prix_piece);
    tr.find('.prix_toto_piece').val(prixTotoPiece);
    let main_oeuvre = tr.find('.main_oeuvre').val() - 0;
    let totals = (prixTotoPiece + main_oeuvre);
    tr.find('.toto_conso').val(totals);
    TotalAmount();

});

//sommation table reparations
/* $('table').delegate('.conso_t','keyup', function (){
    let tr= $(this).parent().parent();
    let total=o;
    let conso=tr.find('.conso_t').val();
    total += conso;
    tr.find('.total')
});
function total() {
    let total=0;
    $('.conso_t').each(function (i,e){
        let conso=$(this).val();
        total +=conso;
    });
    $('.total_t').html(total+"FraBu");
} */


$(document).ready(function () {
    $("#unit,#quantit").keyup(function () {
        let total = 0;
        let unit = Number($("#unit").val()-0);
        let quantit = Number($("#quantit").val()-0);
        total = unit * quantit;
        $('#prix_total').val(total);
    });
});

$(document).ready(function () {
    $("#distance,#quantit").keyup(function () {
        let total = 0.0;
        let distance = Number($("#distance").val()-0);
        let quantit = Number($("#quantit").val()-0);
        total = distance/quantit;
        $('#distance_littre').val(total);
    });
});
