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
			loadStock();
		});
	}

	function loadStock(){
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
			for(var i =0; i<response.listStock.length; i++ ){
		    	htmlGeneratorUser += "<tr>";
		    	htmlGeneratorUser += "<td>" + response.listStock[i].stock_name + "</td>";
		    	htmlGeneratorUser += "<td>" + response.listStock[i].sku + "</td>";
		    	htmlGeneratorUser += "<td>" + response.listStock[i].stock + "</td>";
		    	htmlGeneratorUser += "<td><a class='btn btn-info' onClick='showTransaksi(" + response.listStock[i].stock_id + ")' data-bs-toggle='modal' data-bs-target='.bs-detail-modal-lg'>Detail</a></td>";
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

	function showTransaksi(id){
		var request = $.ajax({
			url : "{{url('/')}}/stock/transaksi/stock/" + id,
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
		    	htmlGeneratorUser += "<td>" + response.transaction[i].product_name + "</td>";
		    	htmlGeneratorUser += "<td>" + response.transaction[i].user + "</td>";
		    	htmlGeneratorUser += "<td>" + response.transaction[i].stock + "</td>";
		    	htmlGeneratorUser += "<td>" + response.transaction[i].datetime + "</td>";
		    	htmlGeneratorUser += "</tr>";
		    }
			$("#historyStockTransaksi").html(htmlGeneratorUser);
		});
	}

	function createStock(){
		var request = $.ajax({
			url : "{{url('/')}}/stock/create",
			dataType : "json",
			data : {
				nama_barang : $("#product_name").val(),
				sku : $("#sku").val(),
				stock : $("#qty").val()
			},
			type : "post",
			headers: {
		        'access_token': $("#csrf_token").val(),
		        'x-csrf-token' : $("#csrf_token").val()
		    }
		});


		request.done(function(data){
			if ( data.code == "SUCCESS"){
				alert("Data sukses");
				window.location.reload();
			}else{
				alert(data.message);
			}

		})
	}
</script>