(function($){
  initialize = function() {
  //base functions
    $("#user_menu").hide();
	$(".user").click(function(){
		$("#user_menu").toggle();
		$("#user_menu").offset({ top: 125, left: 400 });
	});
	 $("#shadow").css("height", $(document).height()).hide();
	 $("#dialog").hide();
	 $("#changepassword").click(function(){
		load_dialog_box("Change Password", "snippets/changepassword.php");
		$("#user_menu").hide();
	 });
	 $("#logout").click(function(){
		load_dialog_box("Log Out", "snippets/logout.php");
		$("#user_menu").hide();
	 });
	 $("#dialogclose").click(function(){
		close_dialog_box();
	 });
	 
	 //user functions
	 
	 $("#adduser_btn").click(function(){
		load_dialog_box("Add User", "snippets/addnewuser.php");
	 });
  };
  
  load_dialog_box = function(window_title, page) {
	$("#shadow").show();
	$("#dialogtitle").html(window_title);
	$("#dialogcontent").empty().load(page);
	$("#dialog").show(function(){
		$(this).css("margin-top",$(this).height()/2*-1);
		$(this).css("margin-left",$(this).width()/2*-1);
	});
  };
  
  close_dialog_box = function() {
	$("#shadow").hide();
	$("#dialog").hide();
	$("#dialogcontent").empty();
  };
})(jQuery);