<?php
namespace Sconnect\Functions;
class BannerFlyOut {
    
    function __construct() {
        add_action( 'wp_footer', function(){
            $block_id = get_field('flyoutbanner');
            if(!$block_id) return;
            $shortcode = '[block id="'.$block_id.'"]';

            ob_start();
                ?>
                <div class="banner-flyout hidden" id="banner_flyout_for_<?php echo esc_attr( $block_id ) ?>">                    
                    <?php echo do_shortcode( $shortcode ); ?>
                
                    <style type="text/css">
                        .banner-flyout{
                            position: fixed;
                            right: 0;
                            bottom: 0;
                            z-index: 1;
                            width: 100%;
                            z-index: 1042;
                        }
                        @media (min-width: 768px){
                            .banner-flyout{
                                width: 55%;
                                bottom: 100px;
                            }
                        }
                        .banner-flyout-close{

                        }
                    </style>
                    <script type="text/javascript">
                        document.addEventListener('DOMContentLoaded', function () {
                            const BannerFlyout = document.querySelector(".banner-flyout");
                            const storage_item_name = "sconnect_bannerflyout_storage_"+BannerFlyout.getAttribute('id');
                            const storage_item_name_expires = storage_item_name+'_expires';


                            if(BannerFlyout){
                                function isBannerClosed() {
                                    const __close = localStorage.getItem(storage_item_name);
                                    if (__close) {
                                        const expirationTime = localStorage.getItem(storage_item_name_expires);
                                        if (expirationTime && new Date().getTime() < parseInt(expirationTime, 10)) {
                                            return true;
                                        }
                                    }
                                    return false;
                                }
                                if (!isBannerClosed()) {
                                    BannerFlyout.classList.remove('hidden');
                                    const BannerFlyoutInner = BannerFlyout.querySelector("[data-animate='bounceInRight'] .col-inner");
                                    if (BannerFlyoutInner) {
                                        const close_btn = document.createElement('span');
                                        close_btn.classList.add('banner-flyout-close', 'absolute', 'top', 'right');
                                        close_btn.innerHTML = '<svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line> </svg>';
                                        BannerFlyoutInner.appendChild(close_btn);
                                        close_btn.addEventListener("click", function () {
                                            localStorage.setItem(storage_item_name, 'true');
                                            const now = new Date();
                                            const expireTime = now.getTime() + 24 * 60 * 60 * 1000;
                                            localStorage.setItem(storage_item_name_expires, expireTime);
                                            BannerFlyoutInner.classList.add('hidden');
                                        });
                                    }
                                }

                                var isScrolling = false;

                                document.addEventListener('scroll', function() {
                                    isScrolling = true;
                                    clearTimeout(window.scrollTimeout);
                                    window.scrollTimeout = setTimeout(function() {
                                        if (isScrolling) {
                                            // Thực hiện các hành động bạn muốn khi người dùng thực sự scroll ở đây
                                            BannerFlyout.classList.add('hidden');
                                            isScrolling = false; // Đặt lại trạng thái scroll
                                        }
                                    }, 500);
                                });

                                // Thêm sự kiện load để xác định khi trang đã tải xong
                                window.addEventListener('load', function() {
                                    isScrolling = false; // Đặt lại trạng thái scroll khi trang đã tải xong
                                });
                            }
                        });
                    </script>
                </div>
                <?php 
            echo ob_get_clean();
        } );
    }
}
