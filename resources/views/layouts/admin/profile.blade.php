<div class="profile clearfix">
  <div class="profile_pic">
    <img src="../assets1/img/images/boss.png" alt="..." class="img-circle profile_img">
  </div>
  <div class="profile_info">
    <span>Chào mừng,</span>
    <h2>@if(Auth::check())
            {{Auth::user()->fullname}}
            @endif</h2>
  </div>
  <div class="clearfix"></div>
</div>