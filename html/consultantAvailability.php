<!DOCTYPE html>
<?php
	//session-y stuff
	//check to make sure user has permission to view this page
		//error message if they don't
?>
<html>
<head>
	
	<!--all your standard head stuff-->
	<script>
		//need, like, onload
		
		function create_table(){
			var table_div = document.getElementById("tablediv");
			var table = document.createElement("table");
			
			//rows for all the days of the week				//Oh, damn. Need to actually, like label the days and times
			for(var i=0; i<7; i++){
				var tr = document.createElement("tr");
				table.appendChild(tr);
				
				//columns for half-hour increments
				for(var j=0; j<22; j++){
					var td = document.createElement("td");
					//make a hidden input for the form.			//is there a less clunky way to do this?
					var input = document.createElement("input");
					input.setAttribute("type", "hidden");
					input.setAttribute("name", i + "[" + j + "]");
					input.setAttribute("value", 1);
					td.appendChild(input);
					
					//do something when clicked
					td.addEventListener("click", update_availability());
					tr.appendChild(td);				
				}
			}
			table_div.appendChild(table);
		}
		
		//I think this is the right idea at least?
		function update_availability(e){
			if(e.children[0].value == 1){
				e.children[0].value = 0;
				e.style.background-color = "blue";
			}else{
				e.children[0].value = 1;
				e.style.background-color = "white";
			}
		}
		
	</script>
	<!--should have standard CSS applied to table, then change cell color when clicked-->
	<style>
		table{
			width: 100%;
		}
		
		td{
			height: 50px;
			background-color: white;
		}
	</style>
	
</head>
<body>
	<form>	<!--need form details-->
		<div id="tablediv">
		<!--Table with days and times. Dynamically create with javascript? I guess it's also in a form because submit-->
			<!--when the user clicks on a cell, it changes color and marks status as '1'--handle with javascript-->
		</div>
		<!--hidden input with user information pulled from session? Can I do that?-->
		<!--Submit the form! Yay!-->
		<input type="submit" value="Submit">
	</form>	
		
</body>
</html>
