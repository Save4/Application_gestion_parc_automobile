$(function () {
    var prixvente, quantite, prixventetotal;
    $("#quantite").on("change", function () {
        prixvente = $("#prixvente").val();
        quantite = $(this).val();
        prixventetotal = prixvente * quantite;
        $("#prixventetotal").val(prixventetotal);
    });
});