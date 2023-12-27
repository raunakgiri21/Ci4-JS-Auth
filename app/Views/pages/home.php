<div class="my-container home-section">
  <h1>Welcome <?=esc($name)?>, You are logged in with <?=esc($email)?></h1>
  <div class="logout-container">
    <form action="logout" method="POST">
      <?= csrf_field() ?>
      <input type="submit" class="btn btn-danger" name="logout" value="Log Out">
    </form>
  </div>
</div>