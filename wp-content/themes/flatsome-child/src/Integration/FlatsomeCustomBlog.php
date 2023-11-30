<?php
namespace Sconnect\Integration;
class FlatsomeCustomBlog {
    
    function __construct() {
        $this->change_grid_layout();
    }

    

    function change_grid_layout(){
        /**
         * 1
         * 2
         * 3
         * 4
         * 5
         * 6
         * 7
         * 8
         * 9
         * 10
         * 11 - Dự án nổi bật
         * 12 - Tin tức chuyên ngành - home
         * 13 - chuong trinh dao tao
         * 14 - Mega menu
        */
        add_filter('flatsome_get_grid', function($return,$grid){
            if($grid == 11){
                $return = [
                    [
                        'height' => '1-2',
                        'span' => '3',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1',
                        'span' => '3',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1-2',
                        'span' => '3',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1',
                        'span' => '3',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1',
                        'span' => '3',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1',
                        'span' => '3',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1-2',
                        'span' => '3',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1-2',
                        'span' => '3',
                        'md' => '6',
                        'size' => 'large',
                    ],
                ];
            }
            if($grid == 12){
                $return = [
                    [
                        'height' => '1',
                        'span' => '4',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1-2',
                        'span' => '4',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1-2',
                        'span' => '4',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1-2',
                        'span' => '4',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1-2',
                        'span' => '4',
                        'md' => '6',
                        'size' => 'large',
                    ],
                ];
            }
            if($grid == 13){

                $return = [
                    [
                        'height' => '1',
                        'span' => '6',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1-2',
                        'span' => '6',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1-2',
                        'span' => '6',
                        'md' => '6',
                        'size' => 'large',
                    ],
                ];
            }
            if($grid == 14){
                $return = [
                    [
                        'height' => '1',
                        'span' => '6',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1',
                        'span' => '3',
                        'md' => '6',
                        'size' => 'large',
                    ],
                    [
                        'height' => '1',
                        'span' => '3',
                        'md' => '6',
                        'size' => 'large',
                    ],
                ];
            }
            return $return;
        },10,2);
    }

}
