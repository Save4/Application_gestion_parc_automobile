$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#btn-store-magasin").on('click', function(){
        alert("yes");
        $.ajax({
            url: "/magasins",
            type: "post",
            data: {
                nom_magasin: $("#nom_magasin").val()
            },
            success: function(data) {
                if(data.errors) {
                    if(data.errors.nom_magasin) {
                        $("#nom_magasin + div").text(data.errors.nom_magasin)
                    }
                }
            },
            dataType : 'json'
        });
    });
});
