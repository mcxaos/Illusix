$(function(){
	var n = 1;

	$('#ingredient-add').click(function(){
		$('#ingredient-name').
		append('<input class="form-control" name-id=' +n+' type=text/><p/>');
		$('#ingredient-quantity').
		append('<input class="form-control" quantity-id='+n+' type=text/><p/>');
		n++;
	});
	$('#add-recipe').click(function(){
		var array ={};
		$.each($('#ingredient-name input'), function(i, field) {
			array[$(field).attr('name-id')] ={};
			array[$(field).attr('name-id')]['name']= field.value;
		});
		$.each($('#ingredient-quantity input'), function(i, field) {
			array[$(field).attr('quantity-id')]['quantity']= field.value;
		});

		var form = $('#form-recipe').serializeArray();
	    form.push({name: 'ingredients', value: JSON.stringify(array)});
      	$.ajax({
			  type: "POST",
			  url: '/site/recipeajax',
			  data : form,	
			  success: function(data){
			 console.log(data);
			}
		});

      	return false;
	});
});