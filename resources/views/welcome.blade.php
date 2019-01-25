<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laravel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style type="text/css">
    .row {
        background-color: #eee;
      }
      h2 {
        background-color: #416ba1;
        color: #fff;
      }
  </style>
</head>
<body>

<div class="container">
  <h2 class="text-center">Users</h2>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="flash-message">
               @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                 @if(Session::has('alert-' . $msg))

                   <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                   </p>
                 @endif
              @endforeach
          </div> 
          <form action="{{url('/userdata')}}" method="POST">
            <!-- {{csrf_field()}} -->
            @csrf
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" placeholder="Enter your name" name="name">
            </div>
            <div class="form-group">
              <label for="mobile">Mobile:</label>
              <input type="number" class="form-control" placeholder="Enter Mobile Number" name="mobile" min="999999999" max="9999999999">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
             <button type="submit" class="btn btn-default">Submit</button>
          </form>
        </div>
    </div>
</div>

</body>
</html>
