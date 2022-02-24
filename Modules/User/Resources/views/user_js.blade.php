<script type="text/javascript">
	var base_url = "{{ url('/')}}";
	$(document).ready(function(){
		getCsrf();
	});

	function getCsrf(){
		var request = $.ajax({
			url :"{{url('/')}}/user/token",
			dataType : "html",
			type : "get"
		});

		request.done(function(data){
			$("#csrf_token").val(data);
			loadUser();
		});
	}

	function loadUser(){
		var request = $.ajax({
			url : "{{url('/')}}/stock/get_product_user",
			dataType : "json",
			type : "get",
			headers: {
		        'access_token': $("#csrf_token").val()
		    }
		});

		request.done(function(data){
			var response = decodeJwt(data.access_token);
			var htmlGeneratorUser = "";
			for(var i =0; i<response.listUser.length; i++ ){
		    	htmlGeneratorUser += "<tr>";
		    	htmlGeneratorUser += "<td>" + response.listUser[i].user_name + "</td>";
		    	htmlGeneratorUser += "<td>" + response.listUser[i].email + "</td>";
		    	htmlGeneratorUser += "<td>" + response.listUser[i].phone + "</td>";
		    	htmlGeneratorUser += "<td><a class='btn btn-info' onClick='showTransaksi(" + response.listUser[i].user_id + ")' data-bs-toggle='modal' data-bs-target='.bs-detail-modal-lg'>Detail</a></td>";
		    	htmlGeneratorUser += "</tr>";
		    }
			$("#listUser").html(htmlGeneratorUser);
		});
	}

	function decodeJwt(access_token){
		var base64Url = access_token.split('.')[1];
	    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
	    var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
	        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
	    }).join(''));

	    var result = JSON.parse(jsonPayload);
	    return result;
	}

	function showTransaksi(id){
		var request = $.ajax({
			url : "{{url('/')}}/stock/transaksi/user/" + id,
			dataType : "json",
			type : "get",
			headers: {
		        'access_token': $("#csrf_token").val()
		    }
		});

		request.done(function(data){
			var response = decodeJwt(data.access_token);
			var htmlGeneratorUser = "";
			for(var i =0; i<response.transaction.length; i++ ){
		    	htmlGeneratorUser += "<tr>";
		    	htmlGeneratorUser += "<td>" + response.transaction[i].name + "</td>";
		    	htmlGeneratorUser += "<td>" + response.transaction[i].qty + "</td>";		    	
		    	htmlGeneratorUser += "<td>" + response.transaction[i].datetime + "</td>";
		    	htmlGeneratorUser += "</tr>";
		    }
			$("#historyStockTransaksi").html(htmlGeneratorUser);
		});
	}

	function createUser(){
		var request = $.ajax({
			url : "{{url('/')}}/user/create",
			dataType : "json",
			data : {
				user_name : $("#user_name").val(),
				password : $("#password").val(),
				email : $("#email").val(),
				phone : $("#phone").val()
			},
			type : "post",
			headers: {
		        'access_token': $("#csrf_token").val(),
		        'x-csrf-token' : $("#csrf_token").val()
		    }
		});


		request.done(function(data){
			if (data.code == "SUCCESS"){
				alert("User success submit");
				window.location.reload();
			}else{
				alert(data.message);
			}
		})
	}
</script>