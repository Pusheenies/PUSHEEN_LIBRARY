<html>
<head>
     <title>Pusheen Library - Registration</title>
        <meta charset="UTF-8">
        <!--Bootstrap-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!--StyleSheets-->
        <link rel="stylesheet" type="text/css" href="./_css/style.css" />
        <!--Fonts-->
        <link rel="stylesheet" type="text/css" href="./_css/ss-pika.css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="styles.css" rel="stylesheet" type="text/css"/>  
</head>
    <body>
        
        
        <div class="container">
            <h1>Register</h1>
        </div>
        
        
                    
        <div id="unique-section" class="../row">
                <div class="section">
        <form method="post" action="register.php">
                
        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="forename" class="form-control" placeholder="First Name" required autofocus/>
        </div>
            
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="surname" class="form-control" placeholder="Last Name" required autofocus/>
        </div>
        
        <div class="form-group">
            <label>Address 1:</label>
            <input type="text" name="address_line1" class="form-control" placeholder="Address line 1" required autofocus/>
        </div>
            
        <div class="form-group">
            <label>Address 2:</label>
            <input type="text" name="address_line2" class="form-control" placeholder="Address line 2" required autofocus/>
        </div>
        
        <div class="form-group">
            <label>Address 3:</label>
            <input type="text" name="address_line3" class="form-control" placeholder="Address line 3" required autofocus/>
        </div>
            
        <div class="form-group">
            <label>City:</label>
            <input type="text" name="city" class="form-control" placeholder="City" required autofocus/>
        </div> 
            
        <div class="form-group">
            <label>Postcode:</label>
            <input type="text" name="postcode" class="form-control" placeholder="Post Code" required autofocus/>
        </div> 
                       
        <div class="form-group">
            <label>Email:</label>
        <input type="email" name="email" class="form-control" placeholder="pusheen@pusheen.com" required autofocus/>
        </div> 
        
        <div class="form-group">
            <label>Phone:</label>
        <input type="text" name="phone" class="form-control" placeholder="Phone" required autofocus/>
        </div> 
        
        <div class="form-group">
            <label>Username:</label>
            <input type="text" name="username" class="form-control" placeholder="Username" required autofocus/>
        </div>
            
        <div class="form-group">
            <label>Password:</label>
        <input type="password" name="password" class="form-control" placeholder="*******" required autofocus/>
        </div> 
        
        <div class="form-group">
            <label>Confirm Password:</label>
            <input type="text" name="cpassword" class="form-control" placeholder="*******" required autofocus/>
        </div> 
            
        <div class="form-group">
            <input type="submit" name="register" class="btn btn-primary"/>
        </div>
            </form>
                    <div id="error-msg" class="mt-4"><!-- Error message for unsuccessful login --></div>
                </div>
            
  	<div class="form-group">
  		Already a member? <a href="login/index.html">Sign in</a>
  	</div>
         <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <script src="ajax.js"></script>
    </body>
</html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

