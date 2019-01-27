<!DOCTYPE html>
<html lang="en">
<head>
  <title>Laravel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
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
      .fa {
        font-size: 20px;
        padding: 3px;
      }
  </style>
</head>
<body>

<div class="container">
  <h2 class="text-center">Edit Users Form</h2>
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
          <form action="{{url('/update-users')}}" method="POST" enctype="multipart/form-data">
            <!-- {{csrf_field()}} -->
            @csrf
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" class="form-control" value="{{$userdata['name']}}" placeholder="Enter your name" name="name">
            </div>
            <input type="hidden" value="{{$userdata['id']}}" name="user_id">
            <div class="form-group">
              <label for="mobile">Mobile:</label>
              <input type="number" class="form-control" value="{{$userdata['mobile']}}" placeholder="Enter Mobile Number" name="mobile">
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" value="{{$userdata['email']}}" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
              <label for="image">Image:</label>
              <input type="file" class="form-control" name="image">
            </div>
            <div class="form-group">
              <img src="{{asset('public/img/'.$userdata['image'])}}" width="100px" height="100px">
            </div>
             <button type="submit" class="btn btn-default">Update</button>
          </form>
        </div>
    </div>
</div>

</body>
</html>
