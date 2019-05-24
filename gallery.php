<?php require 'includes/header.php'; ?>
    <div class="main-container">
        <?php require 'includes/sidebar.php'; ?>

        <div class="content"> 
        <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb" role="navigation">
              <ol class="breadcrumb" style="padding: 0; background: none; margin-top: -20px;">
                <li class="breadcrumb-item"><a href="#" onclick="history.back();"><i class="fa fa-arrow-left"></i> Back</a></li>
                <li class="breadcrumb-item"><a href="index.php"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active float-right" aria-current="page"><i class="fa fa-file"></i> Gallery</li>
              </ol>
            </nav>
          <div class="card">
            <div class="card-body">
                <div class="gallery" id="links">
                  <div class="row">

                  <?php
                    $dir = "assets/images/rooms/";

                    // Sort in ascending order - this is default
                    $a = scandir($dir);
                    // Sort in descending order
                    $b = scandir($dir,1);
                    foreach ($a as $path) {
                      if ($path == '..' || $path == '.') {
                       
                      }else{
                        echo '<div class="list"><a class="gallery-item" href="assets/images/rooms/'.$path.'" title="'.$path.'" data-gallery>
                        <div class="image">                              
                            <img src="assets/images/rooms/'.$path.'" alt="'.$path.'"/ class="img-thumbnail rounded float-left" >
                        </div>                             
                    </a></div>';
                      }
                      
                    }
                    ?>
                </div>
                
                <!-- BLUEIMP GALLERY -->
                <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
                    <div class="slides"></div>
                    <h3 class="title"></h3>
                    <a class="prev">‹</a>
                    <a class="next">›</a>
                    <a class="close">×</a>
                    <a class="play-pause"></a>
                    <ol class="indicator"></ol>
                </div>      
                <!-- END BLUEIMP GALLERY -->
          </div>
        </div>
      </div>
    </div>
</div> 
<style type="text/css">
.image img{
    width: 190px;
    height: 190px;  
}
.row{
  padding: 20px;
  padding-top: 0;
}
.list{ 
  padding: 3px;
  margin-right: 0;
  margin-bottom: 0;
  margin-left: 0;
  border-width: .2rem;
}
.gallery .gallery-item .image {
  width: 100%;
  -moz-box-shadow: 0px 2px 1px 0px rgba(0, 0, 0, 0.1);
  -webkit-box-shadow: 0px 2px 1px 0px rgba(0, 0, 0, 0.1);
  box-shadow: 0px 2px 1px 0px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  position: relative;
  overflow: hidden;
}
.gallery .gallery-item .image a {
  display: block;
}
.gallery .gallery-item .image:after,
.gallery .gallery-item .image:before {
  position: absolute;
  content: '';
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border: 3px solid #fff;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  border-radius: 3px;
  z-index: 1;
}
.gallery .gallery-item .image:before {
  z-index: 2;
  background: rgba(0, 0, 0, 0);
  -webkit-transition: all 200ms ease;
  -moz-transition: all 200ms ease;
  -ms-transition: all 200ms ease;
  -o-transition: all 200ms ease;
  transition: all 200ms ease;
}
.gallery .gallery-item .image:hover:before {
  background: rgba(0, 0, 0, 0.3);
}

.gallery .gallery-item .image .gallery-item-controls li a:hover,
.gallery .gallery-item .image .gallery-item-controls li span:hover {
  color: #22262e;
}
.gallery .gallery-item .image .gallery-item-controls li:first-child {
  -moz-border-radius: 0px 0px 0px 3px;
  -webkit-border-radius: 0px 0px 0px 3px;
  border-radius: 0px 0px 0px 3px;
}
.gallery .gallery-item .image .gallery-item-controls li:hover {
  background: #F5F5F5;
}

.gallery .gallery-item:hover .image .gallery-item-controls {
  right: 3px;
}
.gallery .gallery-item.active .image {
  -moz-box-shadow: 0px 0px 6px 0px rgba(51, 65, 78, 0.8);
  -webkit-box-shadow: 0px 0px 6px 0px rgba(51, 65, 78, 0.8);
  box-shadow: 0px 0px 6px 0px rgba(51, 65, 78, 0.8);
}
.gallery .gallery-item.active .image .gallery-item-controls {
  right: 3px;
}
/* end Gallery */
}
</style>
</body>
</html>
