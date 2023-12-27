  <div class="my-container">
    <div class="my-form">
      <div class='error-msg <?=esc($display)?>'><?php foreach($msg as $m) {
        echo $m . '<br>';
      } ?></div>
      <div class="switch-tab">
        <a href="<?=base_url('signin')?>" class="sign-in-tab <?=esc($signinActive)?>">
          <span>Sign In</span>
        </a>
        <a href="<?=base_url('signup')?>" class="sign-up-tab <?=esc($signupActive)?>">
          <span>Sign Up</span>
        </a>
      </div>