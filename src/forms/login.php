<div class="form-value">
    <div class="inputbox">
        <ion-icon name="mail-outline"></ion-icon>
        <input type="email" required class="emailLogin">
        <label for="">Email</label>
    </div>
    <div class="inputbox">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input type="password" required class="passLogin">
        <label for="">Password</label>
    </div>
    <div class="forget">
        <label for="">
            <input type="checkbox">Remember Me
            <span>|</span>
            <a onclick="loader('ngikhohliwe')">Forgot Password</a>
        </label>
    </div>
    <button onclick="siyangenaManje()">Log in</button>
    <div class="register">
        <p>Don't have an Account?
            <span>|</span>
            <a onclick="loader('createAccount')">Create an Account</a>
        </p>
    </div>
    <br>
    <div class="processing" hidden></div>
</div>
