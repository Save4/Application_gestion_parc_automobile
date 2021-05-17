$(function () {
    $("#produit_id").on("change", function () {
        var produit_id = $(this).val();
        //alert(product_id);
        $.get(
            route + "/detail_entrees/getPrixAchat",
            { produit_id: produit_id },
            function (data) {
                $("#prixachat").val(data);
            }
        );
    });
});

$(function () {
    $("#produit_id").on("change", function () {
        var produit_id = $(this).val();
        //alert(product_id);
        $.get(
            route + "/detail_entrees/getPrixVente",
            { produit_id: produit_id },
            function (data) {
                $("#prixvente").val(data);
            }
        );
    });
});

$(function () {
    var prixachat, quantite, prixachattotal;
    $("#quantite").on("change", function () {
        prixachat = $("#prixachat").val();
        quantite = $(this).val();
        prixachattotal = prixachat * quantite;
        $("#prixachattotal").val(prixachattotal);
    });
});

