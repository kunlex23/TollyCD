<form action="signup.php" method="POST" enctype="multipart/form-data" autocomplete="off">
    <h1>Create Account</h1>
    <div class="error-text"></div>
    <input type="text" name="fullName" placeholder="fullName" required>
    <input type="text" name="userId" placeholder="userId" required>
    <input type="password" name="password" placeholder="Enter new password" required>
    
    <select name="user" required>
        <option value="">Select user type...</option>
        <option value="olowo">Accountant</option>
        <option value="fifisi">Data Entry</option>
        <option value="eru">Inventory</option>
        <option value="alamojuto">Admin</option>
    </select>
    <div class="field button">
        <input type="submit" name="submit" value="Sign Up" style="background-color: #025a1a; color:white">
    </div>
</form>