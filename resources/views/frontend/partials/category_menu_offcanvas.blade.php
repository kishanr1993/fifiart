<?php
    $numOfCols = 4;
    $rowCount = 0;
?>

<ul class="offcanvas__sub_menu">
    <li class="offcanvas__sub_menu_li">
        <span class="header__mega--subtitle">Column One</span>
        <ul class="offcanvas__sub_menu">
        <?php
            foreach (get_level_zero_categories()->take(30) as $key => $category){
                $category_name = $category->getTranslation('name');
        ?> 
                <li class="offcanvas__sub_menu_li">
                    <a class="offcanvas__sub_menu_item" href="{{ route('products.category', $category->slug) }}">{{ $category_name }}</a>
                </li>
            
            <?php
                $rowCount++;
                if ($rowCount % $numOfCols == 0)
                    echo '</ul></li><li class="offcanvas__sub_menu_li"><ul class="offcanvas__sub_menu">';
            }
            ?>
        </ul>
    </li>
    
</ul>