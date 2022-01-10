   <section class="product-filter">
       <div class="container">
           <div class="product-filter-title">
               <div class="product-href-wrap">
                   
                   <div class="product-href">
                       <a href="">Trang chủ </a>
                       <a> <?php echo "/ " . $data['cate'] ?> </a>
                    </div>
                   
               </div>
               <div class="sort">
                   <p class="hide-filters"> Ẩn thanh lọc </p>
                   <span></span>
                   <p> Sắp xếp theo
                       <i class="fas fa-sort-down"></i>
                   </p>
               </div>
           </div>
           <div class="product-filter-content">
               <div class="product-type-wrap">
                   <div class="product-sidebar">
                       <div class="product-type">
                           <?php
                            $types = json_decode($data['typeList']);
                            foreach ($types as $type) {
                            ?>
                               <p id="<?php echo $type->typeName ?>"> <?php echo $type->typeName ?></p>
                           <?php } ?>
                       </div>
                       <form class="filter-price" onsubmit="return false">
                            <div id="slider-range" style="height:14px;"></div>
                            <input type="text" id="amount" readonly style="border:0; font-weight:bold;">
                            <input type="hidden" id="start-price" value="1000000">
                            <input type="hidden" id="end-price" value="10000000">
                            <button type="submit"> Lọc </button>
                       </form>
                       <div class="size-filter">
                           <div class="title">
                               <h3> Size </h3>
                               <i class="fas fa-sort-down"></i>
                           </div>
                           <div class="size"></div>
                       </div>
                       <div class="color-filter">
                           <div class="title">
                               <h3> Color </h3>
                               <i class="fas fa-sort-down"></i>
                           </div>
                           <div class="colors-wrap">
                               <div class="color-wrap">
                                   <div style="background-color: black;"></div>
                                   <small>Black</small>
                               </div>
                               <div class="color-wrap">
                                   <div style="background-color: Blue;"></div>
                                   <small>Blue</small>
                               </div>
                               <div class="color-wrap">
                                   <div style="background-color: Brown;"></div>
                                   <small>Brown</small>
                               </div>
                               <div class="color-wrap">
                                   <div style="background-color: Green;"></div>
                                   <small>Green</small>
                               </div>
                               <div class="color-wrap">
                                   <div style="background-color: Grey;"></div>
                                   <small>Grey</small>
                               </div>
                               <div class="color-wrap">
                                   <div style="background-color: Orange;"></div>
                                   <small>Orange</small>
                               </div>
                               <div class="color-wrap">
                                   <div style="background-color: Red;"></div>
                                   <small>Red</small>
                               </div>
                               <div class="color-wrap">
                                   <div style="background-color: Yellow;"></div>
                                   <small>Yellow</small>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               <div class="product-main">
                   <div class="product-list">
                       <?php
                        $products = json_decode($data['productList']);
                        // print_r($products);
                        foreach ($products as $product) { ?>
                           <a href="product/detail/<?php echo $product->slug ?>?id=<?php echo $product->id ?>">
                               <div class="product-list-item">
                                   <img src=" <?= $product->avatar ?> " alt="">
                                   <span class="cate-name"><?php echo $product->cateName; ?></span>
                                   <div class="product-info">
                                       <h4>
                                           <?php echo $product->name; ?>
                                       </h4>
                                       <div class="desc">
                                           <?php echo $product->typeName; ?>
                                       </div>
                                       <span class="price"> <?php echo number_format($product->price) ?> VNĐ</span>
                                   </div>
                               </div>
                           </a>
                       <?php } ?>
                   </div>
               </div>
           </div>
       </div>
   </section>