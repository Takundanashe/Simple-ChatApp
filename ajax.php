
<table>
    <tr>
    <th>First name</th>
    <th>Last name</th>
    <th>Job title</th>
    </tr>
 
    <tbody id="data"></tbody>
</table>

<script type="text/javascript">
	
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "data.php", true);
    ajax.send();
 
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           //alert(this.responseText); //here it will display data in extracted from the database by data.php
           //converting json back to array
           var data= JSON.parse(this.responseText);
           console.log(data);//for debugging
           //html value for tbody
           var html ="";
           //looping through the data
           for (var a=0 ;a< data.length;a++){
           	var firstname = data[a].fname;
           	var lastname = data[a].lname;
           	var email =data[a].email;
           	//appending at html 
           	html +='<tr>';
           	html += '<td>' + firstname + '</td>';
           	html += '<td>' + email + '</td>';
           	html += '<td>' + lastname + '</td>';

           	html += '</tr>';
           }
            //replacing <tbody> of ttable

            document.getElementById('data').innerHTML=html;

            }
         
    };
</script>
