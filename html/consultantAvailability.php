<!DOCTYPE html>
<?php
	//session-y stuff
	//check to make sure user has permission to view this page
		//error message if they don't
?>
<html>
<head>
	
	<!--all your standard head stuff-->
	<script type ="text/javascript">
		//need, like, onload
		
		function create_table(){
			var table_div = document.getElementById("tablediv");
			var table = document.createElement("table");
			
			//rows for all the days of the week				//Oh, damn. Need to actually, like label the days and times
			for(var i=0; i<7; i++){
				table_div.appendChild(document.createTextNode("Hello!<br>"));
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
					
					td.addEventListener("click", update_availability);
					//do something when clicked
					
					tr.appendChild(td);				
				}
			}
			table_div.appendChild(table);
			table_div.appendChild(document.createTextNode("Hello!<br>"));
		}
		
		//I think this is the right idea at least?
		function update_availability(e){

			e = e || window.event;
    		var element = e.target || e.srcElement;

			if(element.children[0].value == 1){
				element.children[0].value = 0;
				element.style.backgroundColor = "blue";			
			}
			
			else{
				element.children[0].value = 1;
				element.style.backgroundColor = "white";
			}
			
		}
		
		function test(){
			alert("ok");
		}
		
		//run creating the table when the page is loaded
		window.onload = create_table;
		
	</script>
	<!--should have standard CSS applied to table, then change cell color when clicked-->
	<style>
		table{
			width: 100%;
			border: 1px solid black;
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
			<!--when the user clicks on a cell, it changes color and marks status as '1'-handle with javascript-->
		</div>
		<!--hidden input with user information pulled from session? Can I do that?-->
		<!--Submit the form! Yay!-->
		<input type="submit" value="Submit">
	</form>	
		
</body>
</html>
