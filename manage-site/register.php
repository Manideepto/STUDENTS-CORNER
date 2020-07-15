<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$org = $username = $password = $confirm_password = "";
$org_err = $username_err = $password_err = $confirm_password_err = "";
 

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    }else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }

    
    // Validate organisation select
    if(empty(trim($_POST["org"]))){
        $org_err = "Please select org.";     
    } else{
        $org = trim($_POST["org"]);
    }

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($org_err) ){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, org_id) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password,$param_org);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_org = $org;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: home.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($org_err)) ? 'has-error' : ''; ?>">
                <label>Select Organization</label>
                <input list="orgs" name="org" class="form-control" value="<?php echo $org; ?>" > 
                <datalist id="orgs">
                    <option value="org1">
                    <option value="org2">
                    <option value="eosc">
                    <option value="red-dot">
                    <option value="public-policy">
                    <option value="chaos">
                    <option value="heritage">
                    <option value="finesse">
                    <option value="consult-club">
                    <option value="decibel">
                    <option value="synergy">
                    <option value="smile">
                    <option value="iimally">
                    <option value="ccc">
                    <option value="panacea">
            <!-- premission pending -->
                    <option value="footloosefam">
                    <option value="LiterarySymposiumDesk">
                    <option value="womenleadership">
                    <option value="prayaas"> 
                    <option value="share">
                    <option value="sash">
                    <option value="excouncil">
                    <option value="fii">
                    <option value="optima">
                    <option value="abacus">
                    <option value="ideos">
                    <option value='acads'>
                    <option value='aerc'>
                    <option value='beta'>
                    <option value='cultcomm'>
                    <option value='eloquence'>
                    <option value='entrepreneurship-vc-club'>
                    <option value='equipoise'>
                    <option value='exchange'>
                    <option value='fcomm'>
                    <option value='fsi'>
                    <option value='fab'>
                    <option value='gmlc'>
                    <option value='iimacts'>
                    <option value='MADClub'>
                    <option value='mediacell'>
                    <option value='mentorshipcell'>
                    <option value='messcomm'>
                    <option value='decibel'>
                    <option value='Niche'>
                    <option value='perspectives'>
                    <option value='prakriti'>
                    <option value='prodman'>
                    <option value='rterc'>
                    <option value='sportscomm'>
                    <option value='stargazers'>
                    <option value='tedxiima'>
                    <option value='trbs'>



                </datalist>
                Contact admin if the club name is not available in the drop down
                <span class="help-block"><?php echo $org_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <!-- <input type="reset" class="btn btn-default" value="Reset"> -->
            </div>
            <p>Already have an account? <a href="home.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>
