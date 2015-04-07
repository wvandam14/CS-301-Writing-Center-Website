<!DOCTYPE html>
<?php
	//session-y stuff
	//check to make sure user has permission to view this page
		//error message if they don't
?>
<html>
<head>
	<title>Consultant Availability</title>
	<meta charset="uft-8">
	<!--all your standard head stuff-->
	<script type ="text/javascript">
		//need, like, onload
		
		function create_table(){
			var table_div = document.getElementById("tablediv");
			var table = document.createElement("table");
			
			//rows for all the days of the week	
			var day_array = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
			var time_array = ["9:00", "9:30", "10:00", "10:30", "11:00", "11:30", "12:00", "12:30", "1:00", "1:30", "2:00", "2:30", "3:00", "3:30", "4:00", "4:30", "5:00", "5:30", "6:00", "6:30", "7:00", "7:30"];
			
			//header date cells
			var tr = document.createElement("tr");
			table.appendChild(tr);
			tr.appendChild(document.createElement("td"));	//in column with days
			for(var i=0; i<22; i++){
				var td = document.createElement("td");
				td.innerHTML = time_array[i];
				tr.appendChild(td);
			}
			
			//schedule cells
			for(var i=0; i<7; i++){
				var tr = document.createElement("tr");
				table.appendChild(tr);
				
				//cell for day of week
				var td = document.createElement("td");
				td.innerHTML = day_array[i];
				tr.appendChild(td);
				
				//columns for half-hour increments
				for(var j=0; j<22; j++){
					var td = document.createElement("td");
					//make a hidden input for the form.			//is there a less clunky way to do this?
					var input = document.createElement("input");
					input.setAttribute("type", "hidden");
					input.setAttribute("name", "d"+i + "[" + j + "]");
					input.setAttribute("value", 1);
					td.appendChild(input);
					
					//do something when clicked
					td.addEventListener("click", update_availability);
									
					tr.appendChild(td);				
				}
			}
			table_div.appendChild(table);
		}
		
		//Change the cell color and input value when clicked
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
		
		/*function test(){
			alert("ok");
		}*/
		
		//run creating the table when the page is loaded
		window.onload = create_table;
		
	</script>
	<!--table CSS-->
	<style>
		table{
			width: 100%;
			border: 1px solid black;
		}
		
		td{
			height: 50px;
			background-color: white;
			border: 1px solid black;
		}
	</style>
	
</head>
<body>
	<form method="post" action = "availabilityConfirmed.php">
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
