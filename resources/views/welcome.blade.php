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

          <form action="{{url('/userdata')}}" method="POST" enctype="multipart/form-data">
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
            <div class="form-group">
              <label for="image">Image:</label>
              <input type="file" class="form-control" name="image">
            </div>
             <button type="submit" class="btn btn-default">Submit</button>
          </form>

        </div>
    </div>
    <!-- <hr> -->
    <div class="row">
      <div class="col-md-12">
        <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Mobile</th>
        <th>Email</th>
        <th>Image</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
      <tr>
        <td>{{$user['name']}}</td>
        <td>{{$user['mobile']}}</td>
        <td>{{$user['email']}}</td>
        <td>
          @if(!empty($user['image']))
          <img src="{{asset('public/img/'.$user['image'])}}" width="100px" height="100px">
          @else
          <img src="{{asset('public/img/dummy.jpg')}}" width="100px" height="100px">
          @endif


        </td>
        <td><a href="{{url('/edit-users/'.base64_encode(convert_uuencode($user['id'])))}}"><i class="fa fa-edit"></i></a><a href="{{url('/delete-users/'.base64_encode(convert_uuencode($user['id'])))}}"><i class="fa fa-trash"></i></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <hr>
  <a href="{{url('/invest')}}">Invest</a>
      </div>
    </div>
</div>

</body>
</html>
