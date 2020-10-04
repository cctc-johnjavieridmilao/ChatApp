<?php
session_start();
$u_id = $_SESSION['u_id'];

if (empty($u_id)) {
	header('Location: logout.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>CHAT APP BY JHAY</title>
	<?php include 'helpers/header.php'; ?>
</head>
<body >

<style type="text/css">

	.ps {
    overflow: hidden !important;
    overflow-anchor: none;
    touch-action: auto;
}

	.p-1 {
    padding: .25rem !important;
}
	.p-2 {
    padding: .5rem !important;
}

	.chat-box-wrapper {
    display: flex;
    clear: both;
    padding: .75rem;
}
	.scroll-area-lg {
    height: 300px;
    overflow-x: hidden;
}

.ml-1, .mx-1 {
    margin-left: .25rem !important;
}

.scrollbar-sidebar, .scrollbar-container {
    position: relative;
    height: 100%;
}
	.chat-box-wrapper .chat-box {
		    box-shadow: 0 0 0 transparent;
		    position: relative;
		    opacity: 1;
		    background: #e0f3ff;
		    border: 0;
		    padding: .75rem 1.5rem;
		    border-radius: 30px;
		    border-top-left-radius: .25rem;
		    flex: 1;
		    display: flex;
		    max-width: 50%;
		    min-width: 500px;
		    text-align: left;
	}

	.chat-box-wrapper .chat-box+small {
    text-align: left;
    padding: .5rem 0 0;
    margin-left: 1.5rem;
    display: block;
}
.chat-box-wrapper.chat-box-wrapper-right {
    text-align: right;
}

.chat-box-wrapper.chat-box-wrapper-right .chat-box {
    border-radius: 30px;
    border-top-left-radius: 30px;
    border-top-right-radius: .25rem;
    margin-left: auto;
}
.avatar-icon-wrapper {
    display: inline-block;
    margin-right: .1rem;
    position: relative;
}
.float-right {
    float: right !important;
}
</style>
   
 <div class="app-container app-theme-white body-tabs-shadow" style="overflow-x: hidden; overflow-y: hidden;">
 	 <div class="app-container">
 	 <div class="h-100 bg-plum-plate bg-animation">
              
       <div class="row ml-5 mt-5">
		<div class="col-md-3">
			 <div class="main-card card" style="height: 500px !important;">
			 	<div class="card-body">
			 		<h5 class="card-title">USERS</h5>
			 		<div class="row">
			 			<div class="col-md-12">
			 				<input type="text" class="form-control" id="search" placeholder="Search User"><br>
			 				<ul class="list-group" id="Users">
			                   
			                </ul>
			 			</div>
			 		</div>
			 	</div>
			 </div>
		  </div>

		  <div class="col-md-6">
			 <div class="main-card card" style="height: 500px !important;overflow-y: scroll;">
			 	<div class="card-body">
			 		<h5 class="card-title">CHAT BOX <small id="chatwith"></small></h5>
			 		<div class="scroll-area-lg">
                                        <div class="scrollbar-container ps ps--active-y" id="scrolls">
                                            <div class="p-2">
                                                <div class="chat-wrapper p-1" id="chatrapper">
                                                    <center><h5><b>SELECT USERS TO CHAT</b></h5></center>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
			 
				 	</div>
				 	<div class="card-footer">
                           <input placeholder="Write here and hit enter to send..." id="msg" type="text" class="form-control-sm form-control mr-3">
                           <button class="btn btn-success" onclick="SaveChat()">Send</button>
                      </div>
				 </div>
			  </div>
		   </div>
		</div>
 	</div>
 </div>

<input type="hidden" id="SenderID">



<?php include 'helpers/jsplugin.php'; ?>
</body>
</html>

<script type="text/javascript">

	function RenderChat(data) {

		var sender = '<?php echo $u_id; ?>';

		    $('#chatrapper').html('');

        	$.post('../core/ChatController.php', data, function(res) {
	          var res = JSON.parse(res);
	          if (res.length > 0) {
	          	 res.forEach(function(r) {
	            	var name = r.SenderID == sender ? r.Sendername : r.Sendername;
	            	var position = r.SenderID == sender ? 'right' : 'left';
	            	 $('#chatrapper').append(`
	            	 	 <div class="float-${position}">
                        	<b class="float-${position}">${name}</b><br>
                            <div class="chat-box-wrapper chat-box-wrapper-${position}">
                                <div>
                                    <div class="chat-box">
                                    	
                                    	${r.Msg}
                                    </div>
                                    <small class="opacity-6">
                                       
                                       ${r.Date}
                                    </small>
                                </div>
                                <div>
                                    
                                </div>
                            </div>
                        </div>
	            	 `).promise().done(function () {
						var elem = document.getElementById('scrolls');
						elem.scrollTop = elem.scrollHeight;
					})
	            })
	          }
	        });

	}

	function SaveChat() {

	    var sender = '<?php echo $u_id; ?>';
	    var receiver = $('#SenderID').val();

		var data = {
			ACTION: 'SAVE_CHAT',
			sender: sender,
			receiver: receiver,
			msg: $('#msg').val()
		}

		if (data.msg == '') {
			return false;
		}

		var datas = {
	            	ACTION: 'GET_CHATS',
	        	 	receiver: receiver,
	        	 	sender: sender
            }

		$.post('../core/ChatController.php', data, function(res) {
            RenderChat(datas);
        });
	}

	function GetChatName(receiver) {

		var data = {
	            	ACTION: 'GET_CHAT_NAME',
	        	 	receiver: receiver
            }

		$.post('../core/ChatController.php', data, function(res) {
             $('#chatwith').text('('+res+')');
        });

	}

	function GetUsers(str) {
		$('#Users').empty();
			$.post('../core/ChatController.php', {ACTION: 'GET_USERS',str: str}, function(res) {
          var res = JSON.parse(res);
            res.forEach(function(r) {
            	 $('#Users').append(`<button class="list-group-item-action list-group-item" id="ShowChat" data-id="${r.RecID}">${r.Username}</button>`);
            })
        });

	}


	$(function() {
		 //GET USERS
		 GetUsers('');

        $(document).on('click', '#ShowChat', function() {
        	 var receiver = $(this).data('id');
        	 var sender = parseInt('<?php echo $u_id; ?>');

        	 var data = {
        	 	ACTION: 'GET_CHATS',
        	 	receiver: receiver,
        	 	sender: sender
        	 }

        	 $('#SenderID').val(receiver);

        	 GetChatName(receiver);

   	         RenderChat(data);
        })

        $('#search').on('keyup', function() {
        	 GetUsers($(this).val());
        })
         
	});
</script>