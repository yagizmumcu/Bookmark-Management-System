
<div class="container">
    <form action="editProfile" method="post">
            <div class="file-field input-field">
                <div class="btn">
                    <span>File</span>
                    <input type="file" name="profile">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <input type="hidden" name="id" value="<?= $_SESSION["user"]["id"] ?>">
            <div class="input-field col s11 offset-s1">
                <i class="material-icons prefix">email</i>
                <input id="user_name" type="text" name="name" value="<?=$_SESSION["user"]["name"]?>">
                <label for="user_name">Fullname</label>
            </div>
            <div class="input-field col s11 offset-s1">
                <i class="material-icons prefix">email</i>
                <input id="user_email" type="text" name="email" value="<?=$_SESSION["user"]["email"]?>">
                <label for="user_email">Email</label>
            </div>
            <div class="input-field col s11 offset-s1">
                <i class="material-icons prefix">lock</i>
                <input id="user_pass" type="password" name="password">
                <label for="user_pass">New Password</label>
            </div>
            <div class="input-field col s11 offset-s1 center">
                <button type="submit" class="submit-btn waves-effect waves-light btn-large">Edit Profile</button>
            </div>
    </form>
</div>