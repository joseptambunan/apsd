<script type="text/javascript">
	var base_url = "{{ url('/')}}";
	$("#userpassword").on('keypress',function(e){
		if ( e.which == 13 ){
			login();
		}
	});


	$("#btn-login").click(function(){
		login();
	});

	function login(){
		var request = $.ajax({
			url : base_url + "/user/login",
			data : {
				email : $("#username").val(),
				password : $("#userpassword").val()
			},
			dataType : "json",
			type : "post"
		});

		request.done(function(data){
			if ( data.code == "FAILED"){
				$("#message-login").html("Invalid Login");
			}
			window.location.href = base_url + "/stock/";
		});
	}
</script>