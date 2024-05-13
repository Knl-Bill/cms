<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="assets/css/stud_det.css">
    
</head>
<body>
<table class="fold-table">
  <thead>
    <tr>
      <th>Roll No.</th><th>Name</th><th>Phone Number</th>
    </tr>
  </thead>
  @foreach ($students as $stud)
  <tbody>
    <tr class="view">
      <td>{{$stud->rollno}}</td>
      <td class="pcs">{{$stud->name}}</td>
      <td class="cur">{{$stud->phoneno}}</td>
    </tr>
    <tr class="fold">
      <td colspan="7">
        <div class="fold-content">         
            <h2>Place of Visit : </h2> <h3>{{$stud->placeofvisit}}</h3>
            <br><br>
            <h2>Purpose of Visit : </h2> <h3>{{$stud->purpose}}</h3>
            <br><br> 
            <h2>Out Date : </h2> <h3>{{$stud->outdate}}</h3> 
            <br><br>
            <h2>Out Time : </h2> <h3>{{$stud->outime}}</h3> 
            <br><br>
            <h2>In Date : </h2> <h3>{{$stud->indate}}</h3> 
            <br><br>
            <h2>In Time : </h2> <h3>{{$stud->intime}}</h3> 
            <br><br>
            <h2>No. Of Days : </h2> <h3>{{$stud->noofdays}}</h3> 
            <br><br>
            <div>
                <img src="#" alt="email screenshot">
            </div> 
            <div>
                <a href="#"> Approve </a>
            </div>         
        </div>
      </td>
    </tr>
@endforeach
</table>   
</body>
<script>
      $(function()
      {
        $(".fold-table tr.view").on("click", function()
        {
            $(this).toggleClass("open").next(".fold").toggleClass("open");
        });
      });
</script>
</html>