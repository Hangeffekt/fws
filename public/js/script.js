$(document).ready(function(){

	modify();
	deleteuser();
	clearform();
	updateuser();
	adduser();

	/** add contact user */
	function adduser(){
		$("#adduser").click(function(){
			
			let divcounter = 1;

			$("#contacts div").each(function(){
				divcounter += 1;
			})
			
			let name = $("#username").val();
			let email = $("#useremail").val();
			let contacts = $("#contacts").html();
			let checkbox = "<div id='userrow" + divcounter + "'><div class='username'>" + name + "</div><div class='useremail'>" + email +
			"</div><div class='contact-buttons border-bottom border-dark'><span class='modify btn btn-warning' id='modifyuser" + divcounter + "'>Szerkesztés"  + 
			"</span> <span class='deleteuser btn btn-danger' id='deleteuser" + divcounter + "'>Törlés</span></div>" +
			"<input type='hidden' name='contact[]' value='" + name + "/" + email + "'></div>";

			
			if(name == "" && email == ""){
				$(".emptyname").css("display", "block");
				$(".emptyemail").css("display", "block");
			}
			else if(name == ""){
				$(".emptyname").css("display", "none");
				$(".emptyemail").css("display", "block");
			}
			else if(email == ""){
				$(".emptyname").css("display", "none");
				$(".emptyemail").css("display", "block");
			}
			else{
				$("#contacts").html(contacts + checkbox);
				$("#contactsalert").css("display", "none");
				$(".emptyname").css("display", "none");
				$(".emptyemail").css("display", "none");
				$("#username").val("");
				$("#useremail").val("");
			}

			modify();
			deleteuser();
			clearform();
			updateuser();
		})
	}

	/** modify user */

	function modify(){
		$(".modify").click(function(){
			
			$(".modify").each(function(){
				$(this).click(function(){
					let id = $(this).attr('id');
					id = id.split("modifyuser");
					rowid = "#userrow" + id[1] + "";
					
					$("#username").val($(rowid + " .username").text());
					$("#useremail").val($(rowid + " .useremail").text());
					$("#modifyid").val(id[1]);
					$("#adduser").css("display", "none");
					$("#updateuser").css("display", "block");
					$("#clearform").css("display", "block");
				})
			})
		})
	}

	/** update user */
	function updateuser(){
		$("#updateuser").click(function(){
			let pathname = "#userrow" + $("#modifyid").val() + " .username";
			let pathemail = "#userrow" + $("#modifyid").val() + " .useremail";
			let pathhidden = "#userrow" + $("#modifyid").val() + " input:hidden";
			let data = $("#username").val() + "/" + $("#useremail").val();
			
			$(pathname).text($("#username").val());
			$(pathemail).text($("#useremail").val());

			$("#username").val("");
			$("#useremail").val("");
			$("input:hidden").attr("id", "");
			$(pathhidden).val(data);
			$("#adduser").css("display", "block");
			$("#updateuser").css("display", "none");
			$("#clearform").css("display", "none");
			$(".emptyname").css("display", "none");
			$(".emptyemail").css("display", "none");
		})
	}

	/** delete user */
	function deleteuser(){
		$(".deleteuser").each(function(){
			$(this).click(function(){
				let id = $(this).attr('id');
				id = id.split("deleteuser");
				id = "#userrow" + id[1];
				
				$(id).html("");
			})
		})
	}

	/** clear form */

	function clearform(){
		$("#clearform").click(function(){
			$("#username").val("");
			$("#useremail").val("");
			$("input:hidden").attr("id", "");
			$("#adduser").css("display", "block");
			$("#updateuser").css("display", "none");
			$("#clearform").css("display", "none");
			$(".emptyname").css("display", "none");
			$(".emptyemail").css("display", "none");
		})
	}

	/** delete project */

	$(".deletproject").submit(function(e){
		e.preventDefault();

		$(this).css("background", "red");

		projectid = $(this).find("#projectid").val();
		pojectidpath = "#" + projectid;
		
		$.ajax({
			url: "/deleteproject",
			type: "POST",
			dataType: "json",
			data: {
				id: projectid,
				_token: $("input[name=_token]").val()
			},
			success:function(response){
				if(response == "ok"){
					$(pojectidpath).html("");
				}
			}
		})
	})

	/** filter */

	if(window.location.pathname == "" || window.location.pathname == "/"){
		$("#nav0").addClass("mb-2 bg-success text-white");
	}
	else if(window.location.pathname == "/1"){
		$("#nav1").addClass("mb-2 bg-success text-white");
	}
	else if(window.location.pathname == "/2"){
		$("#nav2").addClass("mb-2 bg-success text-white");
	}
	else if(window.location.pathname == "/3"){
		$("#nav3").addClass("mb-2 bg-success text-white");
	}
	
	
});


