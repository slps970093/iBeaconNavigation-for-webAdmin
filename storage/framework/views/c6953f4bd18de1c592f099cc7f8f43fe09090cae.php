          <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><?php echo e($title); ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo e(url('users')); ?>">用戶與網站標題管理</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo e(url('ibeacon')); ?>">iBeacon資料管理</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="https://github.com/slps970093/iBeaconNavigation-for-webAdmin">專案原始碼</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo e(url('logout')); ?>">登出</a>
                </li>
              </ul>
            </div>
            
          </nav>