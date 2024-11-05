<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href={{ asset('CSS/register.css') }}>
</head>
<body> 

    <div class="container">
        <div class="login-section">
            <h2>Joined?</h2>
            <p>Read is my middle name!</p>
            <button class="login-button">Login</button>
        </div>
        <div class="signup-section">    
            <h2>Sign Up</h2>
            <form>
                <input type="text" placeholder="Username" class="input-field">
                <input type="password" placeholder="Password" class="input-field">
                <button type="submit" class="signup-button">Sign Up</button>
            </form>
        </div>
    </div>


</body>

</html>
