<?php require("header.php") ?>
<style type="text/css">
	.thumbnails li {
	display: inline-block;
	width: 100px;
	margin: 0 5px;
}

.thumbnails img {
	display: block;
	min-width: 100%;
	max-width: 100%;
}
</style>
<?php
foreach ($productdetail as $key => $row) {
    # code...
    $photo = base_url() . 'uploads/'.$row['photo'];
    $thumb = explode(".",$row['photo']);
    $photothumb = base_url() . 'uploads/thumb/'.$thumb[0] .'_thumb.'.$thumb[1];
    $productcode = $row['productcode'];
    $productname = $row['productname'];
    $price = $row['sale'];
    $stock = $row['stock'];
    $min_stock = $row['min_stock'];
    $description = $row['description'];
    $poin = $row['poin'];
    $namakategori = $row['namakategori'];
    $diskon = $row['diskon'];
    if($row['diskon'] != '0'){
    	$hrgDisk = $row['sale'] - $row['diskon'];
    } else {
    	$hrgDisk = $row['sale'];
    }
}
?>
	<br><br>
	<!-- <div class="row">
		<ol class="breadcrumb">
		  <li><a href="#"><i class="fa fa-home"></i></a></li>
		  <li><a href="#">Kategori</a></li>
		  <li><a href=""><?php echo ucwords( strtolower($namakategori)) ?></a></li>
		  <li class="active"><?php echo $productname ?></li>
		</ol>
		
		<div id="bc1" class="btn-group btn-breadcrumb">
            <a href="/" class="btn btn-default"><i class="fa fa-home"></i></a>
            <a href="#" class="btn btn-default"><div>Product</div></a>
            <a href="#" class="btn btn-default"><div>Category</div></a>
        </div>
	</div> -->
	
	<div class="row">
		<div class="col-md-12">
			<div class="exp-pdp-container body-font nowrap ">
          
              <div class="exp-pdp-main-pdp-content" itemtype="http://schema.org/Product" itemscope="">
                
                <div class="exp-pdp-hero-and-alt-images-container">

                  <div class="exp-pdp-product-image">
                      <div class="easyzoom easyzoom--adjacent">
						<a href="<?php echo $photo ?>" class="item">
							<img id="zoom_01" src="<?php echo $photothumb ?>" data-zoom-image="<?php echo $photo ?>" >
						</a>
					</div>
                  </div>  
                  
                  
                  <div class="exp-pdp-alt-images-container">
                      <div class="exp-pdp-alt-images-arrow exp-pdp-prev-arrow   exp-pdp-show-horiz-arrows disabled">
                          <a href="http://store.nike.com/us/en_us/pd/hyperdunk-2016-flyknit-mens-basketball-shoe/pid-11055700/pgid-11139448#" class="alt-image-nav up-arrow nsg-text--medium-grey"><div class="nsg-glyph--chevron-up"></div></a>
                          <a href="http://store.nike.com/us/en_us/pd/hyperdunk-2016-flyknit-mens-basketball-shoe/pid-11055700/pgid-11139448#" class="alt-image-nav left-arrow nsg-text--medium-grey"><div class="nsg-glyph--chevron-left"></div></a>
                      </div>
                      <div class="exp-pdp-alt-images-viewport ">
                          <ul class="exp-pdp-alt-images-carousel" style="left: 0px; top: 0px;">
                          	<?php
								foreach ($otherimg->result_array() as $key => $value) {
									$ex = explode(".", $value['image']);
									$pathThumb = base_url() . 'uploads/thumb/'.$ex[0].'_thumb.'.$ex[1];
									$path = base_url() . 'uploads/'.$value['image'];
									echo '<li class="exp-pdp-image-container exp-pdp-active"><a href="'.$path.'" data-standard="'.$path.'"><img src="'.$pathThumb.'" class="thumbnail" ></a></li>';
								}
							?>
                                <!-- <li class="exp-pdp-image-container exp-pdp-active">
                                    <img class="exp-pdp-alt-image" alt="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe" src="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/NIKE-HYPERDUNK-2016-FK-843390_446_A_PREM(1).jpg" data-large-image="http://images.nike.com/is/image/DotCom/PDP_HERO/NIKE-HYPERDUNK-2016-FK-843390_446_A_PREM.jpg" data-medium-image="http://images.nike.com/is/image/DotCom/PDP_HERO_M/NIKE-HYPERDUNK-2016-FK-843390_446_A_PREM.jpg" data-small-image="http://images.nike.com/is/image/DotCom/PDP_HERO_S/NIKE-HYPERDUNK-2016-FK-843390_446_A_PREM.jpg" data-index="0">
                                </li>
                                <li class="exp-pdp-image-container ">
                                    <img class="exp-pdp-alt-image" alt="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe" src="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/NIKE-HYPERDUNK-2016-FK-843390_446_B_PREM.jpg" data-large-image="http://images2.nike.com/is/image/DotCom/PDP_HERO/NIKE-HYPERDUNK-2016-FK-843390_446_B_PREM.jpg" data-medium-image="http://images2.nike.com/is/image/DotCom/PDP_HERO_M/NIKE-HYPERDUNK-2016-FK-843390_446_B_PREM.jpg" data-small-image="http://images2.nike.com/is/image/DotCom/PDP_HERO_S/NIKE-HYPERDUNK-2016-FK-843390_446_B_PREM.jpg" data-index="1">
                                </li>
                                <li class="exp-pdp-image-container ">
                                    <img class="exp-pdp-alt-image" alt="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe" src="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/NIKE-HYPERDUNK-2016-FK-843390_446_C_PREM.jpg" data-large-image="http://images3.nike.com/is/image/DotCom/PDP_HERO/NIKE-HYPERDUNK-2016-FK-843390_446_C_PREM.jpg" data-medium-image="http://images3.nike.com/is/image/DotCom/PDP_HERO_M/NIKE-HYPERDUNK-2016-FK-843390_446_C_PREM.jpg" data-small-image="http://images3.nike.com/is/image/DotCom/PDP_HERO_S/NIKE-HYPERDUNK-2016-FK-843390_446_C_PREM.jpg" data-index="2">
                                </li>
                                <li class="exp-pdp-image-container ">
                                    <img class="exp-pdp-alt-image" alt="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe" src="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/NIKE-HYPERDUNK-2016-FK-843390_446_D_PREM.jpg" data-large-image="http://images.nike.com/is/image/DotCom/PDP_HERO/NIKE-HYPERDUNK-2016-FK-843390_446_D_PREM.jpg" data-medium-image="http://images.nike.com/is/image/DotCom/PDP_HERO_M/NIKE-HYPERDUNK-2016-FK-843390_446_D_PREM.jpg" data-small-image="http://images.nike.com/is/image/DotCom/PDP_HERO_S/NIKE-HYPERDUNK-2016-FK-843390_446_D_PREM.jpg" data-index="3">
                                </li>
                                <li class="exp-pdp-image-container ">
                                    <img class="exp-pdp-alt-image" alt="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe" src="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/NIKE-HYPERDUNK-2016-FK-843390_446_E_PREM.jpg" data-large-image="http://images2.nike.com/is/image/DotCom/PDP_HERO/NIKE-HYPERDUNK-2016-FK-843390_446_E_PREM.jpg" data-medium-image="http://images2.nike.com/is/image/DotCom/PDP_HERO_M/NIKE-HYPERDUNK-2016-FK-843390_446_E_PREM.jpg" data-small-image="http://images2.nike.com/is/image/DotCom/PDP_HERO_S/NIKE-HYPERDUNK-2016-FK-843390_446_E_PREM.jpg" data-index="4">
                                </li>
                                <li class="exp-pdp-image-container ">
                                    <img class="exp-pdp-alt-image" alt="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe" src="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/NIKE-HYPERDUNK-2016-FK-843390_446_F_PREM.jpg" data-large-image="http://images3.nike.com/is/image/DotCom/PDP_HERO/NIKE-HYPERDUNK-2016-FK-843390_446_F_PREM.jpg" data-medium-image="http://images3.nike.com/is/image/DotCom/PDP_HERO_M/NIKE-HYPERDUNK-2016-FK-843390_446_F_PREM.jpg" data-small-image="http://images3.nike.com/is/image/DotCom/PDP_HERO_S/NIKE-HYPERDUNK-2016-FK-843390_446_F_PREM.jpg" data-index="5">
                                </li> -->
                          </ul>
                      </div>
                      <div class="exp-pdp-alt-images-arrow exp-pdp-next-arrow   exp-pdp-show-horiz-arrows enabled">
                          <a href="http://store.nike.com/us/en_us/pd/hyperdunk-2016-flyknit-mens-basketball-shoe/pid-11055700/pgid-11139448#" class="alt-image-nav down-arrow nsg-text--medium-grey"><div class="nsg-glyph--chevron-down"></div></a>
                          <a href="http://store.nike.com/us/en_us/pd/hyperdunk-2016-flyknit-mens-basketball-shoe/pid-11055700/pgid-11139448#" class="alt-image-nav right-arrow nsg-text--medium-grey"><div class="nsg-glyph--chevron-right"></div></a>
                      </div></div>    <div class="exp-pdp-style-social-logo-wrapper">
                      <div class="exp-pdp-social-dialog js-exp-pdp-social-dialog">
                        <div class="exp-pdp-social-buttons">
                              <div class="exp-facebook-like-container">
                                  <div class="social-facebook glyph-icon js-exp-sharing-option" data-url="http://store.nike.com/us/en_us/pd/hyperdunk-2016-flyknit-mens-basketball-shoe/pid-11055700/pgid-11139448?cp=usns_soc_101511_fbshare" data-type="static"><a class="nsg-glyph--facebook glyph-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http://store.nike.com/us/en_us/pd/hyperdunk-2016-flyknit-mens-basketball-shoe/pid-11055700/pgid-11139448?cp=usns_soc_101511_fbshare" title="Facebook"><img src="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/facebook_24.png" width="24" height="24" alt="Facebook"></a></div>
                              </div>
                              <div class="exp-twitter-tweet-container">
                                  <div class="social-twitter glyph-icon js-exp-sharing-option" data-url="http://store.nike.com/us/en_us/pd/hyperdunk-2016-flyknit-mens-basketball-shoe/pid-11055700/pgid-11139448?cp=usns_soc_101511_twitshare" data-type="static" data-text="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe"><a class="nsg-glyph--twitter glyph-twitter" target="_blank" href="https://twitter.com/intent/tweet?text=Products%20engineered%20for%20peak%20performance%20in%20competition,%20training,%20and%20life.%20Shop%20the%20latest%20innovation%20at%20Nike.com.&amp;url=http://store.nike.com/us/en_us/pd/hyperdunk-2016-flyknit-mens-basketball-shoe/pid-11055700/pgid-11139448?cp=usns_soc_101511_twitshare" title="Twitter"><img src="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/twitter_24.png" width="24" height="24" alt="Twitter"></a></div>
                              </div>
                              <div class="exp-pinterest-pinit-container">
                                  <div class="social-pinterest glyph-icon js-exp-sharing-option" data-url="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fstore.nike.com%2Fus%2Fen_us%2Fpd%2Fhyperdunk-2016-flyknit-mens-basketball-shoe%2Fpid-11055700%2Fpgid-11139448%3Fcp%3Dusns_soc_042213_pinshare&amp;media=http%3A%2F%2Fimages.nike.com%2Fis%2Fimage%2FDotCom%2FTHN_PS%2FNIKE-HYPERDUNK-2016-FK-843390_446.jpg%3Fhei%3D300%26wid%3D400%26fmt%3Dpng&amp;description=Nike+Hyperdunk+2016+Flyknit+Men%27s+Basketball+Shoe" data-type="static" data-pic="http://images.nike.com/is/image/DotCom/THN_PS/NIKE-HYPERDUNK-2016-FK-843390_446.jpg?hei=300&amp;wid=400&amp;fmt=png" data-text="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe"><a class="nsg-glyph--pinterest glyph-pinterest" target="_blank" href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fstore.nike.com%2Fus%2Fen_us%2Fpd%2Fhyperdunk-2016-flyknit-mens-basketball-shoe%2Fpid-11055700%2Fpgid-11139448%3Fcp%3Dusns_soc_042213_pinshare&amp;media=http%3A%2F%2Fimages.nike.com%2Fis%2Fimage%2FDotCom%2FTHN_PS%2FNIKE-HYPERDUNK-2016-FK-843390_446.jpg%3Fhei%3D300%26wid%3D400%26fmt%3Dpng&amp;description=Nike+Hyperdunk+2016+Flyknit+Men%27s+Basketball+Shoe" title="Pinterest"><img src="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/pinterest_24.png" width="24" height="24" alt="Pinterest"></a></div>
                              </div>
                        </div>
                        <div class="nsg-glyph--arrow-down glyph-pointer"></div>
                      </div>
                      <button class="exp-share-button js-exp-share-button nsg-button nsg-grad--light-grey">
                        Share <i class="fa fa-share"></i>
                      </button>
                    </div>
                </div>
                
                
                <div class="exp-pdp-content-container " style="position: relative;">

                  <div class="exp-product-header" style="opacity: 1;">
                        <h1 class="exp-product-title nsg-font-family--platform" itemprop="name"><?php echo $productname ?></h1>
                        <h2 class="exp-product-subtitle nsg-font-family--platform"><?php echo $description ?></h2>
                      <div class="exp-product-info nsg-font-family--platform">
                          
                          <span class="exp-pdp-product-price-container">  <div class="exp-pdp-product-price nsg-text--dark-grey exp-pdp-product-swoosh-price-available" itemtype="http://schema.org/Offer" itemprop="offers" itemscope="">
    				<span class="exp-pdp-local-price" itemprop="price">Rp. <?php echo number_format($hrgDisk) ?></span>
  </div>
</span>
                            <a href="javascript:;" class="js-reviews-summary-link">
                              <div class="exp-pdp-ratings-container has-reviews" itemtype="http://schema.org/AggregateRating" itemprop="aggregateRating" itemscope="">
                                <!-- <span class="reviews-summary">
                                  <span class="review-rating review-rating-stars">
                                    <span style="width:0%;"></span>
                                  </span>
                                </span> -->
                                <span class="exp-pdp-review-count">Ulasan (<?php echo $this->core->countreview($productcode) ?>)</span>
                              </div>
                            </a>
                      </div>
                  </div>

                  <hr class="exp-pdp-separator" style="opacity: 1;">

                  <!--<div class="hero-product-style-color-info" data-stylenumber="843390" style="opacity: 1;">
                      <div class="colorNum clearfix">
                        <span class="exp-style-color">Style: 843390-446</span>
                            <span class="colorText">Dark Obsidian/Bright Crimson/Photo Blue/Dark Obsidian</span>
                      </div>
                  </div>  

                   <div class="exp-pdp-colorways" style="opacity: 1;">
                    
                      <div class="color-chips">
                        <ul data-status="IN_STOCK" class="color-chip-container">
                            <li class="">
                        <a href="http://store.nike.com/us/en_us/pd/hyperdunk-2016-flyknit-mens-basketball-shoe/pid-11055697/pgid-11139448" data-productid="11055697" title="Black/White" aria-label="Product color:Black/White">
                          <img src="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/Nike-Hyperdunk-2016-Flyknit-843390_010.jpg" alt="Black/White">
                        </a>
                      </li>
                      <li class="">
                        <a href="http://store.nike.com/us/en_us/pd/hyperdunk-2016-flyknit-mens-basketball-shoe/pid-11055698/pgid-11139448" data-productid="11055698" title="Black/Volt/Total Orange/White" aria-label="Product color:Black/Volt/Total Orange/White">
                          <img src="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/Nike-Hyperdunk-2016-Flyknit-843390_017.jpg" alt="Black/Volt/Total Orange/White">
                        </a>
                      </li>
                      <li class="">
                        <a href="http://store.nike.com/us/en_us/pd/hyperdunk-2016-flyknit-mens-basketball-shoe/pid-11055699/pgid-11139448" data-productid="11055699" title="White/Bright Crimson/Dark Obsidian" aria-label="Product color:White/Bright Crimson/Dark Obsidian">
                          <img src="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/Nike-Hyperdunk-2016-Flyknit-843390_146.jpg" alt="White/Bright Crimson/Dark Obsidian">
                        </a>
                      </li>
                      <li class="selected">
                        <a href="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com.html" data-productid="11055700" title="Dark Obsidian/Bright Crimson/Photo Blue/Dark Obsidian" aria-label="pdp.selected.colorWay.ariaDark Obsidian/Bright Crimson/Photo Blue/Dark Obsidian">
                          <img src="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/Nike-Hyperdunk-2016-Flyknit-843390_446.jpg" alt="Dark Obsidian/Bright Crimson/Photo Blue/Dark Obsidian">
                        </a>
                      </li>
                    
                        </ul>
                      </div>
                    </div> -->

                  <div id="exp-pdp-buying-tools-container" class="exp-pdp-buying-tools-container " style="opacity: 1;">
                         
                            <div class="size-fit-link-container">
                                <a class="open-size-and-fit underline" data-tab="fit-tab" data-window-location="mens-shoe-sizing-chart" href="http://store.nike.com/us/en_us/pd/hyperdunk-2016-flyknit-mens-basketball-shoe/pid-11055700/pgid-11139448#">
                                  Size Chart
                                </a>
                            </div>
                        <form action="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com_files/Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe. Nike.com.html" method="post" class="add-to-cart-form nike-buying-tools">
                          <input type="hidden" name="action" value="addItem">
                          <input type="hidden" name="lang_locale" value="en_US">
                          <input type="hidden" name="country" value="US">
                          <input type="hidden" name="catalogId" value="1">
                          <input type="hidden" name="productId" value="11055700">
                          <input type="hidden" name="price" value="200.0">
                          <input type="hidden" name="siteId" value="">
                          <input type="hidden" name="line1" value="Nike Hyperdunk 2016 Flyknit">
                          <input type="hidden" name="line2" value="Men's Basketball Shoe">
                          <input type="hidden" name="passcode">
                          <input type="hidden" name="sizeType" value="">
                    
                          <div class="exp-pdp-size-and-quantity-containerx">

                             <div class="form-group">
								<label>Quantity</label>
								<!-- <input type="number" name="qty" id="qty" placeholder="0" class="form-control" style="z-index:0;" required="required" value="1"> -->
								<select class="form-control" name="qty" id="qty" required="required">
									<option value=""> [ Quantity ]</option>
									<?php for ($i=1; $i<=10; $i++) {
										echo '<option value="'.$i.'">'.$i.'</option>';
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Ukuran</label>
								<select class="form-control" name="size" id="size" required="required">
									<option value=""> [ Pilih Ukuran ]</option>
									<?php foreach ($size as $value) {
										echo '<option value="'.$value['size'].'">'.$value['size'].'</option>';
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Warna</label>
								<select class="form-control" name="color" id="color" required="required">
									<option value=""> [ Pilih Warna ]</option>
									<?php foreach ($color as $value) {
										echo '<option value="'.$value['color'].'">'.$value['color'].'</option>';
									}
									?>
								</select>
							</div> 

							<button id="buyingtools-add-to-cart-button" type="button" class="js-add-to-cart add-to-cart nsg-button nsg-grad--nike-orange pull-right" onclick="addtocart('<?php echo $productcode ?>','<?php echo $productname ?>','<?php echo $hrgDisk ?>')">
                                  ADD TO CART <i class="fa fa-shopping-cart"></i>
                            </button>                  
                          </div>
                    
                    		<div class="clearfix"></div>
                          <div class="exp-pdp-save-container">
                            
                                <!-- <div class="locker-link-container">
                                  <a class="pdp-mylocker underline" href="http://store.nike.com/us/en_us/pd/hyperdunk-2016-flyknit-mens-basketball-shoe/pid-11055700/pgid-11139448#">Save to Wish List</a>
                                </div> -->
                          </div>
                        </form>
                    
                    
                    
                    <!-- <div class="add-to-cart-timeout-modal-content is-hidden">
                      <div class="add-to-cart-header-container add-to-cart-border">
                            <span class="add-to-cart-header nsg-text--dark-grey edf-title-font-size--xlarge nsg-font-family--platform">
                    					PLEASE TRY AGAIN
                            </span>
                      </div>
                      <hr class="exp-pdp-separator">
                      <div class="add-to-cart-text-container">
                            <span class="add-to-cart-text nsg-text--medium-grey nsg-font-family--base">
                    					Sorry, there was a problem processing your request. Please try to add to cart again.
                            </span>
                      </div>
                      <div class="modal-button-container">
                        <div class="add-to-cart-button-container-left">
                          <button href="#" class="nsg-button nsg-grad--nike-orange ok">OK</button>
                        </div>
                      </div>
                    </div>
                    
                    <div class="smart-cart">
                      <div class="message-template"></div>
                    </div>
                    
                    
                    
                    <div class="exp-access-code-modal-content">
                      <div class="header edf-title-font-size--xlarge nsg-font-family--platform">
                        <span class="default-title">LOG IN</span>
                        <span class="not-tethered-title not-error-modal">NO ACCESS FOUND</span>
                        <span class="error-title"></span>
                        <span class="failure-title">ATTENTION!</span>
                      </div>
                    
                      <span class="error-container empty-forms-error edf-font-size--regular js-empty-forms-error nsg-font-family--base" data-empty-forms-error="Please sign in or enter an access code.">
                        <span class="nsg-glyph--alert nsg-text--nike-orange error-icon"></span>
                        <span class="error-text"></span>
                      </span>
                    
                      <div class="divider"></div>
                    
                    	<span id="login-form-container">
                        <div class="subheader edf-font-size--regular">
                          <span class="default-subheader edf-font-size--regular">Log in with your Nike+ account to unlock this product</span>
                          <span class="error-subheader edf-font-size--regular">
                            <span class="nsg-glyph--alert nsg-text--nike-orange error-icon"></span>
                            <span class="error-text">Your email or password was entered incorrectly.</span>
                          </span>
                          <span class="failure-subheader edf-font-size--regular">There’s been an error processing your access code. Please re-enter and try again.</span>
                        </div>
                    
                        <form class="exp-global-form passcode-login-form not-error-modal" name="passcode-login-form" data-error="We’re sorry, we are unable to fulfill your request, please try again." disabled="">
                          <div class="button-container login-button-wrapper not-error-modal">
                            <button type="button" class="nsg-button nsg-bg--black nsg-text--white unite-login-redirect js-loginRedirect">
                              <span class="login-text">LOG IN</span>
                            </button>
                          </div>
                        </form>
                      </span>
                      <div class="divider"></div>
                    
                    	<form class="exp-global-form passcode-form" name="passcode-form" method="post">
                    		<div class="access-code-text not-error-modal edf-font-size--regular">Or, if you've scored an access code, enter it below.</div>
                    		<div class="not-tethered-text not-error-modal edf-font-size--regular">You don't have access to this product. If you've scored and access code, enter it below.
                    OR</div>
                        <div class="access-code-text2 error-modal edf-font-size--regular">Try your Nike+ login</div>
                    
                        <div class="access-code-field exp-input-wrapper">
                    		  <input type="text" name="passcode" autocomplete="off" class="nsg-form--input" required="required" data-error="Please enter a valid access code." data-validator="default" data-blur-validate="false" placeholder="Enter access code here">
                    		</div>
                        <input class="is-hidden" id="acm-passcode-submit" type="submit" tabindex="-1">
                    	</form>
                    
                    	<div class="button-container">
                    		<button type="button" class="nsg-button nsg-bg--light-grey submit-button js-modal-submit">
                    			SUBMIT
                    		</button>
                        <button type="button" class="nsg-button nsg-bg--light-grey submit-button js-modal-continue">
                          Continue Shopping
                        </button>
                    	</div>
                    	<div class="help-link">
                    		<a class="edf-font-size--regular" href="http://help-en-us.nike.com/app/answers/detail/article/access-code">
                    			Get Help
                    		</a>
                    	</div>
                    </div>
                    	
                    	
                    	
                    	<div class="exp-notify-me-modal-content">
                    	    <div class="notify-main-content">
                    	        <h3 class="edf-font-size--xlarge nsg-font-family--platform nsg-text--dark-grey">
                    	          Notify Me
                    	        </h3>
                    	        <hr class="exp-pdp-separator">
                    	        <div class="nsg-font-family--base nsg-text--medium-grey edf-font-size--regular">
                    	            <p>
                    	              We’re sorry, your selection is not available online.  Please enter your name and email and we’ll notify you as soon as it’s in stock.
                    	            </p>
                    	
                    	            <form id="notify-me-form" method="post">
                    	                <input type="hidden" name="action" value="notifyMeSubmit">
                    	                <input type="hidden" name="itemcolor" value="446">
                    	                <input type="hidden" name="stylenumber" value="843390">
                    	                <input type="hidden" name="country" value="US">
                    	                <input type="hidden" name="locale" value="en_US_USD">
                    	                <input type="hidden" name="siteid" value="">
                    	                <input type="hidden" name="sizetype" value="">
                    	                <input type="hidden" name="itemsize" value="">
                    	                <input type="hidden" name="skuid" value="">
                    	
                    	                <div class="product">
                    	                    <img class="image" src="data:image/gif;base64,R0lGODlhAQABAID/AMDAwAAAACH5BAEAAAAALAAAAAABAAEAQAICRAEAOw==" data-blzsrc="http://images.nike.com/is/image/DotCom/PDP_THUMB/NIKE-HYPERDUNK-2016-FK-843390_446_A_PREM.jpg?fmt=jpg&amp;qty=85&amp;wid=140&amp;hei=140&amp;bgc=FFFFFF" alt="Nike Hyperdunk 2016 Flyknit Men's Basketball Shoe">
                    	                    <div class="info">
                    	                        <div class="title nsg-text--dark-grey">
                    	                          Nike Hyperdunk 2016 Flyknit
                    	                        </div>
                    	                        <div class="subtitle">
                    	                          Men's Basketball Shoe
                    	                        </div>
                    	                        <div class="color-quantity">
                    	                            <span class="label nsg-text--dark-grey">Color:</span> Dark Obsidian/Bright Crimson/Photo Blue/Dark Obsidian
                    	                            <br>
                    	                            <span class="label nsg-text--dark-grey">Qty:</span> 1 @
                    	<span class="exp-pdp-notify-me-product-price-container">                              <span class="nsg-text--nike-orange exp-pdp-product-price exp-pdp-product-swoosh-price-available" itemtype="http://schema.org/Offer" itemprop="offers" itemscope="">
                    										
                    	                                  <span class="exp-pdp-local-price" itemprop="price">$200</span>
                    									</span>
                    	</span>                        </div>
                    	
                    	                        <div class="size-dd-parent">
                    	                            <div class="exp-pdp-size-container exp-pdp-dropdown-container nsg-form--drop-down">
                    	                                
                    	                                <select class="nsg-form--drop-down exp-pdp-size-dropdown exp-pdp-dropdown  selectBox" data-tooltiptext="Select a Size" data-error="Select a Size" required="required" style="display: none;">
                    	                                    <option value=""></option>
                    	                                      <option name="skuId" value="16565024:17" data-label="(17)">
                    	                                        17
                    	                                      </option>
                    	                                      <option name="skuId" value="16565025:18" data-label="(18)">
                    	                                        18
                    	                                      </option>
                    	                                </select><a class="nsg-form--drop-down--label nsg-grad--light-grey nsg-font-family--platform nsg-form--drop-down exp-pdp-size-dropdown exp-pdp-dropdown selectBox-dropdown" style="" title="" tabindex="0"><span class="js-selectBox-label">SIZE </span><span class="nsg-form--drop-down--selected-option">&nbsp;</span></a>
                    	                            <ul class="nsg-form--drop-down--option-container selectBox-dropdown-menu selectBox-options nsg-form--drop-down exp-pdp-size-dropdown exp-pdp-dropdown" style="display: none;"><li class="nsg-form--drop-down--option" rel="16565024:17">
                    	                                        17
                    	                                      </li><li class="nsg-form--drop-down--option" rel="16565025:18">
                    	                                        18
                    	                                      </li></ul></div>
                    	                        </div>
                    	                    </div>
                    	                </div>
                    	
                    	                <hr class="exp-pdp-separator extra-spacing">
                    	
                    	                <div>
                    	                    <label class="nsg-form--label">
                    	                        <span class="label-text">First Name</span>
                    								<span class="exp-input-wrapper">
                    									<input type="text" name="firstname" autocomplete="given-name" class="nsg-form--input" data-error="Please enter a first name." data-error-at="Please enter a valid first name." required="required" maxlength="40">
                    								</span>
                    	                    </label>
                    	                    <label class="nsg-form--label">
                    	                        <span class="label-text">Last Name</span>
                    								<span class="exp-input-wrapper">
                    									<input type="text" name="lastname" autocomplete="family-name" class="nsg-form--input" data-error="Please enter a last name." required="required" maxlength="40">
                    								</span>
                    	                    </label>
                    	                    <label class="nsg-form--label">
                    	                        <span class="label-text">Email</span>
                    								<span class="exp-input-wrapper">
                    									<input type="email" name="email" class="nsg-form--input" data-error="Please enter a valid email address." required="required" maxlength="50">
                    								</span>
                    	                    </label>
                    	                    <a href="http://store.nike.com/us/en_us/pd/hyperdunk-2016-flyknit-mens-basketball-shoe/pid-11055700/pgid-11139448#" class="not-me not-logged-in nsg-text--dark-grey">Not <span class="user-name"></span>?</a>
                    	                </div>
                    	
                    	                <hr class="exp-pdp-separator">
                    	
                    	                <div class="align-right">
                    	                    <button type="submit" class="nsg-font-family--platform nsg-button nsg-grad--nike-orange submit-button">Submit Request to Notify Me</button>
                    	                </div>
                    	            </form>
                    	        </div>
                    	    </div>
                    	
                    	    <div class="notify-success">
                    	        <h3 class="edf-font-size--xlarge nsg-font-family--platform nsg-text--dark-grey">
                    	          Thank You
                    	        </h3>
                    	        <hr class="exp-pdp-separator">
                    	        <div class="text nsg-font-family--base nsg-text--medium-grey edf-font-size--regular" data-successtext="You’ll be notified at {0} when this item is in stock."></div>
                    	        <button type="button" class="nsg-button nsg-grad--nike-orange continue-shopping-button">Continue Shopping</button>
                    	    </div>
                    	
                    	    <div class="notify-error">
                    	        <h3 class="edf-font-size--xlarge nsg-font-family--platform nsg-text--dark-grey">
                    	          Error
                    	        </h3>
                    	        <hr class="exp-pdp-separator">
                    	        <div class="text nsg-font-family--base nsg-text--medium-grey edf-font-size--regular">Sorry, an error occured and we were unable to submit your notification request.</div>
                    	        <button type="button" class="nsg-button nsg-grad--nike-orange continue-shopping-button">Continue Shopping</button>
                    	    </div>
                    	</div>  </div>
                
                   -->
                
                
                  <div class="exp-pdp-cta-promo-wrapper" style="opacity: 1;">
                    
                    
                    <div class="exp-pdp-promo-wrapper">
                    
                      <div class="exp-pdp-promo-message nsg-text--dark-grey">
                        <div class="exp-pdp-promo-message-image"></div><div class="exp-pdp-promo-message-text-link-wrapper">                <span class="exp-pdp-promo-message-text">Free shipping, and no hassle returns </span>  <a class="exp-pdp-promo-message-link underline" href="http://help-en-us.nike.com/app/answers/detail/article/free-shipping/" target="_blank">                                Learn more</a></div>
                      </div>
                    </div>
                    <hr class="exp-pdp-separator">
                  </div>
                <div class="exp-pdp-hero-zoom-display" style="z-index: 220; display: none; overflow: hidden; position: absolute; top: 0px; left: 0px; width: 380px; height: 620px; background: rgb(245, 245, 245);"></div></div>    </div>
          
<!--             <div class="exp-pdp-section-divider nsg-misc-keyline--horizontal"></div>
          
            
            <div class="exp-pdp-section-divider nsg-misc-keyline--horizontal"></div>
          
            <div class="exp-sizeandfit-modal"></div> -->

            

     </div>
     </div></div></div></div>  
     <div style="margin:10px;"> 
     <hr>
     <p class="pull-left" style="font-size:24px; font-family: VIIFonts;">Ulasan Produk</p>
     <div class="pull-right">
       <button class="btn btn-primary btn-xs" onclick="$('#myModal').modal('show')" style="font-size:17px; font-family: VIIFonts;"><i class="fa fa-plus"></i> Tulis Ulasan</button>
     </div><br><br>
      <div class="panel panel-default" style="font-size:17px; font-family: VIIFonts;">
        <?php echo $this->core->listreview($productcode); ?>
        <!-- <ul class="list-group">
          <li class="list-group-item">
            <div class="col-sm-1">
              <img src="<?php echo base_url() ?>img/avatar.png" width="100" class="img-responsive thumbnail pull-left">
            </div>
            <div class="col-sm-11">
              <span class="pull-left"><strong>Judul</strong></span><br>
              <span>Isi ulasan produk</span><br>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            <div class="clearfix"></div>
          </li>
          <li class="list-group-item">
            <div class="col-sm-1">
              <img src="<?php echo base_url() ?>img/avatar2.png" width="100" class="img-responsive thumbnail pull-left">
            </div>
            <div class="col-sm-11">
              <span class="pull-left"><strong>Judul</strong></span><br>
              <span>Isi ulasan produk</span><br>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            <div class="clearfix"></div>
          </li>
          <li class="list-group-item">
            <div class="col-sm-1">
              <img src="<?php echo base_url() ?>img/avatar3.png" width="100" class="img-responsive thumbnail pull-left">
            </div>
            <div class="col-sm-11">
              <span class="pull-left"><strong>Judul</strong></span><br>
              <span>Isi ulasan produk</span><br>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
              <i class="fa fa-star"></i>
            </div>
            <div class="clearfix"></div>
          </li>
        </ul> -->
      </div>
     </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Tulis Ulasan</h4>
          </div>
          <?php if(!$this->session->userdata("userlogin")){ ?>
          <div class="modal-body">
            <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
              <label>Ulasan</label>
              <textarea name="ulasan" class="form-control"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Simpan</button>
          </div>
          <?php } else { ?>
          <div class="modal-body">
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" id="password" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button class="btn btn-primary"><i class="fa fa-sign-in"></i> Login</button>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
	<script type="text/javascript">

        function addtocart(pc,pn,pr){

            var qty = $("#qty").val();
            var cl = $("#color").val();
            var sz = $("#size").val();
            $.post("<?php echo base_url() ?>cart/add", {product_id: pc, pn:pn, quantity :qty, pr:pr, size :sz, color:cl}, function(feedback){
                //window.location.reload();
                $("#cart-info").html(feedback);
                $(".dropdown-toggle").dropdown('toggle');
            })
        }

        $("#zoom_01").elevateZoom();

         $('.thumbnails').on('click', 'a', function(e) {
			//var $this = $(this);

			//e.preventDefault();

			// Use EasyZoom's `swap` method
			//api1.swap($this.data('standard'), $this.attr('href'));
			alert("asdasdas")
			return false;
		});

		// Setup thumbnails example
		// var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		// $('.thumbnails').on('click', 'a', function(e) {
		// 	var $this = $(this);

		// 	e.preventDefault();

		// 	// Use EasyZoom's `swap` method
		// 	api1.swap($this.data('standard'), $this.attr('href'));
		// });

		// // Setup toggles example
		// var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

		// $('.toggle').on('click', function() {
		// 	var $this = $(this);

		// 	if ($this.data("active") === true) {
		// 		$this.text("Switch on").data("active", false);
		// 		api2.teardown();
		// 	} else {
		// 		$this.text("Switch off").data("active", true);
		// 		api2._init();
		// 	}
		// });
    </script>
	<?php require("footer.php") ?>