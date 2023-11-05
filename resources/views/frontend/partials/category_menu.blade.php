<?php
    $numOfCols = 4;
    $rowCount = 0;
?>

<ul class="header__mega--menu d-flex">
    <li class="header__mega--menu__li">
        <ul class="header__mega--sub__menu">
        <?php
            foreach (get_level_zero_categories()->take(30) as $key => $category){
                $category_name = $category->getTranslation('name');
        ?> 
                <li class="header__mega--sub__menu_li">
                    <a class="header__mega--sub__menu--title" href="{{ route('products.category', $category->slug) }}">{{ $category_name }}</a>
                </li>
            
            <?php
                $rowCount++;
                if ($rowCount % $numOfCols == 0)
                    echo '</ul></li><li class="header__mega--menu__li"><ul class="header__mega--sub__menu">';
            }
            ?>
        </ul>
    </li>
    
</ul>