<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="upload_vid.css">
</head>
<body onload="myfunction()">
				<div id="myModal" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
						<div id="header">
							<p id="upload_vid_p">Choose the video you would like to upload</p>
							<span class="close">&times;</span>
							
						</div>
						<div id="upload_image_div">
						
							<form id="upload_form" enctype="multipart/form-data" method="post">
								<input type="file"  name="file1" id="file1"><br /><br />
								<!--
								<input type="text" name="title" placeholder="Enter the title" size="30"><br /><br />
								<label>Private</label>
								<input type="radio" id="private" name="visibility" value="private">
								<label>Public</label>
								<input type="radio" id="public" name="visibility" value="public"><br /><br />
								<label>Yes, it's made for Kids</label>
								<input type="radio" id="restriction" name="restriction" value="restriction">
								<label>No, it's not made for Kids</label>
								<input type="radio" id="norestriction" name="restriction" value="norestriction"><br /><br />
								-->
								<input type="button"  value="Upload File" onclick="uploadFile()"><br /><br />
								<progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
								<h3 id="status"></h3>
								<p id="loaded_n_total"></p>
								
							</form>
						</div>
					
					
						<button type="button" onclick="changepage()" >Next</button>
				  	</div>

				</div>
				
				
				<script>
			// Get the modal
			var modal = document.getElementById("myModal");

			// Get the button that opens the modal
			var btn = document.getElementById("buttonme");

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			// When the user clicks the button, open the modal 
			function myfunction() {
			  modal.style.display = "block";
			}

			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
			  modal.style.display = "none";
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
			  if (event.target == modal) {
				modal.style.display = "none";
			  }
			}
			
			function changepage(){
				window.open("viddetails.php", "_self");
			}
			
			function openwindow(){
				window.open("upload_form.html", "_self");
			}
							
				function _(el){
				return document.getElementById(el);
				}
				function uploadFile(){
				var file = _("file1").files[0];
				//alert(file.name+" | "+file.size+" | "+file.type);
				var formdata = new FormData();
				formdata.append("file1", file);
				var ajax = new XMLHttpRequest();
				ajax.upload.addEventListener("progress", progressHandler, false);
				ajax.addEventListener("load", completeHandler, false);
				ajax.addEventListener("error", errorHandler, false);
				ajax.addEventListener("abort", abortHandler, false);
				ajax.open("POST", "file_upload_parser.php");
				ajax.send(formdata);
				}
				function progressHandler(event){
				_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
				var percent = (event.loaded / event.total) * 100;
				_("progressBar").value = Math.round(percent);
				_("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
				}
				function completeHandler(event){
				_("status").innerHTML = event.target.responseText;
				_("progressBar").value = 0;
				}
				function errorHandler(event){
				_("status").innerHTML = "Upload Failed";
				}
				function abortHandler(event){
				_("status").innerHTML = "Upload Aborted";
				}
			</script>
</body>
</html>