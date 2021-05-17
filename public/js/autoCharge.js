
    $(document).ready(function(){
    $('#marque_id').on('change',function(){

var marque_id=$(this).val();
$.get(route + '/vehicules/chargeMarque', {marque_id:marque_id},function(data){
  $('#modele_id').html(data);
});

});
