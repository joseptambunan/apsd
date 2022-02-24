<script type="text/javascript">

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
			loadStockUser();
			loadHistoryTransaksi();
		});
	}

	function loadStockUser(){
		var request = $.ajax({
			url :"{{url('/')}}/stock/get_product_user",
			dataType : "json",
			type : "get",
			headers: {
		        'access_token': $("#csrf_token").val()
		    },
		});

		request.done(function(data){
			var jsonData = decodeJwt(data.access_token);
		    var htmlGeneratorStock = "";
		    for(var i =0; i<jsonData.listStock.length; i++ ){
		    	htmlGeneratorStock += "<option value='" + jsonData.listStock[i].stock_id+ "'>" + jsonData.listStock[i].stock_name + "</option>";
		    }
		    $("#product_list").append(htmlGeneratorStock);

		    var htmlGeneratorUser= "";
		    for(var i =0; i<jsonData.listUser.length; i++ ){
		    	htmlGeneratorUser += "<option value='" + jsonData.listUser[i].user_id+ "'>" + jsonData.listUser[i].user_name + "</option>";
		    }
		    $("#user_list").append(htmlGeneratorUser);
		});
	}

	function loadHistoryTransaksi(){
		var request = $.ajax({
			url : "{{ url('/')}}/stock/history",
			dataType : "json",
			type : "get",
			headers: {
		        'access_token': $("#csrf_token").val()
		    },
		});

		request.done(function(data){
			var jsonData = decodeJwt(data.access_token);
			var htmlGeneratorUser = "";
		    for(var i =0; i<jsonData.transaksi.length; i++ ){
		    	htmlGeneratorUser += "<tr>";
		    	htmlGeneratorUser += "<td>" + jsonData.transaksi[i].product_name + "</td>";
		    	htmlGeneratorUser += "<td>" + jsonData.transaksi[i].user_name + "</td>";
		    	htmlGeneratorUser += "<td>" + jsonData.transaksi[i].qty + "</td>";
		    	htmlGeneratorUser += "<td>" + jsonData.transaksi[i].created_at + "</td>";
		    	htmlGeneratorUser += "</tr>";
		    }
		    $("#historyTransaksi").html(htmlGeneratorUser);
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

	function createTransaction(){
		var request = $.ajax({
			url : "{{ url('/')}}/stock/submit",
			dataType : "json",
			type : "post",
			headers: {
		        'access_token': $("#csrf_token").val(),
		        'x-csrf-token' : $("#csrf_token").val()
		    },data:{
		    	stock_id : $("#product_list").val(),
		    	user_id : $("#user_list").val(),
		    	stock : $("#qty").val()
		    }
		});

		request.done(function(data){
			if ( data.code == "SUCCESS"){
				alert("Data has been success");
			}

			loadHistoryTransaksi();
		});
	}
</script>