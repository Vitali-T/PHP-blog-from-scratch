//Toggle Admin panel forms

$(document).ready(function (){
	$('.new-post-btn').click(function(e){
		e.preventDefault();
		$('.new-post').toggleClass('display');
	});
	$('.edit-post-btn').click(function(e){
		e.preventDefault();
		$('.edit-post').toggleClass('display');
	});
	$('.delete-post-btn').click(function(e){
		e.preventDefault();
		$('.delete-post').toggleClass('display');
	});
	
	
//Pass category name to URL in order to access it using PHP $_GET
	
	$('.category-item a').click(function(){
		$categoryName = $(this).text();
		$(this).attr('href',"index.php?category="+$categoryName);
	});
})

//Admin panel forms validation

function validateNewPost(formFields){

	if(formFields.title.value == ""){
		formFields.title.style.borderColor="red";
		return false;
	}
	else if(formFields.category.value == ""){
		formFields.category.style.borderColor="red";
		return false;
	}
	else if(formFields.postBody.value == ""){
		formFields.postBody.style.borderColor="red";
		return false;
	}
else
	return true;
}

function validateEditPost(formFields){
	if(formFields.id.value == ""){
		formFields.id.style.borderColor="red";
		return false;
		}
	else if(isNaN(formFields.id.value)){
		alert("Enter numbers only!");
		formFields.id.style.borderColor="red";
		return false;
	}
	else
		return true;
}
function validateDeletePost(formFields){
		if(formFields.ToDelete.value == ""){
			formFields.ToDelete.style.borderColor="red";
			return false;
		}
		else if(isNaN(formFields.ToDelete.value)){
			alert("Enter numbers only!");
			formFields.ToDelete.style.borderColor="red";
			return false;
		}
	else
		return true;
}

