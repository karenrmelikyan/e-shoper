<div style="text-align: center;">
    <br><br>
    <form style="display: inline-block;" action="{{ route('login.post') }}" method="POST">
        @CSRF
        <label for="username">Username:</label>
        <input style="border-color: #0b2e13" type="text" id="name" name="name"><br><br>
        <label for="password">Password:</label>
        <input style="border-color: #0b2e13" type="password" id="password" name="password"><br><br>
        <input style="color: #0c84ff" type="submit" value="Login">
    </form>
</div>

