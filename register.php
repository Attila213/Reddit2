<div class="loginContainer d-flex justify-content-center mt-4" style="background:rgb(26,26,27);border: 1px solid rgb(150,150,150);padding:20px">
    <form action="php/ajaxRegister.php" method="post">
        <h1 class="text-info"> REGISTER </h1>
        <label for="us" class="text-success d-block"    >Username</label>
        <input type="text" name="username" id="us">
        
        <label for="us" class="text-success d-block">Password</label>
        <input type="password" name="password" id="ps">

        <label for="em" class="text-success d-block">Email</label>
        <input type="email" name="email" id="em">

        <button class="btn btn-primary mt-4 d-block w-100">SEND</button>
        <a href="?page=login">I have an account</a>
    </form>
</div>