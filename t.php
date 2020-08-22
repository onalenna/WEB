<!DOCTYPE html>
<html lang="en">
<head>
  <title>ABS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: red;
  color: white;
  text-align: center;
}
</style>
</head>
<body>
	<div class="container">
		<div class="row">
    <div class="jumbotron" style="background-color: transparent;">
      <span class="glyphicon glyphicon-th" style="float: right;"   data-toggle="modal" data-target="#myModal"></span>
    </div>  
    </div>
		<div class="col-sm-2"></div>
		<div class="col-sm-8">

    <h2><center style="color:pink">GOOGLE</center></h2>

			<form class="form-group"  method="POST">
            <div class="input-group">
              <input type="text"  class="form-control" placeholder="Search videos..." name="searchString" onkeypress ="searchq();">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit" name="findVideos">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
              </span>
            </div>
          </form>
		</div>
		<div class="col-sm-2"></div>
    <div class="footer">
  <p>Footer</p>
</div>
	</div>
  <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


</body>
</html>