<div style="text-align: center;">
    <br><br>
    <form style="display: inline-block;" action="{{ route('login.post') }}" method="POST">
        @CSRF
        <label for="username">Email:</label>
        <input style="border-color: #0b2e13" type="text" name="email"><br><br>
        <label for="password">Password:</label>
        <input style="border-color: #0b2e13" type="password" name="password"><br><br>
        <input style="color: #0c84ff" type="submit" value="Login">
    </form>
</div>

