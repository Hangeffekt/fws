$(document).ready(function(){

	modify();
	deleteuser();
	clearform();

	/** add contact user */

	$("#adduser").click(function(){

		let divcounter = 0;

		$("#contacts div").each(function(){
			divcounter += 1;
		})

		let name = $("#username").val();
		let email = $("#useremail").val();
		let contacts = $("#contacts").html();
		let checkbox = "<div id='userrow" + divcounter + "'><span class='username'>" + name + "</span><span class='useremail'>" + email +
		"</span>/<span class='modify btn btn-warning' id='modifyuser" + divcounter + "'>Szerkesztés"  + 
		"</span>/<span class='deleteuser btn btn-danger' id='deleteuser" + divcounter + "'>Törlés</span>" +
		"<input type='hidden' name='contact[]' value='" + name + "/" + email + "'></div>";

		if(name != "" && email != ""){
			$("#contacts").html(contacts + checkbox);
			$("#contactsalert").css("display", "none");
			$(".emptyname").css("display", "none");
			$(".emptyemail").css("display", "none");
			$("#username").val("");
			$("#useremail").val("");
		}
		else if(name == "" && email == ""){
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

		modify();
		deleteuser();
		clearform();
	})

	/** modify user */

	function modify(){
		$(".modify").each(function(){
			$(this).click(function(){
				let id = $(this).attr('id');
				id = id.split("modifyuser");
				rowid = "#userrow" + id[1] + "";
				
				$("#username").val($(rowid + " .username").text());
				$("#useremail").val($(rowid + " .useremail").text());
				$("input:hidden").attr("id", id[1]);
				$("#adduser").css("display", "none");
				$("#modifyuser").css("display", "block");
				$("#clearform").css("display", "block");
			})
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
			$("#modifyuser").css("display", "none");
			$("#clearform").css("display", "none");
		})
	}
	
});


