<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="assets/css/stud_det.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">     
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</head>
<body>
<h1 class="heading">Leave Requests</h1>
<div class="accordion" id="accordionExample">
  @foreach ($students as $stud)
  <div class="accordion-item" >
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->iteration }}"  aria-expanded="true" aria-controls="collapse{{ $loop->iteration }}">
        {{$stud->rollno}}
      </button>
    </h2>
    <div id="collapse{{$loop->iteration}}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <table class="table table-striped-columns table-bordered">
        <tbody>
          <tr>
            <td>Name</td>
            <td>{{$stud->name}}</td>
          </tr>
          <tr>
            <td>Phone Number</td>
            <td>{{$stud->phoneno}}</td>
          </tr>
          <tr>
            <td>Place of Visit</td>
            <td>{{$stud->placeofvisit}}</td>
          </tr>
          <tr>
            <td>Purpose of Visit</td>
            <td>{{$stud->purpose}}</td>
          </tr>
          <tr>
            <td>Out Date</td>
            <td>{{date('d/m/Y',strtotime($stud->outdate))}}</td>
          </tr>
          <tr>
            <td>Out Time </td>
            <td>{{date('h:i a',strtotime($stud->outime))}}</td>
          </tr>
          <tr>
            <td>In Date  </td>
            <td>{{date('d/m/Y',strtotime($stud->indate))}}</td>
          </tr>
          <tr>
            <td>In Time </td>
            <td>{{date('h:i a',strtotime($stud->intime))}}</td>
          </tr>
          <tr>
            <td>No. Of Days </td>
            <td>{{$stud->noofdays}}</td>
          </tr>
        </tbody>
      </table>
        <div>
            <img src="#" alt="email screenshot">
        </div> 
        <div class="buttons">
          <div>
              <button id="{{$stud->rollno}}" href="#" style="background-color:lime;"> Approve </button>
          </div> 
          <div>
              <button id="{{$stud->rollno}}" href="#" style="background-color:red;"> Decline </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
</body>
</html>