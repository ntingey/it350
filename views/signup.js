<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sample Site</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
   <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    
</head>
<body>
    <div class="container col-sm-12" id="mainform">
            <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                                                           
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Sign Up</div>
                            <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="/">Sign In</a></div>
                        </div> 
                        <div class="panel-body" >
                            <form class="form-horizontal" role="form" method="post" action="/signup" onSubmit="return checkblank(this);">
                                <% if (message.length > 0) { %>
                                        
                                 <div id="signupalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="first_name" class="col-md-3 control-label">First Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="first_name" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="last_name" class="col-md-3 control-label">Last Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                                    </div>
                                </div>
                                                                                                <div class="form-group">
                                    <label for="mob_no" class="col-md-3 control-label">Mobile Number</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="mob_no" placeholder="Mobile Number">
                                    </div>
                                </div>
                                                                                                <div class="form-group">
                                    <label for="user_name" class="col-md-3 control-label">User Name</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="user_name" placeholder="User Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                </div>
 
                                <div class="form-group">
                                    <!-- Button -->                                       
                                    <div class="col-md-offset-3 col-md-9">
                                        <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Sign Up</button>
                                        
                                    </div>
                                </div>
                               
                                
                                
                                
                            </form>
                         </div>
                    </div>
              
                
         </div>
    </div>
   
</body>
</html>