<div class="form-value">
    <div class="inputbox">
        <ion-icon name="mail-outline"></ion-icon>
        <input type="text" required class="name">
        <label for="">Name & Surname</label>
    </div>
    <div class="inputbox">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input type="number" required class="phone">
        <label for="">Phone</label>
    </div>
    <div class="inputbox">
        <ion-icon name="mail-outline"></ion-icon>
        <input type="email" required class="email">
        <label for="">Email</label>
    </div>
    <div class="inputbox">
        <ion-icon name="lock-closed-outline"></ion-icon>
        <input type="password" required class="pass">
        <label for="">Password</label>
    </div>
    <button onclick="sakhaEntsha()">Create Account</button>
    <div class="register">
        <p>By creating an Account you agree to Ts&Cs.</p>
        <p>Already have an Account?
            <span>|</span>
            <a onclick="loader('login')">Login</a>
        </p>
    </div>
    <br>
    <div class="processing" hidden></div>

</div>
